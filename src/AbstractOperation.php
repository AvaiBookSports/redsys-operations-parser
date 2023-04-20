<?php

declare(strict_types=1);

namespace AvaiBookSports\Component\RedsysOperationsParser;

abstract class AbstractOperation implements OperationInterface
{
    private ?\DateTimeInterface $fechaRemesa = null;

    private ?string $remesa = null;

    private ?string $oficinaRemesa = null;

    private ?\DateTimeInterface $fechaHoraOperacion = null;

    private ?string $tarjeta = null;

    private ?string $tipoTarjeta = null;

    private ?string $autorizacion = null;

    private ?int $tipoOperacion = null;

    private ?float $importeOperacion = null;

    private ?float $tasaDescuento = null;

    private ?float $importeDescuento = null;

    private ?float $importeLiquido = null;

    private ?string $divisa = null;

    private ?string $factura = null;

    private ?float $importeOriginal = null;

    private ?string $codigoRazon = null;

    /**
     * ISO 4217 de 3 letras.
     */
    private ?string $divisaOriginal = null;

    public function getFechaRemesa(): ?\DateTimeInterface
    {
        return $this->fechaRemesa;
    }

    public function setFechaRemesa(?\DateTimeInterface $fechaRemesa): OperationInterface
    {
        $this->fechaRemesa = $fechaRemesa;

        return $this;
    }

    public function getRemesa(): ?string
    {
        return $this->remesa;
    }

    public function setRemesa(?string $remesa): OperationInterface
    {
        $this->remesa = $remesa;

        return $this;
    }

    public function getOficinaRemesa(): ?string
    {
        return $this->oficinaRemesa;
    }

    public function setOficinaRemesa(?string $oficinaRemesa): OperationInterface
    {
        $this->oficinaRemesa = $oficinaRemesa;

        return $this;
    }

    public function getFechaHoraOperacion(): ?\DateTimeInterface
    {
        return $this->fechaHoraOperacion;
    }

    public function setFechaHoraOperacion(?\DateTimeInterface $fechaHoraOperacion): OperationInterface
    {
        $this->fechaHoraOperacion = $fechaHoraOperacion;

        return $this;
    }

    public function getTarjeta(): ?string
    {
        return $this->tarjeta;
    }

    public function setTarjeta(?string $tarjeta): OperationInterface
    {
        $this->tarjeta = $tarjeta;

        return $this;
    }

    public function getTipoTarjeta(): ?string
    {
        return $this->tipoTarjeta;
    }

    public function setTipoTarjeta(?string $tipoTarjeta): OperationInterface
    {
        $this->tipoTarjeta = $tipoTarjeta;

        return $this;
    }

    public function getAutorizacion(): ?string
    {
        return $this->autorizacion;
    }

    public function setAutorizacion(?string $autorizacion): OperationInterface
    {
        $this->autorizacion = $autorizacion;

        return $this;
    }

    public function getTipoOperacion(): ?int
    {
        return $this->tipoOperacion;
    }

    public function setTipoOperacion(?int $tipoOperacion): OperationInterface
    {
        $this->tipoOperacion = $tipoOperacion;

        return $this;
    }

    public function getImporteOperacion(): ?float
    {
        return $this->importeOperacion;
    }

    public function setImporteOperacion(?float $importeOperacion): OperationInterface
    {
        $this->importeOperacion = $importeOperacion;

        return $this;
    }

    public function getTasaDescuento(): ?float
    {
        return $this->tasaDescuento;
    }

    public function setTasaDescuento(?float $tasaDescuento): OperationInterface
    {
        $this->tasaDescuento = $tasaDescuento;

        return $this;
    }

    public function getImporteDescuento(): ?float
    {
        return $this->importeDescuento;
    }

    public function setImporteDescuento(?float $importeDescuento): OperationInterface
    {
        $this->importeDescuento = $importeDescuento;

        return $this;
    }

    public function getImporteLiquido(): ?float
    {
        return $this->importeLiquido;
    }

    public function setImporteLiquido(?float $importeLiquido): OperationInterface
    {
        $this->importeLiquido = $importeLiquido;

        return $this;
    }

    public function getDivisa(): ?string
    {
        return $this->divisa;
    }

    public function setDivisa(?string $divisa): OperationInterface
    {
        $this->divisa = $divisa;

        return $this;
    }

    public function getFactura(): ?string
    {
        return $this->factura;
    }

    public function setFactura(?string $factura): OperationInterface
    {
        $this->factura = $factura;

        return $this;
    }

    public function getImporteOriginal(): ?float
    {
        return $this->importeOriginal;
    }

    public function setImporteOriginal(?float $importeOriginal): OperationInterface
    {
        $this->importeOriginal = $importeOriginal;

        return $this;
    }

    public function getDivisaOriginal(): ?string
    {
        return $this->divisaOriginal;
    }

    public function setDivisaOriginal(?string $divisaOriginal): OperationInterface
    {
        $this->divisaOriginal = $divisaOriginal;

        return $this;
    }

    public function getCodigoRazon(): ?string
    {
        return $this->codigoRazon;
    }

    public function setCodigoRazon(?string $codigoRazon): OperationInterface
    {
        $this->codigoRazon = $codigoRazon;

        return $this;
    }
}
