<?php

declare(strict_types=1);

namespace AvaiBookSports\Component\RedsysOperationsParser\Bbva;

use AvaiBookSports\Component\RedsysOperationsParser\AbstractOperationParser;
use AvaiBookSports\Component\RedsysOperationsParser\Bbva\Operation\File;
use AvaiBookSports\Component\RedsysOperationsParser\Bbva\Operation\Operation;
use AvaiBookSports\Component\RedsysOperationsParser\Bbva\Operation\Remmitance;
use AvaiBookSports\Component\RedsysOperationsParser\Exception\InvalidLineLengthException;
use AvaiBookSports\Component\RedsysOperationsParser\Exception\ParserException;
use AvaiBookSports\Component\RedsysOperationsParser\Reader;

/**
 * @method File[] getFiles()
 */
class OperationsParser extends AbstractOperationParser
{
    const LINE_LENGTH = 350;

    const ENTRY_FILE_START = '10';

    const ENTRY_FILE_END = '90';

    const ENTRY_REMMITANCE_START = '00';

    const ENTRY_REMMITANCE_END = '99';

    const ENTRY_OPERATION = '01';

    /**
     * @throws InvalidLineLengthException if a line has an unexpected length
     * @throws ParserException            if there is any parsing or structure error
     */
    public function bootstrap(): void
    {
        $file = null;
        $remmitance = null;
        $lastEntry = null;
        $line = 0;

        foreach ($this->getRawLines() as $content) {
            if (empty($content)) {
                continue;
            }

            $reader = new Reader($content);

            if (self::LINE_LENGTH != mb_strlen($content)) {
                throw new InvalidLineLengthException('Se esperaba una línea con '.self::LINE_LENGTH.' caracteres, se encontraron '.mb_strlen($content).' en la línea '.($line + 1).': "'.$content.'"');
            }

            $entry = $reader->read(0, 2);

            if (empty($lastEntry) && self::ENTRY_FILE_START != $entry) {
                throw new ParserException('Entrada '.($entry ?? 'NULL').' inesperada en la línea '.($line + 1).', se esperaba '.self::ENTRY_FILE_START.': "'.$content.'"');
            }

            if (self::ENTRY_FILE_START == $entry) {
                if (!empty($lastEntry) && self::ENTRY_FILE_END != $lastEntry) {
                    throw new ParserException('Comienzo de fichero inesperado en la linea '.($line + 1).': "'.$content.'"');
                }

                $file = new File();

                $file->setFechaProceso($reader->readDateTime('!d-m-Y', 2, 10));
                $file->setFechaInicio($reader->readDateTime('!d-m-Y', 12, 10));
                $file->setFechaFinal($reader->readDateTime('!d-m-Y', 22, 10));

                $this->addFile($file);
            }

            if (self::ENTRY_FILE_END == $entry) {
                // TODO: Comprobar que el número de comercios, número de operaciones,y el importe cuadren

                $file = null;
            }

            if (self::ENTRY_REMMITANCE_START == $entry) {
                if (empty($file)) {
                    throw new ParserException('Entrada '.$entry.' inesperada en la línea '.($line + 1).', se esperaba '.self::ENTRY_FILE_START.': "'.$content.'"');
                }

                if (!empty($remmitance)) {
                    throw new ParserException('Comienzo de remesa inesperado en la línea '.($line + 1).': "'.$content.'"');
                }

                $remmitance = new Remmitance();

                $remmitance->setBancoContrato($reader->read(2, 4));
                $remmitance->setOficinaContrato($reader->read(6, 4));
                $remmitance->setContrapartidaContrato($reader->read(10, 4));
                $remmitance->setFolioContrato($reader->read(14, 14));
                $remmitance->setComercio($reader->readInt(28, 10));
                $remmitance->setEntidadCuenta($reader->read(38, 4));
                $remmitance->setOficinaCuenta($reader->read(42, 4));
                $remmitance->setContrapartidaCuenta($reader->read(46, 4));
                $remmitance->setFolioCuenta($reader->read(50, 14));
                $remmitance->setOficinaGestora($reader->read(64, 4));
                $remmitance->setFechaProceso($reader->readDateTime('!d-m-Y', 68, 10));
                $remmitance->setFechaInicio($reader->readDateTime('!d-m-Y', 78, 10));
                $remmitance->setFechaFinal($reader->readDateTime('!d-m-Y', 88, 10));
                $remmitance->setIbanCuentaAbonoComercio($reader->read(98, 24));

                $file->addRemmitance($remmitance);
            }

            if (self::ENTRY_REMMITANCE_END == $entry) {
                if (empty($remmitance)) {
                    throw new ParserException('Entrada '.$entry.' inesperada en la línea '.($line + 1).': "'.$content.'"');
                }

                $remmitance = null;
            }

            if (self::ENTRY_OPERATION == $entry) {
                if (empty($remmitance)) {
                    throw new ParserException('Entrada '.$entry.' inesperada en la línea '.($line + 1).': "'.$content.'"');
                }

                $operation = new Operation();

                $operation->setFechaRemesa($reader->readDateTime('!d-m-Y', 2, 10));
                $operation->setRemesa($reader->read(12, 20));
                $operation->setOficinaRemesa($reader->read(32, 4));  // Subremesa?
                $operation->setFechaHoraOperacion($reader->readDateTime('ymdHis', 36, 12));
                // Identificador adquirente
                // Identificador Transacción
                $operation->setTarjeta($reader->read(65, 22));
                $operation->setTipoTarjeta($reader->read(87, 2));

                if ($operation->getFechaHoraOperacion() != $reader->readDateTime('d-m-YHis', 89, 16)) {
                    throw new ParserException('Se ha identificado una inconsistencia de fecha/hora de la operación en la línea '.($line + 1).': "'.$content.'"');
                }

                $operation->setAutorizacion($reader->read(105, 6));
                $operation->setTipoOperacion($reader->readInt(111, 2));
                // Modalidad de captura
                $operation->setImporteOperacion($reader->readFloat(116, 11, 100));
                $operation->setTasaDescuento($reader->readFloat(127, 5, 100));
                $operation->setImporteDescuento($reader->readFloat(132, 9, 100));
                $operation->setImporteLiquido($reader->readFloat(150, 13, 100));
                // Número de TPV
                $operation->setDivisa($reader->read(174, 3));
                $operation->setFactura($reader->read(177, 12));

                // Código de razón

                $operation->setImporteOriginal($reader->readFloat(193, 13, 100));

                $operation->setDivisaOriginal($reader->read(206, 3));
                $operation->setDatosOperacion($reader->read(209, 35));

                if ('S' == $reader->read(245, 1)) {
                    $operation->setDcc(true);
                } elseif ('N' == $reader->read(245, 1)) {
                    $operation->setDcc(false);
                }

                $remmitance->addOperation($operation);
            }

            $lastEntry = $entry;
            ++$line;
        }
    }
}
