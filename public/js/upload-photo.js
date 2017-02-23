function uploadPhoto(url) {
  var current = this;
  this.url = url;
  var dataImage = '';

  this.init = function () {
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $('#upload').on('click', function () {
      if (typeof $('#photo')[0].files[0] !== 'undefined') {
        current.uploadFile($('#photo')[0].files[0]);
      } else {
        alert('File field is empty');
      }
    });
    current.add();
  };

  this.uploadFile = function (file) {
    var formData = new FormData();
    $('#upload').prop('disabled', true);
    $('#process').show();
    formData.append('upload', file);

    current.currentUpload = $.ajax({
      url: current.url,
      type: 'post', 
      dataType: 'json',
      complete: function (data) {
        $('#upload').prop('disabled', false);
        $('#process').hide();
        switch (data.status) {
          case 200:
            dataImage = data.responseJSON.url;
            $('#image-display').html('');
            $('#image-display').append("<img src='" + dataImage + "' alt='' width='100px' height='100px'>");
            // alert(data.responseJSON.message);
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
        url: '/shop/addShopAjax',
        type: 'POST',
        dataType: 'json',
        data: {
          name: $('#name').val(),
          address: $('#address').val(),
          avatar: dataImage
        },
        success: function(data) {
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
