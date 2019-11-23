<?php

declare(strict_types = 1);

namespace WpThemeGenerator\Generators;

use Exception;

class Generator
{
    /**
     * @param string $fileName
     * @throws Exception
     */
    protected function makeFile(string $fileName)
    {
        try {
            $fp = $this->openFile($fileName);
            $this->closeFile($fp);
        } catch (Exception $e) {
            print_r($e->getMessage());
            die;
        }
    }

    /**
     * @param string $pathname
     * @throws Exception
     */
    protected function makeDirectory(string $pathname)
    {
        if (! mkdir($pathname) || ! chmod($pathname, 0777)) {
            throw new Exception('не удалось создать папку: ' . $pathname . PHP_EOL);
        }
    }

    /**
     * @param string $filename
     * @return string
     * @throws Exception
     */
    protected function getContent(string $filename): string
    {
        if (! $content = file_get_contents($filename)) {
            throw new Exception('не удалось получить содержимое файла: ' . $filename . PHP_EOL);
        }
        return $content;
    }

    /**
     * @param string $filename
     * @param string $data
     * @throws Exception
     */
    protected function putContent(string $filename, string $data)
    {
        if (! file_put_contents($filename, $data)) {
            throw new Exception('не удалось записать содержимое в файл: ' . $filename . PHP_EOL);
        }
    }

    /**
     * @param string $source
     * @param string $dest
     * @throws Exception
     */
    protected function copyFile(string $source, string $dest)
    {
        if (! copy($source, $dest)) {
            throw new Exception('не удалось скопировать файл: ' . $source . PHP_EOL);
        }
    }

    /**
     * @param string $filename
     * @param string $mode
     * @return resource
     * @throws Exception
     */
    private function openFile(string $filename, string $mode = 'w')
    {
        if (! ($fp = fopen($filename, $mode)) || ! chmod($filename, 0777)) {
            throw new Exception('не удалось открыть файл: ' . $filename . PHP_EOL);
        }
        return $fp;
    }

    /**
     * @param $handle
     * @throws Exception
     */
    private function closeFile($handle)
    {
        if (! fclose($handle)) {
            throw new Exception('не удалось закрыть файл: ' . $handle . PHP_EOL);
        }
    }
}
