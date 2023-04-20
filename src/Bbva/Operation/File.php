<?php

declare(strict_types=1);

namespace AvaiBookSports\Component\RedsysOperationsParser\Bbva\Operation;

use AvaiBookSports\Component\RedsysOperationsParser\AbstractFile;
use AvaiBookSports\Component\RedsysOperationsParser\FileInterface;

final class File extends AbstractFile
{
    /**
     * @var array<Remmitance>
     */
    private array $remmitances = [];

    /**
     * @return array<Remmitance>
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
            throw new \InvalidArgumentException('Parameter must be '.Remmitance::class);
        }

        $this->remmitances[] = $remmitance;

        return $this;
    }
}
