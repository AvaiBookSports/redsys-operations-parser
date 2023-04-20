<?php

namespace AvaiBookSports\Component\RedsysOperationsParser;

class Reader
{
    protected string $line;

    public function __construct(string $line)
    {
        $this->line = $line;
    }

    public function read(int $start, int $length = 0): ?string
    {
        $value = trim(substr($this->line, $start, $length));

        if ('' == $value) {
            return null;
        }

        return $value;
    }

    public function readInt(int $start, int $length = 0): ?int
    {
        $value = $this->read($start, $length);

        if (null != $value) {
            return (int) $value;
        }

        return null;
    }

    public function readFloat(int $start, int $length = 0, int $divider = 1): ?float
    {
        $value = $this->read($start, $length);

        if (null != $value) {
            return (float) $value / $divider;
        }

        return null;
    }

    public function readDateTime(string $format, int $start, int $length = 0): ?\DateTime
    {
        $value = $this->read($start, $length);

        if (null != $value) {
            $dateTime = \DateTime::createFromFormat($format, $value);
            if (false === $dateTime) {
                throw new \RuntimeException('Invalid date');
            }

            return $dateTime;
        }

        return null;
    }
}
