<?php

namespace AvaiBookSports\Component\RedsysOperationsParser;

interface OperationInterface
{
    /**
     * Venta si el signo de operación es positivo, anulación de venta si es negativo.
     */
    public const TIPO_OPERACION_VENTA = 5;

    /**
     * Devolución total o parcial si el signo de operación es negativo, anulación de devolución total o parcial si es positivo.
     */
    public const TIPO_OPERACION_DEVOLUCION = 6;

    /**
     * Retrocesión de devolución (+) ordenado por el titular de la tarjeta.
     */
    public const TIPO_OPERACION_RETROCESION_DEVOLUCION = 15;

    /**
     * Chargeback o retrocesión de venta (-) ordenado por el titular de la tarjeta.
     */
    public const TIPO_OPERACION_CHARGEBACK = 16;

    public function getFechaRemesa(): ?\DateTimeInterface;

    /**
     * @param \DateTime|\DateTimeImmutable|null $fechaRemesa
     */
    public function setFechaRemesa(?\DateTimeInterface $fechaRemesa): self;

    public function getRemesa(): ?string;

    public function setRemesa(?string $remesa): self;

    public function getOficinaRemesa(): ?string;

    public function setOficinaRemesa(?string $oficinaRemesa): self;

    public function getFechaHoraOperacion(): ?\DateTimeInterface;

    public function setFechaHoraOperacion(?\DateTimeInterface $fechaHoraOperacion): self;

    public function getTarjeta(): ?string;

    public function setTarjeta(?string $tarjeta): self;

    public function getTipoTarjeta(): ?string;

    public function setTipoTarjeta(?string $tipoTarjeta): self;

    public function getAutorizacion(): ?string;

    public function setAutorizacion(?string $autorizacion): self;

    public function getTipoOperacion(): ?int;

    public function setTipoOperacion(?int $tipoOperacion): self;

    public function getImporteOperacion(): ?float;

    public function setImporteOperacion(?float $importeOperacion): self;

    public function getTasaDescuento(): ?float;

    public function setTasaDescuento(?float $tasaDescuento): self;

    public function getImporteDescuento(): ?float;

    public function setImporteDescuento(?float $importeDescuento): self;

    public function getImporteLiquido(): ?float;

    public function setImporteLiquido(?float $importeLiquido): self;

    /**
     * @return string ISO 4217 de 3 letras
     */
    public function getDivisa(): ?string;

    /**
     * @param ?string $divisa ISO 4217 de 3 letras
     */
    public function setDivisa(?string $divisa): self;

    public function getFactura(): ?string;

    public function setFactura(?string $factura): self;

    public function getImporteOriginal(): ?float;

    public function setImporteOriginal(?float $importeOriginal): self;

    public function getDivisaOriginal(): ?string;

    public function setDivisaOriginal(?string $divisaOriginal): self;

    public function getCodigoRazon(): ?string;

    public function setCodigoRazon(?string $codigoRazon): self;
}
