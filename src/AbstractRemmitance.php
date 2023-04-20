<?php

declare(strict_types=1);

namespace AvaiBookSports\Component\RedsysOperationsParser;

abstract class AbstractRemmitance implements RemmitanceInterface
{
    private ?int $comercio = null;

    private ?string $oficinaGestora = null;

    private ?\DateTimeInterface $fechaProceso = null;

    private ?\DateTimeInterface $fechaInicio = null;

    /**
     * @var ?\DateTimeInterface
     */
    private $fechaFinal;

    public function getComercio(): ?int
    {
        return $this->comercio;
    }

    /**
     * @return self
     */
    public function setComercio(?int $comercio): RemmitanceInterface
    {
        $this->comercio = $comercio;

        return $this;
    }

    public function getOficinaGestora(): ?string
    {
        return $this->oficinaGestora;
    }

    /**
     * @return self
     */
    public function setOficinaGestora(?string $oficinaGestora): RemmitanceInterface
    {
        $this->oficinaGestora = $oficinaGestora;

        return $this;
    }

    public function getFechaProceso(): ?\DateTimeInterface
    {
        return $this->fechaProceso;
    }

    public function setFechaProceso(?\DateTimeInterface $fechaProceso): RemmitanceInterface
    {
        $this->fechaProceso = $fechaProceso;

        return $this;
    }

    public function getFechaInicio(): ?\DateTimeInterface
    {
        return $this->fechaInicio;
    }

    public function setFechaInicio(?\DateTimeInterface $fechaInicio): RemmitanceInterface
    {
        $this->fechaInicio = $fechaInicio;

        return $this;
    }

    public function getFechaFinal(): ?\DateTimeInterface
    {
        return $this->fechaFinal;
    }

    public function setFechaFinal(?\DateTimeInterface $fechaFinal): RemmitanceInterface
    {
        $this->fechaFinal = $fechaFinal;

        return $this;
    }
}
