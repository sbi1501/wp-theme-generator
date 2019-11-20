<?php

declare(strict_types = 1);

namespace WpThemeGenerator\Formatters;

use Exception;

class HtmlFormatter
{
    public function copyData(string $path): void
    {

        $directory = opendir($path);

        while(false !== ( $file = readdir($directory)) ) {
            if (( $file != '.' ) && ( $file != '..' )) {
                if ( is_dir($src . '/' . $file) ) {
                    $this->recurse_copy($src . '/' . $file,$dst . '/' . $file);
                }
                else {
                    copy($src . '/' . $file,$dst . '/' . $file);
                }
            }
        }
        closedir($directory);
    }

    public function removeData()
    {

    }

    public function formatHtml()
    {

    }
}


$path = '';
(new HtmlFormatter())->copyData($path);