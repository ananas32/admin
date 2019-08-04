$(document).ready(function(){

  $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });

	var editor_config = {
		path_absolute : "/",
		selector: "textarea.richTextBox",
		language: 'uk',
		height : "300",
		autosave_interval: "10s",
		browser_spellcheck: true,
		contextmenu: false,
		plugins: [
			"image charmap preview anchor",
			"wordcount visualblocks visualchars code fullscreen",
			"insertdatetime nonbreaking save directionality",
			"emoticons template paste textcolor colorpicker textpattern youtube media autosave"
		],
		toolbar: "undo redo | styleselect removeformat | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link unlink | image youtube",
		relative_urls: false,
		rel_list: [
			{title: '---', value: ''},
			{title: 'nofollow', value: 'nofollow'}
		],
		file_browser_callback : function(field_name, url, type, win) {
			var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
			var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;

			var cmsURL = editor_config.path_absolute + 'laravel-filemanager?field_name=' + field_name;

			if (type == 'image') {
				cmsURL = cmsURL + "&type=Images";
			} else {
				cmsURL = cmsURL + "&type=Files";
			}

			tinyMCE.activeEditor.windowManager.open({
				file : cmsURL,
				title : 'Filemanager',
				width : x * 0.8,
				height : y * 0.8,
				resizable : "yes",
				close_previous : "no"
			});
		},
		init_instance_callback: function (editor) {
			editor.on('dblClick', function (e) {
				if (e.target.nodeName === 'IMG') {
					tinyMCE.activeEditor.execCommand('mceImage');
				}
			});
		}
	};

	tinymce.init(editor_config);
  // tinymce.init({
  //   menubar: false,
  //   selector:'textarea.richTextBox',
  //   skin: 'admin',
  //   min_height: 600,
  //   resize: 'vertical',
  //   plugins: 'link, image, code, youtube, giphy, table, textcolor, lists',
  //   extended_valid_elements : 'input[id|name|value|type|class|style|required|placeholder|autocomplete|onclick]',
  //   file_browser_callback: function(field_name, url, type, win) {
  //           if(type =='image'){
  //             $('#upload_file').trigger('click');
  //           }
  //       },
  //   toolbar: 'styleselect bold italic underline | forecolor backcolor | alignleft aligncenter alignright | bullist numlist outdent indent | link image table youtube giphy | code',
  //   convert_urls: false,
  //   image_caption: true,
  //   image_title: true
  // });

});
