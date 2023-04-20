<?php

declare(strict_types=1);

namespace AvaiBookSports\Component\Tests\RedsysOperationsParser\Sabadell;

use AvaiBookSports\Component\RedsysOperationsParser\Exception\ParserException;
use AvaiBookSports\Component\RedsysOperationsParser\Sabadell\Operation\File;
use AvaiBookSports\Component\RedsysOperationsParser\Sabadell\Operation\Operation;
use AvaiBookSports\Component\RedsysOperationsParser\Sabadell\Operation\Remmitance;
use AvaiBookSports\Component\RedsysOperationsParser\Sabadell\OperationsParser;
use PHPUnit\Framework\TestCase;

final class OperationsParserTest extends TestCase
{
    private function getFileContent(string $newline = "\r\n"): string
    {
        return
            "1008-04-202007-04-202008-04-2020                                                                                                                                                                                            $newline".
            "00000003670505743033721153601234567890123456789001208-04-202007-04-202007-04-2020                                                                                                                                           $newline".
            "0108-04-2020987654321001234A56FA7C0012012345XXXXXX6789    VPDN07-04-202001234501234505ON 00000000200+00030000000001+0000000000199+012345678901277777777777777777777777               EUR012345678901      0000000000000+    $newline".
            "99                         0000000180000000024472+                                                                                                                                                                          $newline".
            "90000000002                         0000000460000000102759-                                                                                                                                                                 $newline"
        ;
    }

    public function testGetEntries(): void
    {
        $operations = new OperationsParser($this->getFileContent());

        $files = $operations->getFiles();

        $this->assertInstanceOf(File::class, $files[0]);
        $this->assertEquals(new \DateTime('2020-04-08 00:00:00'), $files[0]->getFechaProceso());
        $this->assertEquals(new \DateTime('2020-04-07 00:00:00'), $files[0]->getFechaInicio());
        $this->assertEquals(new \DateTime('2020-04-08 00:00:00'), $files[0]->getFechaFinal());

        $remmitances = $files[0]->getRemmitances();

        $this->assertInstanceOf(Remmitance::class, $remmitances[0]);

        $this->assertEquals(337211536, $remmitances[0]->getComercio());
        $this->assertEquals(3670505743, $remmitances[0]->getContrato());
        $this->assertEquals('01234567890123456789', $remmitances[0]->getCuenta());
        $this->assertEquals(new \DateTime('2020-04-07 00:00:00'), $remmitances[0]->getFechaFinal());
        $this->assertEquals(new \DateTime('2020-04-07 00:00:00'), $remmitances[0]->getFechaInicio());
        $this->assertEquals(new \DateTime('2020-04-08 00:00:00'), $remmitances[0]->getFechaProceso());
        $this->assertEquals('0012', $remmitances[0]->getOficinaGestora());

        $operations = $remmitances[0]->getOperations();

        $this->assertInstanceOf(Operation::class, $operations[0]);

        $this->assertEquals('77777777777777777777777', $operations[0]->getArn());
        $this->assertEquals('012345', $operations[0]->getAutorizacion());
        $this->assertEquals(Operation::CAPTURA_OPERACION_ONLINE, $operations[0]->getCapturaOperacion());
        $this->assertEquals(null, $operations[0]->getCodigoRazon());
        $this->assertEquals('EUR', $operations[0]->getDivisa());
        $this->assertEquals(null, $operations[0]->getDivisaOriginal());
        $this->assertEquals(Operation::NACIONAL_SISTEMA_SERVIRED, $operations[0]->getEntidadEmisoraTarjeta());
        $this->assertEquals('01234A56FA7C', $operations[0]->getFactura());
        $this->assertEquals(new \DateTime('2020-04-07 01:23:45'), $operations[0]->getFechaHoraOperacion());
        $this->assertEquals(new \DateTime('2020-04-08 00:00:00'), $operations[0]->getFechaRemesa());
        $this->assertEquals(null, $operations[0]->getGastos());
        $this->assertEquals(0.01, $operations[0]->getImporteDescuento());
        $this->assertEquals(1.99, $operations[0]->getImporteLiquido());
        $this->assertEquals(2, $operations[0]->getImporteOperacion());
        $this->assertEquals(null, $operations[0]->getImporteOriginal());
        $this->assertEquals(Operation::MODALIDAD_PAGO_DEBITO, $operations[0]->getModalidadPago());
        $this->assertEquals('012345678901', $operations[0]->getNumeroOperacion());
        $this->assertEquals('0012', $operations[0]->getOficinaRemesa());
        $this->assertEquals('9876543210', $operations[0]->getRemesa());
        $this->assertEquals('012345XXXXXX6789', $operations[0]->getTarjeta());
        $this->assertEquals(0.3, $operations[0]->getTasaDescuento());
        $this->assertEquals(Operation::TIPO_OPERACION_VENTA, $operations[0]->getTipoOperacion());
        $this->assertEquals(Operation::TIPO_TARJETA_VISA_PARTICULARES, $operations[0]->getTipoTarjeta());
        $this->assertEquals('0123456789012', $operations[0]->getTpv());
    }

    public function testGetLineCount(): void
    {
        $operations1 = new OperationsParser($this->getFileContent());
        $operations2 = new OperationsParser($this->getFileContent("\r"));
        $operations3 = new OperationsParser($this->getFileContent("\n"));

        $this->assertEquals(6, $operations1->getLinesCount());
        $this->assertEquals(6, $operations2->getLinesCount());
        $this->assertEquals(6, $operations3->getLinesCount());
    }

    public function testUnopenedFileException(): void
    {
        $this->expectException(ParserException::class);

        $file =
            "0008-04-202007-04-202008-04-2020                                                                                                                                                                                            \r\n".
            "1009-04-202008-04-202009-04-2020                                                                                                                                                                                            \r\n"
        ;

        new OperationsParser($file);
    }

    public function testUnclosedFileException(): void
    {
        $this->expectException(ParserException::class);

        $file =
            "1008-04-202007-04-202008-04-2020                                                                                                                                                                                            \r\n".
            "1009-04-202008-04-202009-04-2020                                                                                                                                                                                            \r\n"
        ;

        new OperationsParser($file);
    }
}
