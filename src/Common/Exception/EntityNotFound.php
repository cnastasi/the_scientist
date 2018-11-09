<?php

namespace Acme\Common\Exception;

interface EntityNotFound extends \Throwable
{
    public function getEntityName(): string;

    public function getEntityId(): string;
}