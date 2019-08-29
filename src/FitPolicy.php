<?php
namespace ServerPlanning;

interface FitPolicy
{
    public function canFit(VirtualMachine $vm): bool;
}