<?php

declare(strict_types=1);

namespace AvaiBookSports\Component\RedsysOperationsParser\Sabadell;

use AvaiBookSports\Component\RedsysOperationsParser\AbstractOperationParser;
use AvaiBookSports\Component\RedsysOperationsParser\Exception\InvalidLineLengthException;
use AvaiBookSports\Component\RedsysOperationsParser\Exception\ParserException;
use AvaiBookSports\Component\RedsysOperationsParser\Reader;
use AvaiBookSports\Component\RedsysOperationsParser\Sabadell\Operation\File;
use AvaiBookSports\Component\RedsysOperationsParser\Sabadell\Operation\Operation;
use AvaiBookSports\Component\RedsysOperationsParser\Sabadell\Operation\Remmitance;

/**
 * @method File[] getFiles()
 */
class OperationsParser extends AbstractOperationParser
{
    const LINE_LENGTH = 220;

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
                throw new InvalidLineLengthException('Se esperaba una línea con '.self::LINE_LENGTH.' caracteres, se encontraron '.mb_strlen($content));
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

                $remmitance->setContrato($reader->readInt(2, 15));
                $remmitance->setComercio($reader->readInt(17, 10));
                $remmitance->setCuenta($reader->read(27, 20));
                $remmitance->setOficinaGestora($reader->read(47, 4));

                $remmitance->setFechaProceso($reader->readDateTime('!d-m-Y', 51, 10));
                $remmitance->setFechaInicio($reader->readDateTime('!d-m-Y', 61, 10));
                $remmitance->setFechaFinal($reader->readDateTime('!d-m-Y', 71, 10));

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
                $operation->setRemesa($reader->read(12, 10));
                $operation->setFactura($reader->read(22, 12));
                $operation->setOficinaRemesa($reader->read(34, 4));
                $operation->setTarjeta($reader->read(38, 20));
                $operation->setTipoTarjeta($reader->read(58, 2));
                $operation->setModalidadPago($reader->read(60, 1));
                $operation->setEntidadEmisoraTarjeta($reader->read(61, 1));
                $operation->setFechaHoraOperacion($reader->readDateTime('d-m-Y His', 62, 16));
                $operation->setAutorizacion($reader->read(78, 6));
                $operation->setTipoOperacion($reader->readInt(84, 2));
                $operation->setCapturaOperacion($reader->read(86, 3));

                $operation->setImporteOperacion($reader->readFloat(89, 11, 100));
                $operation->setTasaDescuento($reader->readFloat(101, 5, 100));
                $operation->setImporteDescuento($reader->readFloat(106, 9, 100));
                $operation->setImporteLiquido($reader->readFloat(116, 13, 100));

                $operation->setTpv($reader->read(130, 13));
                $operation->setArn($reader->read(143, 23));
                $operation->setGastos($reader->readFloat(166, 5, 100));
                $operation->setDivisa($reader->read(181, 3));
                $operation->setNumeroOperacion($reader->read(184, 12));
                $operation->setCodigoRazon($reader->read(196, 4));

                $operation->setImporteOriginal($reader->readFloat(202, 13, 100));

                $operation->setDivisaOriginal($reader->read(216, 3));

                $remmitance->addOperation($operation);
            }

            $lastEntry = $entry;
            ++$line;
        }
    }
}
