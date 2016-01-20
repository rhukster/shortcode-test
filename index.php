<?php

require_once('vendor/autoload.php');

use Canteen\Profiler\Profiler;
use Maiorano\Shortcodes\Manager;
use Maiorano\Shortcodes\Library;

$profiler = new Profiler();

// Get the content to work with (example-small.md or example-full.md)
$content = file_get_contents('example-full.md');

// Process the markdown first
$extra = new ParsedownExtra();

$content = $extra->text($content);

$profiler->start('shortcode');

// Create Handler container and add a simple handler example

//Instantiate a Shortcode Manager
$manager = new Manager\ShortcodeManager;

$manager->register(new Library\SimpleShortcode('u', null, function($content=null){
    return '<span style="text-decoration: underline;">'.$content.'</span>';
}));

$manager->register(new Library\SimpleShortcode('color', null, function($content=null, array $attrs=[]){
    $color = trim($attrs[0], '\'=');
    return '<span style="background:'.$color.';color:white;">'.$content.'</span>';
}));

$manager->register(new Library\SimpleShortcode('ui-tabs', ['theme'=>'default', 'postion'=>'nw'], function($content=null, array $attrs=[]){
    $output = '<div class="ui-tabs ui-theme-'.$attrs['theme'].' '.$attrs['position'].'">';
    $this->manager->
    $output .= $this->manager->doShortCode($content, 'ui-tab');
    $output .= '</div>';
    return $output;
}));

$manager->register(new Library\SimpleShortcode('ui-tab', ['title'=>'Tab'], function($content=null, array $attrs=[]){
    return $content;
}));

$processed_content = $manager->doShortcode($content);

$profiler->end('shortcode');
?>
<!DOCTYPE HTML>
<html>
  <head>
  	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
  	<style>
  		body {margin: 100px;}
  	</style>		
  </head>
  <body>
    <?php
	  echo $processed_content;
	  echo $profiler->render();
	?>
  </body>
</html>	


