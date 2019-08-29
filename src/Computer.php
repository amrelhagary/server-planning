<?php
namespace ServerPlanning;

interface Computer
{
    public function getCpu(): int;

    public function setCpu(int $cpu);

    public function getRam(): int;

    public function setRam(int $ram);

    public function getHdd(): int;

    public function setHdd(int $hdd);
}