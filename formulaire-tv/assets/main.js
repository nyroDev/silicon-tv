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
      var counterdiv = document.getElementById('count_char');
      if(counterdiv) {
        counterdiv.innerText = 'Caractères: ' + count;
      } else {
        var div = document.createElement("div");
        div.id = 'count_char';
        div.className += 'mce-container mce-flow-layout-item mce-last mce-btn-group pull-right';
        div.appendChild(document.createTextNode('Characters: ' + count));
        document.getElementById("mceu_4-body").appendChild(div);
      }
    });
  }
});

function CountCharacters() {
  var body = tinymce.activeEditor.getBody();
  var content = tinymce.trim(body.innerText || body.textContent);
  return content.length;
}

function ValidateCharacterLength(element) {
  var max = 250;
  var count = CountCharacters();
  if (count > max) {
    alert("Limite de " + max + " caractères dépassée.");
    return element.preventDefault();
  }
}

document.getElementsByTagName('form')[0].onsubmit = function(element) {
  tinyMCE.triggerSave();
  //ValidateCharacterLength(element);
};
