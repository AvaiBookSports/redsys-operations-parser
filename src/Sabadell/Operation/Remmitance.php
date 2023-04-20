<?php

declare(strict_types=1);

namespace AvaiBookSports\Component\RedsysOperationsParser\Sabadell\Operation;

use AvaiBookSports\Component\RedsysOperationsParser\AbstractRemmitance;
use AvaiBookSports\Component\RedsysOperationsParser\RemmitanceInterface;

final class Remmitance extends AbstractRemmitance
{
    /**
     * @var Operation[]
     */
    private array $operations = [];

    private ?int $contrato = null;

    private ?string $cuenta = null;

    /**
     * @return Operation[]
     */
    public function getOperations(): array
    {
        return $this->operations;
    }

    /**
     * @psalm-suppress MoreSpecificImplementedParamType
     * @psalm-suppress DocblockTypeContradiction
     *
     * @param Operation[] $operations
     *
     * @return self
     */
    public function setOperations(array $operations): RemmitanceInterface
    {
        foreach ($operations as $operation) {
            if (!($operation instanceof Operation)) {
                throw new \InvalidArgumentException('Array must contain only '.Operation::class.' instances');
            }
        }

        $this->operations = $operations;

        return $this;
    }

    /**
     * @psalm-suppress MoreSpecificImplementedParamType
     * @psalm-suppress DocblockTypeContradiction
     *
     * @param Operation $operation
     *
     * @return self
     */
    public function addOperation($operation): RemmitanceInterface
    {
        if (!($operation instanceof Operation)) {
            throw new \InvalidArgumentException('Parameter must be '.Operation::class);
        }

        $this->operations[] = $operation;

        return $this;
    }

    public function getContrato(): ?int
    {
        return $this->contrato;
    }

    /**
     * @return self
     */
    public function setContrato(?int $contrato): RemmitanceInterface
    {
        $this->contrato = $contrato;

        return $this;
    }

    public function getCuenta(): ?string
    {
        return $this->cuenta;
    }

    /**
     * @return self
     */
    public function setCuenta(?string $cuenta): RemmitanceInterface
    {
        $this->cuenta = $cuenta;

        return $this;
    }
}
