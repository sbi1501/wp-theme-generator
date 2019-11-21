<?php

declare(strict_types = 1);

namespace WpThemeGenerator;

require 'Generator.php'; //todo remove
use Exception;

class ThemeGenerator extends Generator
{
//    private $themeDirectoryPath = __DIR__ . '/unnamed';
//
//    /**
//     * ThemeGenerator constructor.
//     *
//     * @param string $themeName
//     */
//    public function __construct(string $themeName)
//    {
//        $this->themeName = $themeName;
//    }
//
//    public function init(): void
//    {
//        try {
//            $themeDirectoryName       = $this->createThemeDirectoryName($this->themeName);
//            $themeDirectoryPath       = __DIR__ . '/' . $themeDirectoryName;
//            $this->themeDirectoryPath = $themeDirectoryPath;
//            $this->createThemeDirectory($themeDirectoryPath);
//            $this->createIndex();
//            $this->createStyle();
//            $this->createImagesDirectory();
//        } catch (Exception $e) {
//            echo $e->getMessage() . PHP_EOL;
//        }
//    }
//
//    public function createFooter()
//    {
//
//    }
//
//    public function createHeader()
//    {
//
//    }
//
//    public function createFrontPage()
//    {
//
//    }
//
//    public function createFunctions()
//    {
//
//    }
//
//    /**
//     * @param string $path
//     * @throws Exception
//     */
//    private function createThemeDirectory(string $path): void
//    {
//        if (! mkdir($path)) {
//            throw new Exception('Не удалось создать папку с темой');
//        }
//    }
//
//    /**
//     * @throws Exception
//     */
//    private function createIndex(): void
//    {
//        $indexFilePath = $this->themeDirectoryPath . '/index.php';
//        $this->makeFile($indexFilePath);
//    }
//
//    /**
//     * @throws Exception
//     */
//    private function createStyle()
//    {
//        $styleFilePath = $this->themeDirectoryPath . '/style.css';
//        $this->makeFile($styleFilePath);
//    }
//
//    private function createImagesDirectory()
//    {
//        $imagesDirectoryPath = $this->themeDirectoryPath . '/images';
//    }
//

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
    private $htmlPath = '';

    private $cssPath = '';

    public function __construct(string $themeName = 'unnamed')
    {
        $this->themeName = $themeName;
        $this->htmlPath  = __DIR__ . '/data/index.html';
        $this->cssPath   = __DIR__ . '/data/style.css';
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
            throw $e; //todo писать в логи
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
            $html = $this->getContent($this->htmlPath);
            $this->putContent($headerFilePath, $html);
        } catch (Exception $e) {
            throw $e;
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
            //fill header html
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * @throws Exception
     */
    public function makePageFile()
    {
        try {
            $pageFilePath = $this->themeDirectoryPath . '/page.php';
            $this->makeFile($pageFilePath);
            //fill header html
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * @throws Exception
     */
    public function makeFunctionsFile()
    {
        try {
            $functionsFilePath = $this->themeDirectoryPath . '/functions.php';
            $this->makeFile($functionsFilePath);
            //fill header html
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * @throws Exception
     */
    private function makeThemeDirectory()
    {
        $themeDirectoryName       = $this->makeThemeDirectoryName();
        $this->themeDirectoryPath = __DIR__ . '/' . $themeDirectoryName;
        $this->makeDirectory($this->themeDirectoryPath);
    }

    /**
     * @throws Exception
     */
    private function makeIndexFile()
    {
        $indexFilePath = $this->themeDirectoryPath . '/index.php';
        $this->makeFile($indexFilePath);
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
            throw $e;
        }
    }

    /**
     * @return string
     */
    private function makeThemeDirectoryName(): string
    {
        return trim(preg_replace('#\s+#', '', strtolower($this->themeName)));
    }

    /**
     * @throws Exception
     */
    private function makeImagesDirectory()
    {
        $imagesDirectoryPath = $this->themeDirectoryPath . '/images';
        $this->makeDirectory($imagesDirectoryPath);
        $gitignorePath = $imagesDirectoryPath . '/.gitignore';
        $this->makeFile($gitignorePath);
    }
}
