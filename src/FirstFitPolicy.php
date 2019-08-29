<?php

namespace ServerPlanning;

class FirstFitPolicy implements FitPolicy
{
    /** @var int */
    private $availableCpu = 0;
    /** @var int */
    private $availableRam = 0;
    /** @var int */
    private $availableHdd = 0;

    public function __construct(Server $server)
    {
        $this->availableCpu = $server->getCpu();
        $this->availableRam = $server->getRam();
        $this->availableHdd = $server->getHdd();
    }

    public function canFit(VirtualMachine $vm): bool
    {
        $cpu = $this->availableCpu - $vm->getCpu();
        $ram = $this->availableRam - $vm->getRam();
        $hdd = $this->availableHdd - $vm->getHdd();

        if ($cpu >= 0 && $ram >= 0 && $hdd >= 0) {

            $this->availableCpu -= $vm->getCpu();
            $this->availableRam -= $vm->getRam();
            $this->availableHdd -= $vm->getHdd();

            return true;
        } else {
            return false;
        }
    }
}