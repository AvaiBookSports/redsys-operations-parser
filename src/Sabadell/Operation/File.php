<?php

declare(strict_types=1);

namespace AvaiBookSports\Component\RedsysOperationsParser\Sabadell\Operation;

use AvaiBookSports\Component\RedsysOperationsParser\AbstractFile;
use AvaiBookSports\Component\RedsysOperationsParser\FileInterface;

final class File extends AbstractFile
{
    /**
     * @var Remmitance[]
     */
    private array $remmitances = [];

    /**
     * @return Remmitance[]
     */
    public function getRemmitances(): array
    {
        return $this->remmitances;
    }

    /**
     * @psalm-suppress MoreSpecificImplementedParamType
     * @psalm-suppress DocblockTypeContradiction
     *
     * @param Remmitance $remmitance
     *
     * @return self
     */
    public function addRemmitance($remmitance): FileInterface
    {
        if (!($remmitance instanceof Remmitance)) {
            throw new \InvalidArgumentException('Array must contain only '.Remmitance::class.' instances');
        }

        $this->remmitances[] = $remmitance;

        return $this;
    }
}
