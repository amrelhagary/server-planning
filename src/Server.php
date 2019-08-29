<?php
namespace ServerPlanning;
use ServerPlanning\Exceptions\InvalidResourceProvisionException;

class Server implements Computer
{

    private $cpu;
    private $ram;
    private $hdd;

    public function  __construct($cpu, $ram, $hdd)
    {
        $this->cpu = self::validateResource('CPU', $cpu);
        $this->ram = self::validateResource('RAM', $ram);
        $this->hdd = self::validateResource('HDD', $hdd);
    }

    public function getCpu(): int
    {
        return $this->cpu;
    }

    public function setCpu(int $cpu)
    {
        $this->cpu = $cpu;
    }

    public function getRam(): int
    {
        return $this->ram;
    }

    public function setRam(int $ram)
    {
        $this->ram = $ram;
    }

    public function getHdd(): int
    {
        return $this->hdd;
    }

    public function setHdd(int $hdd)
    {
        $this->hdd = $hdd;
    }

    private static function validateResource($resource, $input)
    {
        $value = filter_var($input, FILTER_VALIDATE_INT, [
            'options' => [
                'min_range' => 1
            ],
        ]);

        if (!$value) {
            throw new InvalidResourceProvisionException($resource, $value);
        }

        return $value;
    }
}