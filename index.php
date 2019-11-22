<?php

declare(strict_types = 1);

/**
 * Plugin Name: Wordpress Theme Generator
 */

namespace WpThemeGenerator;

use WpThemeGenerator\Generators\ThemeGenerator;

require 'generators/ThemeGenerator.php';

register_activation_hook(__FILE__, 'generateTheme');

function generateTheme()
{
    $themeName = 'Venture Translations';
    $obj = new ThemeGenerator($themeName);
    try {
        $obj->init();
        //parse html
        $obj->makeHeaderFile();
        $obj->makeFunctionsFile();
        $obj->makeFooterFile();
        $obj->makeFrontPageFile();
    } catch (Exception $exception) {
        echo $exception->getMessage();
    }
}
