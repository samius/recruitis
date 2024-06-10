<?php
declare(strict_types=1);

namespace App\Integrations\Recruitis\Model\Jobs\Job;

use Symfony\Component\Serializer\Attribute\SerializedName;

class Address
{
    #[SerializedName('city')]
    private string $city;

    public function getCity(): string
    {
        return $this->city;
    }

    public function setCity(string $city): Address
    {
        $this->city = $city;
        return $this;
    }

}
