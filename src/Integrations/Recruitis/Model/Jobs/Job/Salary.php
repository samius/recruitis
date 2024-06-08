<?php
declare(strict_types=1);

namespace App\Integrations\Recruitis\Model\Jobs\Job;

class Salary
{
    private ?float $min = null;
    private ?float $max = null;
    private ?string $currency = null;
    private ?string $unit = null;
    private ?bool $visible = null;

    public function getMin(): ?float
    {
        return $this->min;
    }

    public function setMin(float $min): Salary
    {
        $this->min = $min;
        return $this;
    }

    public function getMax(): ?float
    {
        return $this->max;
    }

    public function setMax(float $max): Salary
    {
        $this->max = $max;
        return $this;
    }

    public function getCurrency(): ?string
    {
        return $this->currency;
    }

    public function setCurrency(string $currency): Salary
    {
        $this->currency = $currency;
        return $this;
    }

    public function getUnit(): ?string
    {
        return $this->unit;
    }

    public function setUnit(string $unit): Salary
    {
        $this->unit = $unit;
        return $this;
    }

    public function isVisible(): ?bool
    {
        return $this->visible;
    }

    public function setVisible(bool $visible): Salary
    {
        $this->visible = $visible;
        return $this;
    }
}
