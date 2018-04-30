(function () {

  const tinymce = window.tinymce;

  tinymce.PluginManager.add('quote', function (editor) {

    let checkFormatMatch = function(type, ctrl) {

      // Check if the selection matches the format
      const formatMatch = editor.formatter.match('pull_quote_format');

      // Some magic to find the blockquote element from inside the selection
      const $selectedElement = $(editor.selection.getNode());

      let $blockquote;
      if ($selectedElement.is('div.quote')) {
        $blockquote = $selectedElement;
      } else {
        $blockquote = $selectedElement.closest('div.quote');
      }

      const typeMatch = $blockquote.hasClass('quote-' + type);
      const decoElementMatch = $blockquote.find('.quote_deco').length;
      const imageElementMatch = $blockquote.hasClass('quote-image');

      // If all conditions are true, the button should be in its active state
      ctrl.active( formatMatch && typeMatch && (decoElementMatch || imageElementMatch) );

    };

    let toggleBlockquoteFormat = function(type) {

      if (!editor.formatter.match('pull_quote_format')) {

        // If the blockquote format is not already applied to the element, we apply it before doing anything else.
        editor.formatter.apply('pull_quote_format');

        // Some magic to find the blockquote element from inside the selection
        let $selectedElement = $(editor.selection.getNode());

        let $blockquote;
        if ($selectedElement.is('div.quote')) {
          $blockquote = $selectedElement;
        } else {
          $blockquote = $selectedElement.closest('div.quote');
        }

        $blockquote.addClass('quote-' + type);

        let $img = $blockquote.find('img');
        if ($img.length) {
          $blockquote.addClass('quote-image');
        } else {
          $blockquote.addClass('quote-text');

          // Check whether or not we already have a .cc-blockquote-border in the selection, in case the style was toggled off using the regular blockquote btn
          let $decoElement, $decoElement2;
          if (!$blockquote.find('.quote_deco').length) {
            if(type === 'pull'){
              $decoElement = $('<span>&nbsp;</span>').addClass('quote_deco absolute top left height-100');
              $blockquote.children().last().append($decoElement);
            }
            else {
              $decoElement = $('<span><i class="icon-quote-open">&nbsp;</i></span>').addClass('quote_deco absolute top left text--blue');
              $decoElement2 = $('<span><i class="icon-quote-close">&nbsp;</i></span>').addClass('quote_deco quote_deco-close text--blue absolute bottom right');
              $blockquote.children().last().append($decoElement, $decoElement2);
            }
          }
        }

      } else {

        // First we find the parent <blockquote> element
        let $selectedElement = $(editor.selection.getNode());
        let $blockquote = $selectedElement.closest('.quote');

        // Since the format is already applied, we remove the border element from inside the blockquote
        $blockquote.find('span.quote_deco').remove();

        // We also have to manually remove all classes that are not part of the formatter
        $blockquote.removeClass('quote-text quote-image quote-pull quote-quote');

        // And then simply remove the format to get rid of the blockquote
        editor.formatter.remove('pull_quote_format');
      }

      editor.nodeChanged(); // refresh the button state

    };

    editor.on('init', function() {
      editor.formatter.register(
        'pull_quote_format', {
          block: 'div',
          classes: ['quote', 'relative', 'padding-horz-large', 'xlarge-up-padding-horz-xxlarge', 'padding-vert-xxsmall', 'margin-bottom-large'],
          wrapper: true,
        }
      );
    });

    editor.addButton('pull_quote', {
      title: 'Insert pull quote',
      text: 'Pull Quote',
      icon: false,
      onclick: function() {
        toggleBlockquoteFormat('pull');
      },
      onPostRender: function() {
        let ctrl = this;
        editor.on('NodeChange', function() {
          checkFormatMatch('pull', ctrl);
        });
      },
    });

    editor.addButton('quote', {
      title: 'Insert quote',
      text: 'Quote',
      icon: false,
      onclick: function() {
        toggleBlockquoteFormat('quote');
      },
      onPostRender: function() {
        let ctrl = this;
        editor.on('NodeChange', function() {
          checkFormatMatch('quote', ctrl);
        });
      },
    });
  });
})();