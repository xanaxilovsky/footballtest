<?php

declare(strict_types=1);

namespace App\Football\Infrastructure\HttpClient;

use App\Football\Domain\FootballServiceInterface;
use DateTimeImmutable;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class FootballApiHttpClient implements FootballServiceInterface
{
    private const URL_FIXTURES = '/fixtures';
    private const URL_TEAMS = '/teams';
    private const URL_HEAD_TO_HEAD = '/headtohead';
    private const COUNTRY_FRANCE = 'France';

    private HttpClientInterface $client;

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }

    public function getFrenchLeagueMatchesList(): array
    {
        $toto = json_decode(file_get_contents(__DIR__.'/tmp.json'));

        return array_filter($toto, function ($fixture) {
            return self::COUNTRY_FRANCE === $fixture->league->country;
        });

        $response = $this->client->request(Request::METHOD_GET, self::URL_FIXTURES, [
            'query' => [
                'date' => (new DateTimeImmutable())->format('Y-m-d'),
            ],
        ]);

        return array_filter($response->toArray()['response'], function ($fixture) {
            return self::COUNTRY_FRANCE === $fixture->league->country;
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