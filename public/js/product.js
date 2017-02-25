function product() {
  var current = this;
  var dataImage = [];

  this.init = function () {
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    $('#upload-product').on('click', function () {
      if (typeof $('#photo-product')[0].files[0] !== 'undefined') {
        current.uploadFile($('#photo-product')[0].files[0]);
      } else {
        alert('File field is empty');
      }
    });

    current.add();
  };

  this.uploadFile = function (file) {
    var formData = new FormData();
    $('#upload-product').prop('disabled', true);
    $('#process-product').show();
    formData.append('upload', file);

    current.currentUpload = $.ajax({
      url: '/product/uploadImage',
      type: 'post', 
      dataType: 'json',
      complete: function (data) {
        $('#upload-product').prop('disabled', false);
        $('#process-product').hide();
        switch (data.status) {
          case 200:
            dataImage.push(data.responseJSON.url);
            $('#display-product').html('');
            for (var i = dataImage.length - 1; i >= 0; i--) {
              $('#display-product').append("<img src='" + dataImage[i] 
                + "' alt='' width='100px' height='100px'>"
              );
            }
            break;
          case 500: 
            alert('Unknown error: ' + data.status);
            break;
          default :
            alert(data.responseJSON.message);
        }
      },
      data: formData,
      cache: false,
      contentType: false,
      processData: false
    });
  };

  this.add = function() {
    $('.form-group').on('click', '.btn-primary', function () {
      $.ajax({
        url: '/product/addProductAjax',
        type: 'POST',
        dataType: 'json',
        data: {
          name: $('#name').val(),
          price: $('#price').val(),
          description: $('#description').val(),
          image: dataImage
        },
        success: function(data) {
          $('.form-error').html('');
          alert(data.sms);
        },
        error: function(data) {
          var errors = '';
          for(datos in data.responseJSON){
            errors += data.responseJSON[datos] + '<br>';
          }
          $('.form-error').show().html(errors);
        }
      })
    });
  };
}
