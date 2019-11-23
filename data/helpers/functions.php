<?php

declare(strict_types = 1);

function enqueue_styles()
{
    $handle = 'venturetranslations-style'; //todo сделать уникальным
    wp_enqueue_style($handle, get_stylesheet_uri());
}

add_action('wp_enqueue_scripts', 'enqueue_styles');

function enqueue_scripts()
{
    wp_register_script('html5-shim', 'http://html5shim.googlecode.com/svn/trunk/html5.js');
    wp_enqueue_script('html5-shim');
}

add_action('wp_enqueue_scripts', 'enqueue_scripts');
