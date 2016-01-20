<?php

require_once('vendor/autoload.php');

use Canteen\Profiler\Profiler;
use Thunder\Shortcode\HandlerContainer\HandlerContainer;
use Thunder\Shortcode\Parser\RegexParser;
use Thunder\Shortcode\Parser\RegularParser;
use Thunder\Shortcode\Processor\Processor;
use Thunder\Shortcode\Shortcode\ShortcodeInterface;
use Thunder\Shortcode\Syntax\CommonSyntax;

$profiler = new Profiler();

// Get the content to work with (example-small.md or example-full.md)
$content = file_get_contents('example-small.md');

// Process the markdown first
$extra = new ParsedownExtra();

$content = $extra->text($content);

$profiler->start('shortcode');

// Create Handler container and add a simple handler example
$handler = new HandlerContainer();
$handler->add('u', function(ShortcodeInterface $shortcode) {
            return '<span style="text-decoration: underline;">'.$shortcode->getContent().'</span>';
        });
$handler->add('blue', function(ShortcodeInterface $shortcode) {
            return '<span style="background:blue;color:white;">'.$shortcode->getContent().'</span>';
        });
// Change the Parser to see the difference in speed/corruption
$processor = new Processor(new RegularParser(new CommonSyntax()), $handler);
$processed_content = $processor->process($content);

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


