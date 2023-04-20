<?php

declare(strict_types=1);

namespace AvaiBookSports\Component\RedsysOperationsParser\Sabadell\Operation;

use AvaiBookSports\Component\RedsysOperationsParser\AbstractOperation;
use AvaiBookSports\Component\RedsysOperationsParser\OperationInterface;

final class Operation extends AbstractOperation
{
    // Tipo de tarjeta
    const TIPO_TARJETA_MAESTRO_PARTICULARES = 'AP';

    const TIPO_TARJETA_VISAELECTRON_PARTICULARES = 'EP';

    const TIPO_TARJETA_GASOLEO = 'GD';

    const TIPO_TARJETA_B2B_SECTOR_TURISMO = 'MB';

    const TIPO_TARJETA_MASTERCARD_DESCONOCIDA = 'MD';

    const TIPO_TARJETA_MASTERCARD_EMPRESAS = 'ME';

    const TIPO_TARJETA_MASTERCARD_PARTICULARES = 'MP';

    const TIPO_TARJETA_VPAY = 'PP';

    const TIPO_TARJETA_UNION_PAY = 'UP';

    const TIPO_TARJETA_VISA_DESCONOCIDA = 'VD';

    const TIPO_TARJETA_VISA_EMPRESAS = 'VE';

    const TIPO_TARJETA_VISA_PARTICULARES = 'VP';

    const TIPO_TARJETA_ALIPAY = 'AA';

    const TIPO_TARJETA_BIZUM = 'BB';

    const MARCA_TARJETA_OTRAS = 'OD';

    // Modalidades de pago
    const MODALIDAD_PAGO_CREDITO = 'C';

    const MODALIDAD_PAGO_DEBITO = 'D';

    const MODALIDAD_PAGO_ALIPAY = 'A';

    const MODALIDAD_PAGO_BIZUM = 'B';

    // Entidades emisoras de la tarjeta
    const BANCO_SABADELL = 'P';

    const NACIONAL_SISTEMA_SERVIRED = 'N';

    const NACIONAL_RESTO_SISTEMAS = 'R';

    const INTERNACIONAL_ZONA_EURO = 'E';

    const INTERNACIONAL_RESTO = 'I';

    const OTRA = 'X';

    const CAPTURA_OPERACION_ONLINE = 'ON';

    const CAPTURA_OPERACION_OFFLINE = 'OFF';

    /**
     * C – Crédito
     * D – Débito
     * A – AliPay
     * B – BIZUM.
     */
    private ?string $modalidadPago = null;

    /**
     * P - Banco Sabadell
     * N - Nacional sistema Servired
     * R - Nacional resto sistemas
     * E - Internacional zona euro
     * I - Internacional resto
     * X - Otra.
     */
    private ?string $entidadEmisoraTarjeta = null;

    /**
     * ON - Online
     * OFF - Offline.
     */
    private ?string $capturaOperacion = null;

    private ?string $tpv = null;

    private ?string $arn = null;

    private ?float $gastos = null;

    private ?string $numeroOperacion = null;

    public function getModalidadPago(): ?string
    {
        return $this->modalidadPago;
    }

    /**
     * @return self
     */
    public function setModalidadPago(?string $modalidadPago): OperationInterface
    {
        $this->modalidadPago = $modalidadPago;

        return $this;
    }

    public function getEntidadEmisoraTarjeta(): ?string
    {
        return $this->entidadEmisoraTarjeta;
    }

    /**
     * @return self
     */
    public function setEntidadEmisoraTarjeta(?string $entidadEmisoraTarjeta): OperationInterface
    {
        $this->entidadEmisoraTarjeta = $entidadEmisoraTarjeta;

        return $this;
    }

    public function getCapturaOperacion(): ?string
    {
        return $this->capturaOperacion;
    }

    /**
     * @return self
     */
    public function setCapturaOperacion(?string $capturaOperacion): OperationInterface
    {
        $this->capturaOperacion = $capturaOperacion;

        return $this;
    }

    public function getTpv(): ?string
    {
        return $this->tpv;
    }

    /**
     * @return self
     */
    public function setTpv(?string $tpv): OperationInterface
    {
        $this->tpv = $tpv;

        return $this;
    }

    public function getArn(): ?string
    {
        return $this->arn;
    }

    /**
     * @return self
     */
    public function setArn(?string $arn): OperationInterface
    {
        $this->arn = $arn;

        return $this;
    }

    public function getGastos(): ?float
    {
        return $this->gastos;
    }

    /**
     * @return self
     */
    public function setGastos(?float $gastos): OperationInterface
    {
        $this->gastos = $gastos;

        return $this;
    }

    public function getNumeroOperacion(): ?string
    {
        return $this->numeroOperacion;
    }

    /**
     * @return self
     */
    public function setNumeroOperacion(?string $numeroOperacion): OperationInterface
    {
        $this->numeroOperacion = $numeroOperacion;

        return $this;
    }
}
