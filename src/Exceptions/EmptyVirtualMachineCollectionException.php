<?php
namespace ServerPlanning\Exceptions;

class EmptyVirtualMachineCollectionException extends \DomainException
{
    public function __construct()
    {
        parent::__construct("Empty Virtual Machine Collection");
    }
}