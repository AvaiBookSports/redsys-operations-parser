<?php

declare(strict_types=1);

namespace AvaiBookSports\Component\RedsysOperationsParser;

abstract class AbstractFile implements FileInterface
{
    private ?\DateTimeInterface $fechaProceso = null;

    private ?\DateTimeInterface $fechaInicio = null;

    private ?\DateTimeInterface $fechaFinal = null;

    public function getFechaProceso(): ?\DateTimeInterface
    {
        return $this->fechaProceso;
    }

    public function setFechaProceso(?\DateTimeInterface $fechaProceso): FileInterface
    {
        $this->fechaProceso = $fechaProceso;

        return $this;
    }

    public function getFechaInicio(): ?\DateTimeInterface
    {
        return $this->fechaInicio;
    }

    public function setFechaInicio(?\DateTimeInterface $fechaInicio): FileInterface
    {
        $this->fechaInicio = $fechaInicio;

        return $this;
    }

    public function getFechaFinal(): ?\DateTimeInterface
    {
        return $this->fechaFinal;
    }

    public function setFechaFinal(?\DateTimeInterface $fechaFinal): FileInterface
    {
        $this->fechaFinal = $fechaFinal;

        return $this;
    }
}
