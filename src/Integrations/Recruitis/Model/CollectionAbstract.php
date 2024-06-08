<?php
declare(strict_types=1);

namespace App\Integrations\Recruitis\Model;

use Symfony\Component\Serializer\Attribute\SerializedPath;
use Symfony\Component\Serializer\Attribute\SerializedName;

abstract class CollectionAbstract implements PaginationInterface
{
    #[SerializedName("payload")]
    protected array $items = [];

    #[SerializedPath("[meta][entries_total]")]
    protected int $total;

    /* must be set manually - [meta][entries_sum] is not this value */
    protected int $showPerPage;

    #[SerializedPath("[meta][entries_from]")]
    protected int $entriesFrom;

    #[SerializedPath("[meta][entries_to]")]
    protected int $entriesTo;

    /*
     * A @return phpdoc definition has to be added to the child class for serializer to recognize correct item class
     * e.g. @return Job[]
     */
    public abstract function getItems(): array;


    public function setItems(array $items): static
    {
        $this->items = $items;
        return $this;
    }


    public function getTotal(): int
    {
        return $this->total;
    }

    public function setTotal(int $total): static
    {
        $this->total = $total;
        return $this;
    }

    public function getShowPerPage(): int
    {
        return $this->showPerPage;
    }

    public function setShowPerPage(int $showPerPage): static
    {
        $this->showPerPage = $showPerPage;
        return $this;
    }

    public function getEntriesFrom(): int
    {
        return $this->entriesFrom;
    }

    public function setEntriesFrom(int $entriesFrom): static
    {
        $this->entriesFrom = $entriesFrom;
        return $this;
    }

    public function getEntriesTo(): int
    {
        return $this->entriesTo;
    }

    public function setEntriesTo(int $entriesTo): static
    {
        $this->entriesTo = $entriesTo;
        return $this;
    }

    public function getTotalPages(): int
    {
        return (int)ceil($this->total / $this->showPerPage);
    }

    public function getCurrentPage(): int
    {
        return (int)ceil($this->entriesFrom / $this->showPerPage);
    }

    public function isFirstPage(): bool
    {
        return $this->getCurrentPage() === 1;
    }

    public function isLastPage(): bool
    {
        return $this->getCurrentPage() === $this->getTotalPages();
    }

}
