<?php

declare(strict_types=1);

namespace AvaiBookSports\Component\RedsysOperationsParser\Bbva\Operation;

use AvaiBookSports\Component\RedsysOperationsParser\AbstractOperation;
use AvaiBookSports\Component\RedsysOperationsParser\OperationInterface;

final class Operation extends AbstractOperation
{
    // Tipo de tarjeta
    public const TIPO_TARJETA_PROPIA_DEBITO = 'PD';

    public const TIPO_TARJETA_PROPIA_CREDITO = 'PC';

    public const TIPO_TARJETA_SERVIRED_DEBITO = 'SD';

    public const TIPO_TARJETA_SERVIRED_CREDITO = 'SC';

    public const TIPO_TARJETA_EURO6000_DEBITO = '6D';

    public const TIPO_TARJETA_EURO6000_CRÉDITO = '6C';

    public const TIPO_TARJETA_4B_DEBITO = '4D';

    public const TIPO_TARJETA_4B_CRÉDITO = '4C';

    public const TIPO_TARJETA_EUROPEAS_DEBITO = 'ED';

    public const TIPO_TARJETA_EUROPEAS_CREDITO = 'EC';

    public const TIPO_TARJETA_RESTO_DEBITO = 'RD';

    public const TIPO_TARJETA_RESTO_CRÉDITO = 'RC';

    // // Modalidades de pago
    // const MODALIDAD_PAGO_CREDITO = 'C';
    // const MODALIDAD_PAGO_DEBITO = 'D';
    // const MODALIDAD_PAGO_ALIPAY = 'A';
    // const MODALIDAD_PAGO_BIZUM = 'B';

    // // Entidades emisoras de la tarjeta
    // const BANCO_SABADELL = 'P';
    // const NACIONAL_SISTEMA_SERVIRED = 'N';
    // const NACIONAL_RESTO_SISTEMAS = 'R';
    // const INTERNACIONAL_ZONA_EURO = 'E';
    // const INTERNACIONAL_RESTO = 'I';
    // const OTRA = 'X';

    // Tipos de operación
    public const TIPO_OPERACION_ANULACION_VENTA = 25;

    public const TIPO_OPERACION_ANULACION_DEVOLUCION = 26;

    public const TIPO_OPERACION_REPRESENTACION_ANULACION_CHARGEBACK = 35;

    public const TIPO_OPERACION_PREARBITRAJE_CARGADO = 36;

    private ?string $datosOperacion = null;

    private ?bool $dcc = null;

    public function getDatosOperacion(): ?string
    {
        return $this->datosOperacion;
    }

    /**
     * @return self
     */
    public function setDatosOperacion(?string $datosOperacion): OperationInterface
    {
        $this->datosOperacion = $datosOperacion;

        return $this;
    }

    public function getDcc(): ?bool
    {
        return $this->dcc;
    }

    /**
     * @return self
     */
    public function setDcc(?bool $dcc): OperationInterface
    {
        $this->dcc = $dcc;

        return $this;
    }
}
