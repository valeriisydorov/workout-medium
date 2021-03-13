<?php


namespace App\Models;


trait CreateLogFile
{
    protected $dirPath;
    protected $filePath;

    /**
     * @return bool
     */
    protected function createDirectory():bool
    {
        if (file_exists($this->dirPath)) {
            return is_writable($this->dirPath);
        }

        if (is_writable(dirname($this->dirPath))) {
            if (mkdir($this->dirPath, 0777, true)) {
                return true;
            }
        }
        return false;
    }

    /**
     * @return bool
     */
    protected function createFile():bool
    {
        if (file_exists($this->filePath)) {
            return is_writable($this->filePath);
        }

        if ($this->createDirectory() && $handle = fopen($this->filePath, 'a')) {
            fclose($handle);
            return true;
        }
        return false;
    }
}
