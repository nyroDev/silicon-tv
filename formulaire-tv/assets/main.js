import 'tinymce/tinymce';
import 'tinymce/themes/modern/theme';

window.tinymce.init({
  selector: 'textarea',
  extended_valid_elements: 'strong',
  skin: false,
  theme: 'modern',
  content_style: 'body {font-family: Arial; font-size: 10pt;}',
  height: 50,
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

document.getElementsByTagName('form')[0].onsubmit = tinyMCE.triggerSave();
