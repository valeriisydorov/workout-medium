<?php


namespace App\Exceptions;;


class MultiException extends \Exception
{
    protected $errors = [];

    public function add(\Exception $e): void
    {
        $this->errors[] = $e;
    }

    public function all(): array
    {
        return $this->errors;
    }

    public function isEmpty(): bool
    {
        return empty($this->errors);
    }
}
