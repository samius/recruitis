<?php
declare(strict_types=1);

namespace App\Integrations\Recruitis\DataObject\Jobs\Job;

class Salary
{
    private int $min;
    private int $max;
    private string $currency;
    private string $unit;
    private bool $visible;

    public function getMin(): int
    {
        return $this->min;
    }

    public function setMin(int $min): Salary
    {
        $this->min = $min;
        return $this;
    }

    public function getMax(): int
    {
        return $this->max;
    }

    public function setMax(int $max): Salary
    {
        $this->max = $max;
        return $this;
    }

    public function getCurrency(): string
    {
        return $this->currency;
    }

    public function setCurrency(string $currency): Salary
    {
        $this->currency = $currency;
        return $this;
    }

    public function getUnit(): string
    {
        return $this->unit;
    }

    public function setUnit(string $unit): Salary
    {
        $this->unit = $unit;
        return $this;
    }

    public function isVisible(): bool
    {
        return $this->visible;
    }

    public function setVisible(bool $visible): Salary
    {
        $this->visible = $visible;
        return $this;
    }
}
