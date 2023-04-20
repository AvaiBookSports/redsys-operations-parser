<?php

declare(strict_types=1);

namespace AvaiBookSports\Component\RedsysOperationsParser;

use Doctrine\Common\Collections\ArrayCollection;

abstract class AbstractOperationParser
{
    /**
     * @var FileInterface[]
     */
    private array $files = [];

    /**
     * @var ArrayCollection<int, string>
     */
    private ArrayCollection $rawLines;

    public function __construct(string $fileContent)
    {
        $this->rawLines = new ArrayCollection($this->splitLines($fileContent));

        $this->bootstrap();
    }

    abstract public function bootstrap(): void;

    /**
     * @return FileInterface[]
     */
    public function getFiles(): array
    {
        return $this->files;
    }

    protected function addFile(FileInterface $file): self
    {
        $this->files[] = $file;

        return $this;
    }

    /**
     * @return ArrayCollection<int, string>
     */
    public function getRawLines(): ArrayCollection
    {
        return $this->rawLines;
    }

    /**
     * @api
     */
    public function getLinesCount(): int
    {
        return count($this->rawLines);
    }

    /**
     * @return array<int, string>
     */
    protected function splitLines(string $fileContent): array
    {
        $fileContent = str_replace('', '?', $fileContent);
        $lines = preg_split("/\R/", $fileContent);

        if (false === $lines) {
            throw new \RuntimeException('Could not split lines');
        }

        return $lines;
    }
}
