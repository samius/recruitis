<?php
declare(strict_types=1);

namespace App\Integrations\Recruitis\Model\Jobs\Job;
use Symfony\Component\Serializer\Attribute\SerializedName;

class Salary
{
    private ?float $min = null;

    #[SerializedName('is_min_visible')]
    private bool $minVisible = false;
    private ?float $max = null;
    #[SerializedName('is_max_visible')]
    private bool $maxVisible = false;
    #[SerializedName('is_range')]
    private bool $isRange = false;
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

    public function isMinVisible(): bool
    {
        return $this->minVisible;
    }

    public function setMinVisible(bool $minVisible): Salary
    {
        $this->minVisible = $minVisible;
        return $this;
    }

    public function isMaxVisible(): bool
    {
        return $this->maxVisible;
    }

    public function setMaxVisible(bool $maxVisible): Salary
    {
        $this->maxVisible = $maxVisible;
        return $this;
    }

    public function isRange(): bool
    {
        return $this->isRange;
    }

    public function setIsRange(bool $isRange): Salary
    {
        $this->isRange = $isRange;
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
