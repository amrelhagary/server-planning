<?php

namespace ServerPlanning;

use ServerPlanning\Exceptions\EmptyVirtualMachineCollectionException;

class ServerPlanning
{
    /**
     * @param Server $serverType
     * @param VirtualMachine[] $virtualMachines
     * @return int
     */
    public function calculate(Server $server, array $vms)
    {
        if (count($vms) == 0) {
            throw new EmptyVirtualMachineCollectionException();
        }
        
        $policy = new FirstFitPolicy($server);
        $count = 0;

        foreach ($vms as $vm) {
            if ($policy->canFit($vm)) {
                $count++;
            }
        }

        return $count;
    }
}
