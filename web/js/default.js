function addPrewview() {
    var fbName = document.getElementById('feedbackForm')['name'].value;
    var fbEmail = document.getElementById('feedbackForm')['email'].value;
    var fbMessage = document.getElementById('feedbackForm')['message'].value;
    var fbImg = document.getElementById('feedbackForm')['imgData'].value;
    var element = document.createElement('div');
    element.className = "row";
    if (!fbImg) {
        element.innerHTML = '<div class="panel panel-warning"> \
            <div class="panel-heading">' + fbName +' &lt;' + fbEmail + '&gt; </div> \
            <div class="panel-body">'+ fbMessage + '</div></div>';
    } else {
        element.innerHTML = '<div class="panel panel-warning"> \
            <div class="panel-heading">' + fbName +' &lt;' + fbEmail + '&gt; </div> \
            <div class="panel-body"><div class="row"><div class="col-md-3"><center><img class="img-responsive img-thumbnail" src="'+ fbImg +'"/></center></div> \
            <div class="col-md-9">'+ fbMessage + '</div></div></div></div>';
    }
    var messageList = document.getElementById('message-list');
   // messageList.insertBefore(element,messageList.firstChild);
   messageList.appendChild(element);
}

function resizeInCanvas(img,ext){
  /////////  3-3 manipulate image

  var canvas = $("<canvas>")[0];
  
  var MAX_WIDTH = 320;
  var MAX_HEIGHT = 240;
  var width = img.width;
  var height = img.height;

  if (width > height) {
    if (width > MAX_WIDTH) {
      height *= MAX_WIDTH / width;
      width = MAX_WIDTH;
    }
  } else {
    if (height > MAX_HEIGHT) {
      width *= MAX_HEIGHT / height;
      height = MAX_HEIGHT;
    }
  }

  canvas.width = width;
  canvas.height = height;
  var ctx = canvas.getContext("2d");
  ctx.drawImage(img, 0,0,canvas.width, canvas.height);
  //////////4. export as dataUrl
  return canvas.toDataURL(ext);
}

function testTypeFile(ext) {
    var allowTypeFile = ['image/gif', 'image/png', 'image/jpeg'];
    return allowTypeFile.includes(ext);
    
}



$(document).ready(function() {
  /////// 1. Select image with file input
  $('#fileImg').on('change', function() {
    resizeImages(this.files[0], function(dataUrl) {
          document.getElementById('imgData').value = dataUrl;
    });
  });
  
    $(function(){
        $('#feedbackForm').validate({
            rules: {
                name: {
                    required: true,
                    minlength: 2
                },
                message: {
                    required: true,
                    minlength: 2
                }
            },
            messages: {
                name: {
                    required: "Поле 'Имя' обязательно к заполнению",
                    minlength: "Введите не менее 2-х символов в поле 'Ваше имя'"
                },
                email: {
                    required: "Поле 'Email' обязательно к заполнению",
                    email: "Необходим формат адреса email"	
                },
                message: {
                    required: "Поле 'Cообщение' обязательно к заполнению",
                    minlength: "Введите не менее 2-х символов в поле 'Сообщение'"
                }
            }
        });
    });

  function resizeImages(file, complete) {
    // read file as dataUrl
    ////////  2. Read the file as a data Url
    console.log(file.type);
    if(testTypeFile(file.type)) {
        var reader = new FileReader();
          // file read
          reader.onload = function(e) {
              // create img to store data url
              ////// 3 - 1 Create image object for canvas to use
              var img = new Image();
              img.onload = function() {
               /////////// 3-2 send image object to function for manipulation
                complete(resizeInCanvas(img, file.type));
              };
              img.src = e.target.result;
            }
            // read file
        reader.readAsDataURL(file);
    } else {
        $("#fileImg").val("");
        alert('Неверный формат файла');
    }
  }

});

function sendForm() {
    var formField = {
        name: document.getElementById('feedbackForm')['name'].value,
        email: document.getElementById('feedbackForm')['email'].value,
        imgData: document.getElementById('feedbackForm')['imgData'].value,
        message: document.getElementById('feedbackForm')['message'].value
    };
    $.ajax({
        url: '/contacts/index',
        type: "POST",
        data: formField,
        success: function(data) {
            if(data==='Ok') {
                document.getElementById('feedbackForm').reset();
                document.getElementById('feedbackForm')['imgData'].value = "";
                alert('Сообщение отправлено');
            }
        }
    });
}