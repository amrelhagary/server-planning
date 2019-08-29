<?php

use PHPUnit\Framework\TestCase;
use ServerPlanning\Exceptions\EmptyVirtualMachineCollectionException;
use ServerPlanning\Server;
use ServerPlanning\ServerPlanning;
use ServerPlanning\VirtualMachine;

final class ServerPlanningTest extends TestCase
{
    public function test_needs_1_server_if_2_VirtualMachines_fits_server(): void
    {
        $planner = new ServerPlanning();
        $server = new Server(2, 32, 100);
        $vms = [
            new VirtualMachine(1, 16, 10),
            new VirtualMachine(1, 16, 10),
        ];

        $this->assertEquals(2, $planner->calculate($server, $vms));
    }

    public function test_needs_0_servers_if_VirtualMachines_list_is_empty(): void
    {
        $planner = new ServerPlanning();
        $server = new Server(1, 1, 1);

        $this->expectException(EmptyVirtualMachineCollectionException::class);

        $planner->calculate($server, []);
    }

    public function test_needs_1_server_if_VirtualMachine_fits_server(): void
    {
        $planner = new ServerPlanning();
        $server = new Server(2, 32, 100);
        $vm = new VirtualMachine(1, 16, 10);

        $this->assertEquals(1, $planner->calculate($server, [$vm]));
    }

    public function test_needs_2_servers_when_server_can_host_biggest_vm(): void
    {
        $planner = new ServerPlanning();
        $server = new Server(2, 32, 100);
        $vms = [
            new VirtualMachine(1, 16, 10),
            new VirtualMachine(1, 16, 10),
            new VirtualMachine(2, 32, 100),
        ];

        $this->assertEquals(2, $planner->calculate($server, $vms));
    }

    /**
     * @dataProvider bigVms
     */
    public function test_needs_2_server_if_one_vm_is_big(VirtualMachine $vm): void
    {
        $planner = new ServerPlanning();
        $server = new Server(2, 32, 100);
        $vms = [
            new VirtualMachine(4, 32, 100),
            new VirtualMachine(1, 16, 10),
            new VirtualMachine(1, 16, 10),
        ];

        $this->assertEquals(2, $planner->calculate($server, $vms));
    }

    public function bigVms()
    {
        return [
            [new VirtualMachine(4, 32, 100)],
            [new VirtualMachine(1, 16, 10)],
            [new VirtualMachine(1, 16, 10)],
        ];
    }
}