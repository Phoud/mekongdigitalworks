//Decaration
var count_id = 24;
var prefix = 'mceu_';
var attrib = '';

var btnClose = document.getElementById('close');
btnClose.addEventListener('click', function() {
  $('#modal-image').css('display','none');
		  var ch = $('#top').hasClass('skin-blue sidebar-mini sidebar-collapse modal-open')
		  if(ch){
		    $('#top').removeClass('skin-blue sidebar-mini sidebar-collapse modal-open');
    		$('#top').addClass('skin-blue sidebar-mini sidebar-collapse');
	      }
	    	$('#top').css('overflow', '');
});

function getImages(){
	$.get('/admin/mdw/upload/images/', function(response){
    if(response.success)
    {
      var src;
      $('#img-upload').empty();
      $.each(response.img, function(index, img){
        src = '<div class="col-sm-3 col-xs-6 text-center"><a onclick="setImage(this.href)" href="'+ baseURL +'/img/upload/'+ img.img_url + '" class="thumbnail">' +
        '<img  src="/img/upload/thumbnails/'+ img.img_url + '" alt="' + img.img_url +'" title="'+ img.img_url +'"></a>' +
        '<label><input type="checkbox" name="img_id[]" value="'+ img.id + '">' + img.file_name + '</label>';
        $('#img-upload').append(src);
      });

    }
  }, 'json');
}

$(document).ready(function(event){
	getImages();
	setTimeout(function(event){
		PreparingScreenBtn(event);
	}, 2500);

	$('#blog-form').on('submit',function(event){
		var blogtext = tinyMCE.get('editor_tiny').getContent();
			tinyMCE.triggerSave();
		 if(blogtext == ''){
					alert('ກະລຸນາໃສ່ເນື້ອຄວາມ');
					event.preventDefault();
		 }
	});
});

//Btn Click
var imgUpload = document.getElementById('files-images');
if(imgUpload != null){
  imgUpload.addEventListener('change',function(){
    $('#upload-images-btn').trigger('click');
  }, false);
}

var form_upload = document.getElementById('form-upload-images');
var request = new XMLHttpRequest();
  form_upload.addEventListener('submit', function(event){
  event.preventDefault();
  var form_data = new FormData(form_upload);
  request.open('POST','/admin/mdw/upload/images');
  request.send(form_data);
  setTimeout(function(){
      getImages();
  }, 1500);
}, false);

$("#button-refresh").click(function(){
	getImages();
});

var imgDelete = document.getElementById('button-delete');
if(imgDelete != null){
  imgDelete.addEventListener('click',function(){
    $('#delete-images-btn').trigger('click');
  }, false);
}

var form_delete = document.getElementById('form-delete-image');
var request = new XMLHttpRequest();
form_delete.addEventListener('submit', function(event){
  event.preventDefault();
  var form_data_d = new FormData(form_delete);
  request.open('POST','/admin/mdw/upload/images/delete');
  request.send(form_data_d);
  setTimeout(function(){
      getImages();
  }, 1500);
}, false);

function PreparingScreenBtn(eventv) {
	var fullscreenBtn = document.getElementById(prefix + count_id);
	if(fullscreenBtn != null){
		fullscreenBtn.addEventListener('click', function(event){
			attrib = fullscreenBtn.getAttribute('aria-pressed');
			if(attrib === 'true'){
				normalscreen();
			}else if(attrib === 'false' || attrib == null){
				fullscreen();
			}
		},false);
	}
		var fbtn = document.getElementById('mceu_22');
		if(fbtn != null){
			fbtn.addEventListener('click', function(event){
			attrib = fbtn.getAttribute('aria-pressed');
			if(attrib === 'true'){
				normalscreen();
			}else if(attrib === 'false' || attrib == null){
				fullscreen();
			}
		  },false);
	    }
}

function fullscreen(){
	var h = document.getElementsByClassName("main-header");
	var s = document.getElementsByClassName("main-sidebar");
	if(h !=null){
		h[0].style.display = 'none';
	}
	if(s!=null){
		s[0].style.display = 'none';	
	}
    $('#top').css('overflow-x', 'hidden');
    $('#top').css('overflow-y', 'auto');
}

function normalscreen(){
	var h = document.getElementsByClassName("main-header");
	var s = document.getElementsByClassName("main-sidebar");
	if(h !=null){
		h[0].style.display = 'block';
	}
	if(s!=null){
		s[0].style.display = 'block';	
	}
	$('#top').css('overflow-x', '');
    $('#top').css('overflow-y', '');
	var ch = $('#top').hasClass('modal-open');
	if(ch){
		$('#top').removeClass('modal-open');
	}
}