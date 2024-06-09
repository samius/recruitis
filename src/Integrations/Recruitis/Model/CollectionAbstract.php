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
    protected int $totalEntries = 0;

    #[SerializedPath("[meta][entries_from]")]
    protected int $entriesFrom = 0;

    #[SerializedPath("[meta][entries_to]")]
    protected int $entriesTo = 0;

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


    public function getTotalEntries(): int
    {
        return $this->totalEntries;
    }

    public function setTotalEntries(int $totalEntries): static
    {
        $this->totalEntries = $totalEntries;
        return $this;
    }

    public function getShowPerPage(): int
    {
        $entries = $this->getEntriesTo() - $this->getEntriesFrom() + 1;
        return max(1, $entries); // there can not be 0 entries per page, it would throw division by zero error
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
        return (int)ceil($this->totalEntries / $this->getShowPerPage());
    }

    public function getCurrentPage(): int
    {
        return (int)ceil($this->entriesFrom / $this->getShowPerPage());
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
