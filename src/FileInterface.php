<?php

namespace AvaiBookSports\Component\RedsysOperationsParser;

interface FileInterface
{
    /**
     * @return array<RemmitanceInterface>
     */
    public function getRemmitances(): array;

    public function addRemmitance(RemmitanceInterface $remmitance): self;

    public function getFechaProceso(): ?\DateTimeInterface;

    public function setFechaProceso(?\DateTimeInterface $fechaProceso): self;

    public function getFechaInicio(): ?\DateTimeInterface;

    public function setFechaInicio(?\DateTimeInterface $fechaInicio): self;

    public function getFechaFinal(): ?\DateTimeInterface;

    public function setFechaFinal(?\DateTimeInterface $fechaFinal): self;
}
