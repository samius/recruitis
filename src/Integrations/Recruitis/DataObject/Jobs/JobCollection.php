<?php
declare(strict_types=1);

namespace App\Integrations\Recruitis\DataObject\Jobs;

use App\Integrations\Recruitis\DataObject\CollectionAbstract;
use Symfony\Component\Serializer\Attribute\SerializedName;


class JobCollection extends CollectionAbstract
{

    /** @var Job[] */
    #[SerializedName("payload")]
    protected array $jobs = [];

    /** @return Job[] */
    public function getJobs(): array
    {
        return $this->jobs;
    }

    /** @var Job[] $jobs */
    public function setJobs(array $jobs): JobCollection
    {
        $this->jobs = $jobs;
        return $this;
    }

}
