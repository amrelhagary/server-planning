<?php
namespace ServerPlanning\Exceptions;

class InvalidResourceProvisionException extends \DomainException
{
    public function __construct($resource, $value)
    {
        parent::__construct("$resource must be > 0. $value given ");
    }
}