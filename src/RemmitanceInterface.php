<?php

namespace AvaiBookSports\Component\RedsysOperationsParser;

interface RemmitanceInterface
{
    /**
     * @return OperationInterface[]
     */
    public function getOperations(): array;

    /**
     * @param OperationInterface[] $operations
     */
    public function setOperations(array $operations): self;

    public function addOperation(OperationInterface $operation): self;

    public function getComercio(): ?int;

    public function setComercio(?int $comercio): self;

    public function getOficinaGestora(): ?string;

    public function setOficinaGestora(?string $oficinaGestora): self;

    public function getFechaProceso(): ?\DateTimeInterface;

    public function setFechaProceso(?\DateTimeInterface $fechaProceso): self;

    public function getFechaInicio(): ?\DateTimeInterface;

    public function setFechaInicio(?\DateTimeInterface $fechaInicio): self;

    public function getFechaFinal(): ?\DateTimeInterface;

    /**
     * @param \DateTime|\DateTimeImmutable|null $fechaFinal
     */
    public function setFechaFinal(?\DateTimeInterface $fechaFinal): self;
}
