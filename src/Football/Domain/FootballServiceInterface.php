<?php

declare(strict_types=1);

namespace App\Football\Domain;

interface FootballServiceInterface
{
    public function getFrenchLeagueMatchesList(?string $date = null): array;

    public function getFrenchTeamsList(): array;

    public function getHeadToHead(int $firstTeamId, int $secondTeamId): array;
}
