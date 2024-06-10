<?php
declare(strict_types=1);

namespace App\Tests\Unit\Integrations\Recruitis\Model;

use App\Integrations\Recruitis\Model\Jobs\JobCollection;
use App\Tests\Support\Helper\Recruitis\TestCollection;
use Codeception\Test\Unit;

class CollectionAbstractTest extends Unit
{

    public function testCanNotHaveZeroShowPerPage(): void
    {
        $collection = new TestCollection();
        $collection->setEntriesFrom(9);
        $collection->setEntriesTo(8);
        $this->assertEquals(1, $collection->getShowPerPage());
    }

    public function testGetTotalPages(): void
    {
        $collection = new JobCollection();
        $this->assertEquals(0, $collection->getTotalPages());

        $collection->setTotalEntries(12);
        $collection->setEntriesFrom(1);
        $collection->setEntriesTo(12);
        $this->assertEquals(1, $collection->getTotalPages());

        $expected = [ // [entriesTo=>[totalPages, showPerPage]]]
            12 => [1, 12],
            11 => [2, 11],
            6  => [2, 6],
            5  => [3, 5],
            4  => [3, 4],
            3  => [4, 3],
            2  => [6, 2],
            1  => [12, 1],
            0  => [12, 1] // in case of 0, showPerPage is 1 by definitin1]
        ];
        foreach ($expected as $entriesTo => $expectedVals) {
            list($expectedPages, $expectedShowPerPage) = $expectedVals;
            $collection->setEntriesTo($entriesTo);
            $this->assertEquals($expectedPages, $collection->getTotalPages());
            $this->assertEquals($expectedShowPerPage, $collection->getShowPerPage());
        }
    }
}
