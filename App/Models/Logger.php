<?php


namespace App\Models;

/**
 * Class Logger
 * @package App\Models
 */
class Logger
{
    use CreateLogFile;

    /**
     * Logger constructor.
     * @param \Exception $exception
     */
    public function __construct(\Exception $exception)
    {
        $this->dirPath = __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'Logs';
        $this->filePath = $this->dirPath . DIRECTORY_SEPARATOR . 'exception.log';
        $this->createRecord($exception);
    }

    protected function createRecord(\Exception $exception):void
    {
        if ($this->createFile()) {
            $handle = fopen($this->filePath, 'a');
            fwrite ($handle , $this->prepareRecord($exception));
            fclose($handle);
        }
    }

    /**
     * @param $exception
     * @return string
     */
    protected function prepareRecord($exception):string
    {
        $str = 'Date: ' . date('Y-m-d H:i:s');
        $str .= ' Message: ' . $exception->getMessage();
        $str .= ' File: ' . $exception->getFile();
        $str .= ' Line: ' . $exception->getLine();
        $str .= PHP_EOL;
        return $str;
    }
}

