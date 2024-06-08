<?php
declare(strict_types=1);

namespace App\Integrations\Recruitis\Model\Jobs;

use App\Integrations\Recruitis\Model\EnumItem;
use App\Integrations\Recruitis\Model\Jobs\Job\Address;
use App\Integrations\Recruitis\Model\Jobs\Job\Salary;
use Symfony\Component\Serializer\Attribute\SerializedName;
use Symfony\Component\Serializer\Attribute\SerializedPath;

class Job
{
    #[SerializedName('job_id')]
    private int $id;

    private bool $active;

    private string $title;

    private string $description;

    #[SerializedName('date_created')]
    private \DateTimeImmutable $dateCreated;

    private Salary $salary;

    /** @var Address[] */
    private array $addresses = [];

    /** @var EnumItem[] */
    private array $workfields = [];

    /** @var EnumItem[] */
    #[SerializedPath('[details][suitable_for]')]
    private array $suitableFor = [];

    private EnumItem $education;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): Job
    {
        $this->id = $id;
        return $this;
    }

    public function isActive(): bool
    {
        return $this->active;
    }

    public function setActive(bool $active): Job
    {
        $this->active = $active;
        return $this;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): Job
    {
        $this->title = $title;
        return $this;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): Job
    {
        $this->description = $description;
        return $this;
    }

    public function getDateCreated(): \DateTimeImmutable
    {
        return $this->dateCreated;
    }

    public function setDateCreated(\DateTimeImmutable $dateCreated): Job
    {
        $this->dateCreated = $dateCreated;
        return $this;
    }

    public function getSalary(): Salary
    {
        return $this->salary;
    }

    public function setSalary(Salary $salary): Job
    {
        $this->salary = $salary;
        return $this;
    }

    /** @return Address[] */
    public function getAddresses(): array
    {
        return $this->addresses;
    }

    /** @var Address[] $addresses */
    public function setAddresses(array $addresses): Job
    {
        $this->addresses = $addresses;
        return $this;
    }

    public function getWorkfields(): array
    {
        return $this->workfields;
    }

    /** @param EnumItem[] $workfields */
    public function setWorkfields(array $workfields): Job
    {
        $this->workfields = $workfields;
        return $this;
    }

    public function getSuitableFor(): array
    {
        return $this->suitableFor;
    }

    public function getSuitableForString(): string
    {
        $suitableNames = array_map(function (EnumItem $item) {
            return $item->getName();
        }, $this->suitableFor);

        return implode(', ', $suitableNames);
    }

    /** @param EnumItem[] $suitableFor */
    public function setSuitableFor(array $suitableFor): Job
    {
        $this->suitableFor = $suitableFor;
        return $this;
    }

    public function getEducation(): EnumItem
    {
        return $this->education;
    }

    public function setEducation(EnumItem $education): Job
    {
        $this->education = $education;
        return $this;
    }


}
