<?php

namespace ZnYii\Error\Domain\Entities;

use Exception;

class ErrorEntity
{

	private $name;
	private $message;
	private $exception;

    public function getName(): ?string
    {
        return $this->title;
    }

    public function setName(string $name): void
    {
        $this->title = $name;
    }

    public function getMessage(): ?string
    {
        return $this->content;
    }

    public function setMessage(string $message): void
    {
        $this->content = $message;
    }

    public function getException(): Exception
    {
        return $this->exception;
    }

    public function setException(Exception $exception): void
    {
        $this->exception = $exception;
    }
}
