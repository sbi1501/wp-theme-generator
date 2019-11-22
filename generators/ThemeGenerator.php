<?php

declare(strict_types = 1);

namespace WpThemeGenerator\Generators;

require_once 'Generator.php'; //todo remove

use Exception;

class ThemeGenerator extends Generator
{
    /**
     * @var string
     */
    private $themeName = '';

    /**
     * @var string
     */
    private $themeDirectoryPath = '';

    /**
     * @var string
     */
    private $headerPath = '';

    /**
     * @var string
     */
    private $footerPath = '';

    /**
     * @var string
     */
    private $frontPagePath = '';

    /**
     * @var string
     */
    private $cssPath = '';

    /**
     * @var string
     */
    private $functionsPath = '';

    /**
     * ThemeGenerator constructor.
     *
     * @param string $themeName
     */
    public function __construct(string $themeName = 'untitled')
    {
        $this->themeName     = $themeName;
        $this->headerPath    = __DIR__ . '/../data/header.html';
        $this->footerPath    = __DIR__ . '/../data/footer.html';
        $this->frontPagePath = __DIR__ . '/../data/php/front-page.php';
        $this->cssPath       = __DIR__ . '/../data/style.css';
        $this->functionsPath = __DIR__ . '/../data/php/functions.php';
    }

    /**
     * @throws Exception
     */
    public function init()
    {
        try {
            $this->makeThemeDirectory();
            $this->makeIndexFile();
            $this->makeStyleFile();
            $this->makeImagesDirectory();
        } catch (Exception $e) {
            print_r('Не удалось инициализировать тему: ' . $e->getMessage());
            die;
        }
    }

    /**
     * @throws Exception
     */
    public function makeHeaderFile()
    {
        try {
            $headerFilePath = $this->themeDirectoryPath . '/header.php';
            $this->makeFile($headerFilePath);
            $headerContent = $this->getContent($this->headerPath);
            $this->putContent($headerFilePath, $headerContent);
        } catch (Exception $e) {
            print_r('Не удалось создать header.php: ' . $e->getMessage());
            die;
        }
    }

    /**
     * @throws Exception
     */
    public function makeFooterFile()
    {
        try {
            $footerFilePath = $this->themeDirectoryPath . '/footer.php';
            $this->makeFile($footerFilePath);
            $footerContent = $this->getContent($this->footerPath);
            $this->putContent($footerFilePath, $footerContent);
        } catch (Exception $e) {
            print_r('Не удалось создать footer.php: ' . $e->getMessage());
            die;
        }
    }

    /**
     * @throws Exception
     */
    public function makeFrontPageFile()
    {
        try {
            $frontPageFilePath = $this->frontPagePath;
            $destination       = $this->themeDirectoryPath . '/front-page.php';
            $this->copyFile($frontPageFilePath, $destination);
        } catch (Exception $e) {
            print_r('Не удалось создать front-page.php: ' . $e->getMessage());
            die;
        }
    }

    /**
     * @throws Exception
     */
    public function makeFunctionsFile()
    {
        try {
            $functionsFilePath = $this->functionsPath;
            $destination       = $this->themeDirectoryPath . '/functions.php';
            $this->copyFile($functionsFilePath, $destination);
        } catch (Exception $e) {
            print_r('Не удалось создать functions.php: ' . $e->getMessage());
            die;
        }
    }

    /**
     * @throws Exception
     */
    private function makeThemeDirectory()
    {
        try {
            $themeDirectoryName       = $this->formatThemeName();
            $this->themeDirectoryPath = __DIR__ . '/../output/' . $themeDirectoryName;
            $this->makeDirectory($this->themeDirectoryPath);
        } catch (Exception $e) {
            print_r('Не удалось создать директорию темы: ' . $e->getMessage());
            die;
        }
    }

    /**
     * @throws Exception
     */
    private function makeIndexFile()
    {
        try {
            $indexFilePath = $this->themeDirectoryPath . '/index.php';
            $this->makeFile($indexFilePath);
        } catch (Exception $e) {
            print_r('Не удалось создать index.php: ' . $e->getMessage());
            die;
        }
    }

    /**
     * @throws Exception
     */
    private function makeStyleFile()
    {
        try {
            $styleFilePath = $this->themeDirectoryPath . '/style.css';
            $this->makeFile($styleFilePath);
            $css = $this->getContent($this->cssPath);
            $this->putContent($styleFilePath, $css);
        } catch (Exception $e) {
            print_r('Не удалось создать style.css: ' . $e->getMessage());
            die;
        }
    }

    /**
     * @return string
     */
    private function formatThemeName(): string
    {
        return trim(preg_replace('#\s+#', '', strtolower($this->themeName)));
    }

    /**
     * @throws Exception
     */
    private function makeImagesDirectory()
    {
        try {
            $imagesDirectoryPath = $this->themeDirectoryPath . '/images';
            $this->makeDirectory($imagesDirectoryPath);
            $gitignorePath = $imagesDirectoryPath . '/.gitignore';
            $this->makeFile($gitignorePath);
        } catch (Exception $e) {
            print_r('Не удалось создать папку images: ' . $e->getMessage());
            die;
        }
    }
}
