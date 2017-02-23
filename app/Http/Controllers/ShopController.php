<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Shop;
use RemoteImageUploader\Factory;
use Validator;
use App\Http\Requests\ShopAddRequest;

class ShopController extends Controller
{
    public function create()
    {
        return view('shop.create');
    }

    public function postUploadImage(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'upload' => 'required',
        ]);

        if ($validator->fails()) {
            $message = implode(' ', $validator->errors()->all());

            return [
                'status' => false,
                'url' => '',
                'message' => 'Upload fail!' . $message,
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

    public function postAddShopAjax(ShopAddRequest $request)
    {
        $data = $request->only('name', 'address', 'avatar');
        Shop::create($data);
        
        return response()->json(['sms' => 'Add Success']);
    }
}
