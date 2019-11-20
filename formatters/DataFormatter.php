<?php

declare(strict_types = 1);

namespace WpThemeGenerator\Formatters;

class DataFormatter
{
    /**
     * @var HtmlFormatter
     */
    private $htmlFormatter;

    public function formatHtml(string $path): void
    {
        try {
            $this->dataFormatter->formatHtml();
            try {
                $this->dataFormatter->formatCss();
                try {
                    $this->dataFormatter->formatJs();
                } catch (Exception $exception) {
                    throw $exception;
                }
            } catch (Exception $exception) {
                throw $exception;
            }
        } catch (Exception $exception) {
            echo $exception->getMessage() . PHP_EOL;
        }
    }

    public function formatCss(string $path): void
    {

    }

    public function formatJs(string $path): void
    {

    }
}