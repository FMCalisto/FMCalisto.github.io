$(document).ready(function(){
			
		file_style();
		
  $('form').bind("submit", function(e){
      e.preventDefault();
  });
  
		$(".contact input").keyup(function() {
			var value =$(this).val();
      var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
      
       if($(this).parent().hasClass("email")){
         if(!reg.test($(this).val())){
           validate_animation($(this), "error");
					 error_message($(this), "error");
         }
         else{
           validate_animation($(this), "success");
					 error_message($(this), "success");
         }
         exit;
        }
				if(value.length > 0){
					validate_animation($(this), "success");
					error_message($(this), "success");
				}
        else if(value.length == 0){
					validate_animation($(this), "blank");
					error_message($(this), "blank");
			  }
				else
				{
					validate_animation($(this), "error");
					error_message($(this), "error");
				}
		});
		
		$(".contact input").blur(function(){
			error_message($(this), "blank");
		});

}); 

function validate_animation(elem, is_valid){

	if(is_valid != "blank"){
		var elem_class = elem.attr("class").split("-");
		elem.attr("class",elem_class[0] + "-to-" + is_valid);
	}
	else{
		elem.attr("class", "default");
	}
	
}

function error_message(elem, is_valid){
	if(is_valid == "error"){
		var msg = elem.attr("msg");	
		elem.next().text(msg).show();
	}
	else{
		elem.next().hide();
	}
}

function file_style(){

	var wrapper = $('<div/>').css({height:0,width:0,'overflow':'hidden'});
	var fileInput = $(':file').wrap(wrapper);

	fileInput.change(function(){
		$this = $(this);
	})

	$('#file').click(function(){
		fileInput.click();
	}).show();
}


(function () {
	var input = document.getElementById("images"), 
		   form = document.getElementById("image-form"),
		   dropbox = document.getElementById("file"),
		formdata = false;

	function showUploadedItem (source) {
  		$("#image-list").html("<li><img src='"+source+"' />");
	}   
	
	function dragEnter(evt) {
	  evt.stopPropagation();
	  evt.preventDefault();
	}

	function dragOver(evt) {
	  evt.stopPropagation();
	  evt.preventDefault();
	   $('#file').css("background-position" , "center -140px");
	  $('#file p').text("Release to add image").css("cursor" , "alias");
	}
	
	function dragExit(evt) {
	  evt.stopPropagation();
	  evt.preventDefault();
	  $('#file').css("background-position" , "center 35px");
	  $('#file p').text("Click or Drag in an image to upload").css("cursor" , "pointer");
	}
	
	function handleFiles(files) {
		var file = files[0]; 
		if (!!file.type.match(/image.*/)) {
			if ( window.FileReader ) {
						reader = new FileReader();
						reader.onloadend = function (e) { 
							showUploadedItem(e.target.result, file.fileName);
						};
						reader.readAsDataURL(file);
					}
			}
	}
	
	function drop(evt){
		evt.stopPropagation();
		evt.preventDefault();
		 
		var files = evt.dataTransfer.files;
		var count = files.length;	
		// Only call the handler if 1 or more files was dropped.
		if (count > 0){
			handleFiles(files);
		}
	}
	
	if (window.FormData) {
  		formdata = new FormData();
	}
	
	// init event handlers
	dropbox.addEventListener("dragenter", dragEnter, false);
	dropbox.addEventListener("dragexit", dragExit, false);
	dropbox.addEventListener("dragover", dragOver, false);
	dropbox.addEventListener("drop", drop, false);
	
	
 	input.addEventListener("change", function (evt) {
 		//document.getElementById("response").innerHTML = "Uploading . . ."
 		var i = 0, len = this.files.length, img, reader, file;
	
		for ( ; i < len; i++ ) {
			file = this.files[i];
	
			if (!!file.type.match(/image.*/)) {
				if ( window.FileReader ) {
					reader = new FileReader();
					reader.onloadend = function (e) { 
						showUploadedItem(e.target.result, file.fileName);
					};
					reader.readAsDataURL(file);
				}
				if (formdata) {
					formdata.append("images[]", file);
				}
			}	
		}
	}, false);
			
}());
