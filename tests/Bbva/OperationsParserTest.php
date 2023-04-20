<?php

declare(strict_types=1);

namespace AvaiBookSports\Component\Tests\RedsysOperationsParser\Bbva;

use AvaiBookSports\Component\RedsysOperationsParser\Bbva\Operation\File;
use AvaiBookSports\Component\RedsysOperationsParser\Bbva\Operation\Operation;
use AvaiBookSports\Component\RedsysOperationsParser\Bbva\Operation\Remmitance;
use AvaiBookSports\Component\RedsysOperationsParser\Bbva\OperationsParser;
use AvaiBookSports\Component\RedsysOperationsParser\Exception\InvalidLineLengthException;
use AvaiBookSports\Component\RedsysOperationsParser\Exception\ParserException;
use PHPUnit\Framework\TestCase;

final class OperationsParserTest extends TestCase
{
    private function getFileContent(string $newline = "\r\n"): string
    {
        return
            "1023-03-202023-03-202023-03-2020                                                                                                                                                                                                                                                                                                                              $newline".
            "0002569876123401234567890123001234567802569876432101234567890123987623-03-202023-03-202023-03-2020ES7700756716424766412861                                                                                                                                                                                                                                    $newline".
            "0123-03-2020000000000012345678900004200320230732230182     186187012345******6789      SD20-03-202023073233333305TC60000000106000040000000004000000000000000000105600000001   EUR01234A56FA7C                    HELLO WORLD, THIS IS A T...        N            +000000000000   N                                                                            $newline".
            "99000000000000000000000000+0000000740000000144317+EUR                                                                                                                                                                                                                                                                                                         $newline".
            "0002569876123400000006326599000979143501829876432100000000157765987623-03-202023-03-202023-03-2020ES7700756716424766412861                                                                                                                                                                                                                                    $newline".
            "0123-03-2020000000000012345678900004200320230732230182     186187012345******6789      SD20-03-202023073233333305TC60000000106000040000000004000000000000000000105600000001   EUR01234A56FA7C                    HELLO WORLD, THIS IS A T...        N            +000000000000   N                                                                            $newline".
            "99000000000000000000000000+0000001090000000098815+EUR                                                                                                                                                                                                                                                                                                         $newline".
            "90000000432100000000000000000000000+0000001830000000243132+                                                                                                                                                                                                                                                                                                   $newline"
        ;
    }

    private function getIncorrectFormatFileContent(string $newline = "\r\n"): string
    {
        return
            "1023-03-202023-03-202023-03-2020                                                                                                                                                                                                                                                                                                                             $newline".
            "0002569876123401234567890123001234567802569876432101234567890123987623-03-202023-03-202023-03-2020ES7700756716424766412861                                                                                                                                                                                                                                   $newline".
            "0123-03-2020000000000012345678900004200320230732230182     186187012345******6789      SD20-03-202023073233333305TC60000000106000040000000004000000000000000000105600000001   EUR01234A56FA7C                    HELLO WORLD, THIS IS A T...        N            +000000000000   N                                                                           $newline".
            "99000000000000000000000000+0000000740000000144317+EUR                                                                                                                                                                                                                                                                                                        $newline".
            "90000000432100000000000000000000000+0000001830000000243132+                                                                                                                                                                                                                                                                                                  $newline"
        ;
    }

    public function testIncorrectFormat(): void
    {
        $this->expectException(InvalidLineLengthException::class);

        new OperationsParser($this->getIncorrectFormatFileContent());
    }

    public function testGetEntries(): void
    {
        $operations = new OperationsParser($this->getFileContent());

        $files = $operations->getFiles();

        $this->assertInstanceOf(File::class, $files[0]);
        $this->assertEquals(new \DateTime('2020-03-23 00:00:00'), $files[0]->getFechaProceso());
        $this->assertEquals(new \DateTime('2020-03-23 00:00:00'), $files[0]->getFechaInicio());
        $this->assertEquals(new \DateTime('2020-03-23 00:00:00'), $files[0]->getFechaFinal());

        $remmitances = $files[0]->getRemmitances();

        $this->assertInstanceOf(Remmitance::class, $remmitances[0]);

        $this->assertEquals('0256', $remmitances[0]->getBancoContrato());
        $this->assertEquals(12345678, $remmitances[0]->getComercio());
        $this->assertEquals('1234', $remmitances[0]->getContrapartidaContrato());
        $this->assertEquals('4321', $remmitances[0]->getContrapartidaCuenta());
        $this->assertEquals(null, $remmitances[0]->getContrato());
        $this->assertEquals(null, $remmitances[0]->getCuenta());
        $this->assertEquals('0256', $remmitances[0]->getEntidadCuenta());
        $this->assertEquals(new \DateTime('2020-03-23 00:00:00'), $remmitances[0]->getFechaFinal());
        $this->assertEquals(new \DateTime('2020-03-23 00:00:00'), $remmitances[0]->getFechaInicio());
        $this->assertEquals(new \DateTime('2020-03-23 00:00:00'), $remmitances[0]->getFechaProceso());
        $this->assertEquals('01234567890123', $remmitances[0]->getFolioContrato());
        $this->assertEquals('01234567890123', $remmitances[0]->getFolioCuenta());
        $this->assertEquals('ES7700756716424766412861', $remmitances[0]->getIbanCuentaAbonoComercio());
        $this->assertEquals('9876', $remmitances[0]->getOficinaContrato());
        $this->assertEquals('9876', $remmitances[0]->getOficinaCuenta());
        $this->assertEquals('9876', $remmitances[0]->getOficinaGestora());

        $operations = $remmitances[0]->getOperations();

        $this->assertInstanceOf(Operation::class, $operations[0]);
        $this->assertEquals('333333', $operations[0]->getAutorizacion());
        $this->assertEquals(null, $operations[0]->getCodigoRazon());
        $this->assertEquals('HELLO WORLD, THIS IS A T...', $operations[0]->getDatosOperacion());
        $this->assertEquals(null, $operations[0]->getDcc());
        $this->assertEquals('EUR', $operations[0]->getDivisa());
        $this->assertEquals(null, $operations[0]->getDivisaOriginal());
        $this->assertEquals('01234A56FA7C', $operations[0]->getFactura());
        $this->assertEquals(new \DateTime('2020-03-20 23:07:32'), $operations[0]->getFechaHoraOperacion());
        $this->assertEquals(new \DateTime('2020-03-23 00:00:00'), $operations[0]->getFechaRemesa());
        $this->assertEquals(0.04, $operations[0]->getImporteDescuento());
        $this->assertEquals(10.56, $operations[0]->getImporteLiquido());
        $this->assertEquals(10.6, $operations[0]->getImporteOperacion());
        $this->assertEquals(null, $operations[0]->getImporteOriginal());
        $this->assertEquals('0004', $operations[0]->getOficinaRemesa());
        $this->assertEquals('00000000001234567890', $operations[0]->getRemesa());
        $this->assertEquals('012345******6789', $operations[0]->getTarjeta());
        $this->assertEquals(0.4, $operations[0]->getTasaDescuento());
        $this->assertEquals(Operation::TIPO_OPERACION_VENTA, $operations[0]->getTipoOperacion());
        $this->assertEquals(OPERATION::TIPO_TARJETA_SERVIRED_DEBITO, $operations[0]->getTipoTarjeta());
    }

    public function testGetLineCount(): void
    {
        $operations1 = new OperationsParser($this->getFileContent());
        $operations2 = new OperationsParser($this->getFileContent("\r"));
        $operations3 = new OperationsParser($this->getFileContent("\n"));

        $this->assertEquals(9, $operations1->getLinesCount());
        $this->assertEquals(9, $operations2->getLinesCount());
        $this->assertEquals(9, $operations3->getLinesCount());
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
