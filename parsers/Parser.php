<?php

declare(strict_types = 1);

namespace WpThemeGenerator\Parsers;

use Exception;

class Parser
{
    private $html = '';

    /**
     * Parser constructor.
     */
    public function __construct()
    {
        $this->html = file_get_contents(__DIR__ . '/../data/index.html');
    }

    public function parseHtml()
    {
        try {
            $parsedHtml = $this->parseFooter($this->html);
            $parsedHtml = $this->parseContent($parsedHtml);
            $this->parseHeader($parsedHtml);
        } catch (Exception $e) {
            print_r('Не удалось распарсить html');
            die;
        }
    }

    /**
     * @param string $html
     */
    private function parseHeader(string $html)
    {
        try {
            $pattern     = '/' . preg_quote('</head>', '/') . '/';
            $replacement = '<?php wp_head(); ?></head>';
            $html        = preg_replace($pattern, $replacement, $html);
            file_put_contents(__DIR__ . '/../var/header.html', $html);
        } catch (Exception $e) {
            print_r('Не удалось распарсить header: ' . $e->getMessage());
            die;
        }
    }

    /**
     * @param string $html
     * @return mixed
     */
    private function parseContent(string $html)
    {
        try {
            $key           = '<div class="layout__inner">';
            $pattern       = '/' . preg_quote($key) . '/';
            $substringList = $this->splitContent($pattern, $html);
            $content       = $key . array_pop($substringList);
            file_put_contents(__DIR__ . '/../var/content.html', $content);
        } catch (Exception $e) {
            print_r('Не удалось распарсить content: ' . $e->getMessage());
            die;
        }
        return array_shift($substringList);
    }

    /**
     * @param string $html
     * @return string
     */
    private function parseFooter(string $html)
    {
        try {
            $key           = '<div class="layout__footer">';
            $pattern       = '/' . preg_quote($key) . '/';
            $substringList = $this->splitContent($pattern, $html);
            $footerContent = $key . array_pop($substringList);
            file_put_contents(__DIR__ . '/../var/footer.html', $footerContent);
        } catch (Exception $e) {
            print_r('Не удалось распарсить footer: ' . $e->getMessage());
            die;
        }
        return array_shift($substringList);
    }

    /**
     * @param string $pattern
     * @param string $subject
     * @return string[]
     * @throws Exception
     */
    private function splitContent(string $pattern, string $subject): array
    {
        if (! $list = preg_split($pattern, $subject)) {
            throw new Exception('не удалось распарсить по регулярному выражению ' . $pattern);
        }
        return $list;
    }
}
