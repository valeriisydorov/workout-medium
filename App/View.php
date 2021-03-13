<?php


namespace App;

/**
 * Class View
 * @package App
 */
class View implements \Countable, \ArrayAccess, \Iterator
{
    use SetAndGetArbitraryProperties;

    /**
     * @param $template
     * @return string
     */
    public function render($template): string
    {
        ob_start();
        include $template;
        $content = ob_get_contents();
        ob_end_clean();
        return $content;
    }

    /**
     * @param $template
     */
    public function display($template): void
    {
        echo $this->render($template);
    }

    /**
     * @return int
     */
    public function count(): int
    {
        return count($this->data);
    }

    public function current()
    {
        return current($this->data);
    }

    public function key()
    {
        return key($this->data);
    }

    public function next(): void
    {
        next($this->data);
    }

    public function rewind(): void
    {
        reset($this->data);
    }

    public function valid(): bool
    {
        return null !== key($this->data);
    }
}
