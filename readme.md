Hyperlight Server-Side syntax highlighter for PHP
=================================================

a [Composer][3] package based on r52 of [Hyperlight][1]
with a custom set of highlighters, and minor modifications to make it [PSR-0][2] compatible

Available syntax highlighters:
------------------------------

  - `css`: .css and LESS stylesheets
  - `ini`: .ini files
  - `php`: php embedded in html 
  - `iphp`: native php w/o open tags
  - `javascript`: js, json
  - `shell`: unix shell
  - `sql` : sql queries
  - `twig` : twig template tags in html
  - `xml`: xml, html

Install via [Composer][3]
-------------------------

    :::sh
    composer require razielanarki/hyperlight v0.1.*

Basic usage
-----------

    :::php
    <pre class="source-code php">
    <?php
        include ('./vendor/autoload.php');
        $hyperlight = new Hyperlight\Hyperlight ('php');
        print $hyperlight->render ('<?php print "hello world"; ?>');
    ?>
    </pre>

Sample CSS
----------

a modified version of the Hyperlight vibrant-ink.css is provided, along with it's LESS source

Not invented here
-----------------

[Hyperlight][1] was created by Konrad Rudolph.

original project homepage: 

  - [https://code.google.com/p/hyperlight/][1]


[1]: https://code.google.com/p/hyperlight/
[2]: https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-0.md
[3]: http://getcomposer.org/
