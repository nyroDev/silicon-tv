import tinymce from 'tinymce/tinymce';
//import 'tinymce/themes/inlite';
import 'tinymce/themes/modern/theme';

tinymce.init({
  selector: 'textarea',
  skin: false,
  theme: 'modern',
  content_style: 'body {font-family: Arial; font-size: 10pt;}',
  height: 300,
  menubar: false,
  toolbar: [
    'bold',
  ],
  branding: false,
  image_advtab: true,
  setup: function (editor) {
    editor.on('change', function () {
      editor.save();
    });
  }
});