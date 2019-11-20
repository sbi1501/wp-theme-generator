<?php

declare(strict_types = 1);

namespace WpThemeGenerator;

use WpThemeGenerator\Formatters\DataFormatter;

class ThemeGenerator
{
    /**
     * @var DataFormatter
     */
    private $dataFormatter;

    public function formatData(): void
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

    public function createTheme(): void
    {

    }

    public function fillContent(): void
    {

    }
}