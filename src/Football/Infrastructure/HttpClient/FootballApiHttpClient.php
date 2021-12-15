<?php

declare(strict_types=1);

namespace App\Football\Infrastructure\HttpClient;

use App\Football\Domain\FootballServiceInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class FootballApiHttpClient implements FootballServiceInterface
{
    public const URL_FIXTURES = '/fixtures';
    public const URL_TEAMS = '/teams';
    public const URL_HEAD_TO_HEAD = '/fixtures/headtohead';
    public const COUNTRY_FRANCE = 'France';

    private HttpClientInterface $client;

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }

    public function getFrenchLeagueMatchesList(): array
    {
        $response = $this->client->request(Request::METHOD_GET, self::URL_FIXTURES, [
            'query' => [
                'date' => date('Y-m-d'),
            ],
        ]);

        return array_filter($response->toArray()['response'], function ($fixture) {
            return self::COUNTRY_FRANCE === $fixture['league']['country'];
        });
    }

    public function getFrenchTeamsList(): array
    {
        $response = $this->client->request(Request::METHOD_GET, self::URL_TEAMS, [
            'query' => [
                'country' => self::COUNTRY_FRANCE,
            ],
        ]);

        return $response->toArray()['response'];
    }

    public function getHeadToHead(int $firstTeamId, int $secondTeamId): array
    {
        $response = $this->client->request(Request::METHOD_GET, self::URL_HEAD_TO_HEAD, [
            'query' => [
                'h2h' => sprintf('%d-%d', $firstTeamId, $secondTeamId),
            ],
        ]);

        return $response->toArray()['response'];
    }
}
