<?php
declare(strict_types=1);

namespace App\Integrations\Recruitis\DataObject;
use Symfony\Component\Serializer\Attribute\SerializedPath;

abstract class CollectionAbstract
{
    #[SerializedPath("[meta][entries_total]")]
    protected int $total;
    #[SerializedPath("[meta][entries_sum]")]
    protected int $perPage;

    #[SerializedPath("[meta][entries_from]")]
    protected int $entriesFrom;

    #[SerializedPath("[meta][entries_to]")]
    protected int $entriesTo;

    public function getTotal(): int
    {
        return $this->total;
    }

    public function setTotal($total)
    {
        $this->total = $total;
        return $this;
    }

    public function getPerPage(): int
    {
        return $this->perPage;
    }

    public function setPerPage($perPage)
    {
        $this->perPage = $perPage;
        return $this;
    }

    public function getEntriesFrom(): int
    {
        return $this->entriesFrom;
    }

    public function setEntriesFrom($entriesFrom)
    {
        $this->entriesFrom = $entriesFrom;
        return $this;
    }

    public function getEntriesTo(): int
    {
        return $this->entriesTo;
    }

    public function setEntriesTo($entriesTo)
    {
        $this->entriesTo = $entriesTo;
        return $this;
    }







//    protected abstract function fillPayloadData(array $payload): void;
//
//    private function __construct(array $metadata, array $payload)
//    {
//        //TODO sanitize invalid metadata code
//        $this->fillpaginationFromMetadata($metadata);
//        $this->fillPayloadData($payload);
//    }
//
//    private function fillPaginationFromMetadata(array $metadata): void
//    {
//        $this->total = $metadata['entries_total'];
//        $this->perPage = $metadata['entries_sum'];
//        $entriesFrom = $metadata['entries_from'];
//        $this->currentPage = (int)floor($entriesFrom / $this->perPage);
//    }
//
//
//
//    public static function fromApiResponse(array $apiResponse): static
//    {
//        return new static($apiResponse['meta'], $apiResponse['payload']);
//    }
//
//    protected int $total;
//    protected int $currentPage;
//    protected int $perPage;
//
//    public function getTotal(): int
//    {
//        return $this->total;
//    }
//
//    public function getCurrentPage(): int
//    {
//        return $this->currentPage;
//    }
//
//    public function getPerPage(): int
//    {
//        return $this->perPage;
//    }
}
