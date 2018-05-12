tinymce.init({
	/* replace textarea having class .tinymce with tinymce editor */
	selector: "textarea.editor",
	setup: function(editor){
		editor.on('change',function(){
			tinymce.triggerSave();
		});
		beeupload(editor);
		removeTitle();
	},
	/* theme of the editor */
	theme: "modern",
	skin: "lightgray",
	
	/* width and height of the editor */
	width: "100%",
	height: 300,
	
	/* display statusbar */
	statubar: true,
	
	/* plugin */
	plugins: [
		"advlist autolink link image lists charmap print preview hr anchor pagebreak",
		"searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
		"save table contextmenu directionality emoticons template paste textcolor autosave fullscreen"
	],

	/* toolbar */
	toolbar: " insertfile undo redo |styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image imageupload | print preview media fullpage | forecolor backcolor emoticons | copy paste| fullscreen",
	// font_formats: 'Arial=arial,helvetica,sans-serif;Courier New=courier new,courier,monospace;AkrutiKndPadmini=Akpdmi-n;LaoFont=Noto Serif Lao',
	/*fontsize_formats: '8pt 10pt 11pt 12pt 14pt 18pt 24pt 36pt 48pt 50pt 54pt 72pt', */
	/* style */
	style_formats: [
		{title: "Headers", items: [
			{title: "Header 1", format: "h1"},
			{title: "Header 2", format: "h2"},
			{title: "Header 3", format: "h3"},
			{title: "Header 4", format: "h4"},
			{title: "Header 5", format: "h5"},
			{title: "Header 6", format: "h6"}
		]},
		{title: "Inline", items: [
			{title: "Bold", icon: "bold", format: "bold"},
			{title: "Italic", icon: "italic", format: "italic"},
			{title: "Underline", icon: "underline", format: "underline"},
			{title: "Strikethrough", icon: "strikethrough", format: "strikethrough"},
			{title: "Superscript", icon: "superscript", format: "superscript"},
			{title: "Subscript", icon: "subscript", format: "subscript"},
			{title: "Code", icon: "code", format: "code"}
		]},
		{title: "Blocks", items: [
			{title: "Paragraph", format: "p"},
			{title: "Blockquote", format: "blockquote"},
			{title: "Div", format: "div"},
			{title: "Pre", format: "pre"}
		]},
		{title: "Alignment", items: [
			{title: "Left", icon: "alignleft", format: "alignleft"},
			{title: "Center", icon: "aligncenter", format: "aligncenter"},
			{title: "Right", icon: "alignright", format: "alignright"},
			{title: "Justify", icon: "alignjustify", format: "alignjustify"}
		]},
		 { title: 'Badge', inline: 'span', styles: { display: 'inline-block', border: '1px solid #2276d2', 'border-radius': '5px', padding: '2px 5px', margin: '0 2px', color: '#2276d2' } },
    	 // { title: 'Image Left', selector: 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,table,img', styles: {blockquote} },
    	 // { title: 'Image Right', selector: 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,table,img', classes: 'clearfix', styles: {margin: '0px auto 0px 50%'} }
	],
});
var editor_ = null;
function beeupload(editor){
	editor_ = editor;
            editor.addButton('imageupload', {
                text:"+",
                icon: "image",
                onclick: function(e) {
                   removeTitle();
                   $('#modal-image').css('display','block');
                   var ch = $('#top').hasClass('modal-open')
		  	        if(!ch){
		    	        $('#top').addClass('skin-blue sidebar-mini sidebar-collapse modal-open');
		        	}
                }
    });
}
function removeTitle(event){
    var tiny = document.getElementById('body_ifr');
    	if(tiny != null){
       		document.getElementById('body_ifr').removeAttribute('title');
    	}
    var tiny_ = document.getElementById('editor_tiny_ifr');
	    if(tiny_ != null){
	       		document.getElementById('editor_tiny_ifr').removeAttribute('title');
	    }
	return {
		message: tiny + ' _ ' + tiny_
	}
}
function setImage(e){
  var editor = editor_;
  editor.insertContent('<img class="img-responsive" src="'+e+'"  data-mce-src="'+e+'"/>');
  $('#modal-image').css('display','none');
   var ch = $('#top').hasClass('modal-open');
	if(ch){
		$('#top').removeClass('modal-open');
	}
  event.preventDefault();
}