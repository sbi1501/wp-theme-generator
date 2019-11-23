<?php

declare(strict_types = 1);

/**
 * Plugin Name: Wordpress Theme Generator
 */

namespace WpThemeGenerator;

use WpThemeGenerator\Generators\ThemeGenerator;
use WpThemeGenerator\Parsers\Parser;

require 'generators/ThemeGenerator.php';
require 'parsers/Parser.php';

register_activation_hook(__FILE__, 'generateTheme');

function generateTheme()
{
    $themeName = 'Venture Translations';
    $themeGenerator = new ThemeGenerator($themeName);
    $parser = new Parser();
    try {
        $themeGenerator->init();
        $parser->parseHtml();
        $themeGenerator->makeHeaderFile();
        $themeGenerator->makeFunctionsFile();
        $themeGenerator->makeFooterFile();
        $themeGenerator->makeFrontPageFile();
    } catch (Exception $exception) {
        echo $exception->getMessage();
    }
}
