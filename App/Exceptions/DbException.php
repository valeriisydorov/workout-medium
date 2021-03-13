<?php


namespace App\Exceptions;


use Throwable;

/**
 * Class DbException
 * @package App
 */
class DbException extends \Exception
{
    protected $query;

    /**
     * DbException constructor.
     * @param $query
     * @param string $message
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct($query, $message = "", $code = 0, Throwable $previous = null)
    {
        $this->query = $query;
        parent::__construct($message, $code, $previous);
    }

    /**
     * @return string
     */
    public function getQuery(): string
    {
        return $this->query;
    }
}
