<?php

declare(strict_types=1);

namespace App\Football\UI\Model;

class TeamsAutocompleteView
{
    public int $id;

    public string $value;

    public function __construct(int $id, string $value)
    {
        $this->id = $id;
        $this->value = $value;
    }
}
