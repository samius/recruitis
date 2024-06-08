<?php
declare(strict_types=1);

namespace App\Integrations\Recruitis\Model\Jobs;

use App\Integrations\Recruitis\Model\CollectionAbstract;

class JobCollection extends CollectionAbstract
{
    /** @return Job[] */
    public function getItems(): array
    {
        return $this->items;
    }
}
