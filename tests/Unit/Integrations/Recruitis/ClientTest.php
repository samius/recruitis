<?php

namespace App\Tests\Unit\Integrations\Recruitis;

use App\Integrations\Recruitis\Client;
use App\Integrations\Recruitis\ClientException;
use App\Integrations\Recruitis\Model\EnumItem;
use App\Integrations\Recruitis\Model\Jobs\Job;
use App\Tests\Support\Helper\Recruitis\TestHttpClient;
use App\Tests\Support\UnitTester;
use Codeception\Test\Unit;
use DateTimeImmutable;

class ClientTest extends Unit
{
    protected UnitTester $tester;

    public function testGetAllJobsValid()
    {
        $jobs = $this->getClient(TestHttpClient::$VALID_APIKEY)->getAllJobs();

        $this->assertCount(TestHttpClient::$VALID_JOBS_COUNT, $jobs->getItems());
        $this->assertEquals(count($jobs->getItems()), $jobs->getShowPerPage());

        foreach ($jobs->getItems() as $item) {
            $this->assertInstanceOf(Job::class, $item);
        }

        $first = $jobs->getItems()[0];

        //check base properties
        $this->assertEquals('431912', $first->getId());
        $this->assertTrue($first->isActive());
        $this->assertTrue($first->getTitle() !== null && $first->getTitle() !== '');
        $this->assertTrue($first->getDescription() !== null && $first->getDescription() !== '');

        //make sure that datetime is in UTC
        $this->assertEquals(
            (new DateTimeImmutable('2023-06-30T09:28:00', new \DateTimeZone('UTC')))->getTimestamp(),
            $first->getDateCreated()->getTimestamp()
        );

        //make sure that enums have correct ids, order and count
        $this->assertEquals(['2516', '3704'], $this->getEnumItemIds($first->getWorkfields()));
        $this->assertEquals(-1, $first->getEducation()->getId());
        $this->assertEquals([1,2,3,4,5,6,7,8,10,11], $this->getEnumItemIds($first->getSuitableFor()));
        $this->assertCount(1, $first->getAddresses());
        $this->assertEquals('Praha 11', $first->getAddresses()[0]->getCity());

        //check all salary properties
        $salary = $first->getSalary();
        $this->assertEquals(0, $salary->getMin());
        $this->assertEquals(35709, $salary->getMax());
        $this->assertEquals('CZK', $salary->getCurrency());
        $this->assertEquals('month', $salary->getUnit());
        $this->assertFalse($salary->isVisible());
    }

    public function testUnauthorized()
    {
        try {
            $this->getClient('invalid-apikey')->getAllJobs();
            $this->fail('Should throw exception');
        } catch (ClientException $e) {//not Guzzle exception, but Recruitis\ClientException
            $this->assertEquals(401, $e->getCode());
            $this->assertNotEmpty($e->getMessage());
        }
    }
    
    public function testGetAllJobsNotFound()
    {
        $jobs = $this->getClient(TestHttpClient::$VALID_APIKEY)->getAllJobs(TestHttpClient::$INVALID_PAGE);
        $this->assertCount(0, $jobs->getItems());
        $this->assertEquals(count($jobs->getItems()), $jobs->getTotalEntries());
    }

    private function getEnumItemIds(array $enumItems): array
    {
        return array_map(fn(EnumItem $item) => $item->getId(), $enumItems);
    }

    private function getClient(string $apikey): Client
    {
        $cache = $this->tester->grabService('cache.app');
        $serializer = $this->tester->grabService('serializer');
        return new Client($apikey, new TestHttpClient(), $serializer, $cache);
    }
    

    protected function _before(): void
    {
    }

    protected function _after(): void
    {
    }
}
