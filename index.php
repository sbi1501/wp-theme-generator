<?php

declare(strict_types = 1);

/**
 * Plugin Name: Wordpress Theme Generator
 */

require 'generators\ThemeGenerator.php';

register_activation_hook(__FILE__, 'generateTheme');

function generateTheme()
{
    $themeName = 'Venture Translations';
    $obj = new \WpThemeGenerator\ThemeGenerator($themeName);
    try {
        $obj->init();
        $obj->makeHeaderFile();
    } catch (Exception $exception) {
        echo $exception->getMessage();
    }
}