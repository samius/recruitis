<?php
declare(strict_types=1);

namespace App\Tests\Support\Helper\Recruitis;

use App\Integrations\Recruitis\Model\CollectionAbstract;
use stdClass;

class TestCollection extends CollectionAbstract
{
    /** @return stdClass[] */
    public function getItems(): array
    {
        return $this->items;
    }
}
