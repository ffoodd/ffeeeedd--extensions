(function() {
  tinymce.PluginManager.add('ffeeeedd__plugins', function( editor, url ) {
    editor.addButton('abbr', {
      text: 'Abbr',
      title: 'Abréviation',
      icon: false,
      onclick: function() {
        editor.windowManager.open( {
          title: 'Abréviation',
          body: [{
            type: 'textbox',
            name: 'title',
            label: 'Signification de l’abréviation'
          }],
          onsubmit: function( e ) {
            editor.insertContent( '<abbr title="' + e.data.title + '">' + editor.selection.getContent() + '</abbr>');
          }
        });
      }
    });
  });
})();