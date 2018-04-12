(function () {

  const tinymce = window.tinymce;

  tinymce.PluginManager.add('pull_quote', function (editor, url) {
    editor.addButton('pull_quote', {
      title: 'Insert pull quote',
      cmd: 'pull_quote',
      image: url + '/../assets/icon.png',
      onclick: function () {

      },
    });
    //create new windows with values
    editor.addCommand('pull_quote', function () {
      var text = editor.selection.getContent({

      });
      var creatingElement = '<div class="pullQuote">' + text +'</div>';
      tinymce.activeEditor.execCommand('mceInsertContent', false, creatingElement)
    });
  });
})();