<?php
declare(strict_types=1);

namespace App\Integrations\Recruitis\DataObject;

class EnumItem
{
    private int $id;
    private string $name;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): EnumItem
    {
        $this->id = $id;
        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): EnumItem
    {
        $this->name = $name;
        return $this;
    }


}
