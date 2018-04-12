<?php


namespace Codelight\ClassCentral;


class EditorPullQuoteButton
{
  public function __construct()
  {
    /*$this->ButtonsFilter();*/

    /*$loadingButtonFilter = new ButtonFilter();*/

    add_filter('mce_external_plugins', [$this, 'registerTinymcePlugin']);
    add_filter('mce_buttons', [$this, 'addTinymceToolbarButton']);

    add_editor_style( \App\asset_path('styles/editor.css' ));

    /*add_filter('tinyMCEButton', [$loadingButtonFilter, 'ButtonsFilter']);
    add_action('admin_head', [$loadingButtonFilter, 'styleVariables']);*/
  }

  public function registerTinymcePlugin(array $plugins)
  {
    $plugins['pull_quote'] = \App\asset_path('scripts/admin.js');
    return $plugins;
  }

  public function addTinymceToolbarButton($buttons)
  {
    $buttons[] = 'pull_quote';
    return $buttons;
  }

}