<?php

namespace App\Integrations\Recruitis\Model;

interface PaginationInterface
{

    public function getEntriesFrom(): int;

    public function getEntriesTo(): int;

    public function getTotalEntries(): int;

    public function getTotalPages(): int;

    public function getShowPerPage(): int;

    public function getCurrentPage(): int;

    public function isFirstPage(): bool;

    public function isLastPage(): bool;
}
