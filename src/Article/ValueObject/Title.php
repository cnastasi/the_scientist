<?php

namespace LaravelDay\Article\ValueObject;


use LaravelDay\Article\ValueObject\Exception\TitleTooShort;

final class Title
{
    /**
     * @var string
     */
    private $title;

    public function __construct(string $title)
    {
        if (strlen($title) < 10) {
            throw new TitleTooShort('Title too short');
        }

        $this->title = $title;
    }

    public function isEqual(Title $title) {
        return (string)$title === $this->__toString();
    }

    public function __toString()
    {
        return $this->title;
    }

    private function __clone()
    {

    }
}