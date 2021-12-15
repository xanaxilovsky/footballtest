<?php

declare(strict_types=1);

namespace App\Tests\Football\Infrastructure\HttpClient;

use App\Football\Infrastructure\HttpClient\FootballApiHttpClient;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpClient\MockHttpClient;
use Symfony\Component\HttpClient\Response\MockResponse;

class FootballApiHttpClientTest extends TestCase
{
    public function testGetFrenchLeagueMatchesList(): void
    {
        $mockResponseJson = json_encode([
            'response' => [
                [
                    'fixture' => [
                        'id' => random_int(0, 10000),
                        'date' => new \DateTimeImmutable(),
                    ],
                    'league' => [
                        'id' => random_int(0, 10000),
                        'name' => $this->randomWord(),
                        'country' => 'Israel',
                    ],
                    'teams' => [
                        'home' => [
                            'id' => 5476,
                            'name' => 'Wagiya',
                            'logo' => 'https => //media.api-sports.io/football/teams/5476.png',
                            'winner' => null,
                        ],
                        'away' => [
                            'id' => 18054,
                            'name' => 'Caesar Ridge',
                            'logo' => 'https => //media.api-sports.io/football/teams/18054.png',
                            'winner' => null,
                        ],
                    ],
                    'goals' => [
                        'home' => 1,
                        'away' => 1,
                    ],
                    'score' => [
                        'halftime' => [
                            'home' => null,
                            'away' => null,
                        ],
                        'fulltime' => [
                            'home' => 1,
                            'away' => 1,
                        ],
                        'extratime' => [
                            'home' => null,
                            'away' => null,
                        ],
                        'penalty' => [
                            'home' => null,
                            'away' => null,
                        ],
                    ],
                ],
                [
                    'fixture' => [
                        'id' => random_int(0, 10000),
                        'date' => new \DateTimeImmutable(),
                    ],
                    'league' => [
                        'id' => random_int(0, 10000),
                        'name' => $this->randomWord(),
                        'country' => 'France',
                    ],
                    'teams' => [
                        'home' => [
                            'id' => 5476,
                            'name' => 'Wagiya',
                            'logo' => 'https => //media.api-sports.io/football/teams/5476.png',
                            'winner' => null,
                        ],
                        'away' => [
                            'id' => 18054,
                            'name' => 'Caesar Ridge',
                            'logo' => 'https => //media.api-sports.io/football/teams/18054.png',
                            'winner' => null,
                        ],
                    ],
                    'goals' => [
                        'home' => 1,
                        'away' => 1,
                    ],
                    'score' => [
                        'halftime' => [
                            'home' => null,
                            'away' => null,
                        ],
                        'fulltime' => [
                            'home' => 1,
                            'away' => 1,
                        ],
                        'extratime' => [
                            'home' => null,
                            'away' => null,
                        ],
                        'penalty' => [
                            'home' => null,
                            'away' => null,
                        ],
                    ],
                ],
                [
                    'fixture' => [
                        'id' => random_int(0, 10000),
                        'date' => new \DateTimeImmutable(),
                    ],
                    'league' => [
                        'id' => random_int(0, 10000),
                        'name' => $this->randomWord(),
                        'country' => 'Englad',
                    ],
                    'teams' => [
                        'home' => [
                            'id' => 5476,
                            'name' => 'Wagiya',
                            'logo' => 'https => //media.api-sports.io/football/teams/5476.png',
                            'winner' => null,
                        ],
                        'away' => [
                            'id' => 18054,
                            'name' => 'Caesar Ridge',
                            'logo' => 'https => //media.api-sports.io/football/teams/18054.png',
                            'winner' => null,
                        ],
                    ],
                    'goals' => [
                        'home' => 1,
                        'away' => 1,
                    ],
                    'score' => [
                        'halftime' => [
                            'home' => null,
                            'away' => null,
                        ],
                        'fulltime' => [
                            'home' => 1,
                            'away' => 1,
                        ],
                        'extratime' => [
                            'home' => null,
                            'away' => null,
                        ],
                        'penalty' => [
                            'home' => null,
                            'away' => null,
                        ],
                    ],
                ],
            ],
        ], \JSON_THROW_ON_ERROR);

        $mockResponse = new MockResponse($mockResponseJson, [
            'http_code' => 200,
            'response_headers' => ['Content-Type: application/json'],
        ]);

        $httpClient = new MockHttpClient($mockResponse, 'https://example.com'. FootballApiHttpClient::URL_FIXTURES);
        $service = new FootballApiHttpClient($httpClient);
        $responseData = $service->getFrenchLeagueMatchesList();

        self::assertSame('GET', $mockResponse->getRequestMethod());
        self::assertCount(1, $responseData);
        self::assertSame(FootballApiHttpClient::COUNTRY_FRANCE, reset($responseData)['league']['country']);
    }

    private function randomWord(int $length = 5): string
    {
        return substr(str_shuffle('qwertyuiopasdfghjklzxcvbnm'), 0, $length);
    }
}
