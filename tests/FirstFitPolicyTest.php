<?php
use PHPUnit\Framework\TestCase;
use ServerPlanning\FirstFitPolicy;
use ServerPlanning\InsufficientResourcesException;
use ServerPlanning\Server;
use ServerPlanning\VirtualMachine;

final class FirstFitPolicyTest extends TestCase
{
    public function test_if_vm_is_too_big(): void
    {
        $serverType = new Server(2, 32, 100);
        $vm = new VirtualMachine(4, 50, 100);
        $policy = new FirstFitPolicy($serverType);

        $this->assertEquals(false, $policy->canFit($vm));
    }

    public function test_if_vm_fit_server(): void
    {
        $server = new Server(2, 16, 10);
        $vm = new VirtualMachine(1, 16, 10);
        $policy = new FirstFitPolicy($server);

        $this->assertEquals(true, $policy->canFit($vm));
    }
}
