<?php

declare(strict_types=1);

namespace AvaiBookSports\Component\RedsysOperationsParser\Bbva\Operation;

use AvaiBookSports\Component\RedsysOperationsParser\AbstractRemmitance;
use AvaiBookSports\Component\RedsysOperationsParser\RemmitanceInterface;

final class Remmitance extends AbstractRemmitance
{
    /**
     * @var Operation[]
     */
    private array $operations = [];

    private ?string $bancoContrato = null;

    private ?string $oficinaContrato = null;

    private ?string $contrapartidaContrato = null;

    private ?string $folioContrato = null;

    private ?string $entidadCuenta = null;

    private ?string $oficinaCuenta = null;

    private ?string $contrapartidaCuenta = null;

    private ?string $folioCuenta = null;

    private ?int $contrato = null;

    private ?string $cuenta = null;

    private ?string $ibanCuentaAbonoComercio = null;

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
    public function setOperations($operations): RemmitanceInterface
    {
        if (!\is_array($operations)) {
            throw new \InvalidArgumentException('First parameter must be an array');
        }

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

    public function getBancoContrato(): ?string
    {
        return $this->bancoContrato;
    }

    /**
     * @return self
     */
    public function setBancoContrato(?string $bancoContrato): RemmitanceInterface
    {
        $this->bancoContrato = $bancoContrato;

        return $this;
    }

    public function getOficinaContrato(): ?string
    {
        return $this->oficinaContrato;
    }

    /**
     * @return self
     */
    public function setOficinaContrato(?string $oficinaContrato): RemmitanceInterface
    {
        $this->oficinaContrato = $oficinaContrato;

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

    public function getContrapartidaContrato(): ?string
    {
        return $this->contrapartidaContrato;
    }

    /**
     * @return self
     */
    public function setContrapartidaContrato(?string $contrapartidaContrato): RemmitanceInterface
    {
        $this->contrapartidaContrato = $contrapartidaContrato;

        return $this;
    }

    public function getFolioContrato(): ?string
    {
        return $this->folioContrato;
    }

    /**
     * @return self
     */
    public function setFolioContrato(?string $folioContrato): RemmitanceInterface
    {
        $this->folioContrato = $folioContrato;

        return $this;
    }

    public function getEntidadCuenta(): ?string
    {
        return $this->entidadCuenta;
    }

    /**
     * @return self
     */
    public function setEntidadCuenta(?string $entidadCuenta): RemmitanceInterface
    {
        $this->entidadCuenta = $entidadCuenta;

        return $this;
    }

    public function getOficinaCuenta(): ?string
    {
        return $this->oficinaCuenta;
    }

    /**
     * @return self
     */
    public function setOficinaCuenta(?string $oficinaCuenta): RemmitanceInterface
    {
        $this->oficinaCuenta = $oficinaCuenta;

        return $this;
    }

    public function getContrapartidaCuenta(): ?string
    {
        return $this->contrapartidaCuenta;
    }

    /**
     * @return self
     */
    public function setContrapartidaCuenta(?string $contrapartidaCuenta): RemmitanceInterface
    {
        $this->contrapartidaCuenta = $contrapartidaCuenta;

        return $this;
    }

    public function getFolioCuenta(): ?string
    {
        return $this->folioCuenta;
    }

    /**
     * @return self
     */
    public function setFolioCuenta(?string $folioCuenta): RemmitanceInterface
    {
        $this->folioCuenta = $folioCuenta;

        return $this;
    }

    public function getIbanCuentaAbonoComercio(): ?string
    {
        return $this->ibanCuentaAbonoComercio;
    }

    /**
     * @return self
     */
    public function setIbanCuentaAbonoComercio(?string $ibanCuentaAbonoComercio): RemmitanceInterface
    {
        $this->ibanCuentaAbonoComercio = $ibanCuentaAbonoComercio;

        return $this;
    }
}
