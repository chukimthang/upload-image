<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RemoteImageUploader\Factory;
use App\Http\Requests\ProductRequest;
use Illuminate\Support\Facades\DB;

use App\Product;
use App\Image;
use Validator;

class ProductController extends Controller
{
    public function create()
    {
        return view('product.create');
    }

    public function postUploadImage(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'upload' => 'required|image'
        ]);

        if ($validator->fails()) {
            $message = implode(' ', $validator->errors()->all());

            return [
                'status' => false,
                'url' => '',
                'message' => 'Upload fail! ' . $message,
            ];
        }

        try {
            $result = Factory::create(config('uploadphoto.host'), config('uploadphoto.auth'))
                ->upload($request->upload->path());

            return [
                'status' => true,
                'url' => $result,
                'message' => 'Upload successfull!',
            ];
        } catch (\Exception $ex) {
            return [
                'status' => false,
                'url' => '',
                'message' => 'Upload fail! ' . $ex->getMessage(),
            ];
        }
    }

    public function postAddProductAjax(ProductRequest $request)
    {
        $data = $request->only('name', 'price', 'description', 'image');
        try {
            DB::beginTransaction();

            $product = Product::create($data);
            if (empty($data['image'])) {
                DB::rollback();

                return response()->json(['sms' => 'Image null']);
            }
            foreach ($data['image'] as $key => $value) {
                $image = ['name' => $value, 'product_id' => $product->id];
                Image::create($image);
            }
            
            DB::commit();

            return response()->json(['sms' => 'Add Success']);
        } catch (ValidatorException $e) {
            DB::rollback();
        } catch (Exception $e) {
            DB::rollback();
        }
    }
}
