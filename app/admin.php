<?php

namespace App;

use Codelight\ClassCentral\EditorPullQuoteButton;

add_action('init', function (){
  new EditorPullQuoteButton();
});