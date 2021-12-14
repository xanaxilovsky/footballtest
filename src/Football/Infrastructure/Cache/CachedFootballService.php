<?php

declare(strict_types=1);

namespace App\Football\Infrastructure\Cache;

use App\Football\Domain\FootballServiceInterface;
use Psr\Cache\CacheItemPoolInterface;

class CachedFootballService implements FootballServiceInterface
{
    private FootballServiceInterface $footballService;

    private CacheItemPoolInterface $cachePool;

    public function __construct(FootballServiceInterface $footballService, CacheItemPoolInterface $cachePool)
    {
        $this->footballService = $footballService;
        $this->cachePool = $cachePool;
    }

    public function getFrenchLeagueMatchesList(): array
    {
        $item = $this->cachePool->getItem(sprintf('fixtures_%s', date('Y-m-d')));

        if (!$item->isHit()) {
            $item->set($this->footballService->getFrenchLeagueMatchesList());
            $item->expiresAt(new \DateTimeImmutable('today 23:59'));

            $this->cachePool->save($item);
        }

        return $item->get();
    }

    public function getFrenchTeamsList(): array
    {
        $item = $this->cachePool->getItem(sprintf('teams_%s', date('Y-m-d')));

        if (!$item->isHit()) {
            $item->set($this->footballService->getFrenchTeamsList());
            $item->expiresAfter(new \DateInterval('P1M'));

            $this->cachePool->save($item);
        }

        return $item->get();
    }

    public function getHeadToHead(int $firstTeamId, int $secondTeamId): array
    {
        $item = $this->cachePool->getItem(sprintf('headtohead_%s', date('Y-m-d')));

        if (!$item->isHit()) {
            $item->set($this->footballService->getHeadToHead($firstTeamId, $secondTeamId));
            $item->expiresAt(new \DateTimeImmutable('today 23:59'));

            $this->cachePool->save($item);
        }

        return $item->get();
    }
}
