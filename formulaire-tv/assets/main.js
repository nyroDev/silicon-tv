import 'tinymce/tinymce';
import 'tinymce/themes/modern/theme';

window.tinymce.init({
  selector: 'textarea',
  extended_valid_elements: 'strong',
  skin: false,
  theme: 'modern',
  content_style: 'body {font-family: Arial; font-size: 10pt;}',
  height: 175,
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
    editor.on('keyup', function (element) {
      console.log(element);
      var count = CountCharacters();
      document.getElementById("character_count").innerHTML = "Characters: " + count;
    });
  }
});

function CountCharacters() {
  var body = tinymce.get("txtTinyMCE").getBody();
  var content = tinymce.trim(body.innerText || body.textContent);
  return content.length;
}

function ValidateCharacterLength() {
  var max = 20;
  var count = CountCharacters();
  if (count > max) {
    alert("Maximum " + max + " characters allowed.")
    return false;
  }
  return;
}

document.getElementsByTagName('form')[0].onsubmit = function() {
  tinyMCE.triggerSave();
  ValidateCharacterLength();
};
