<?php

declare(strict_types=1);

namespace App\Tests\Football\UI\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class FrenchTeamsControllerTest extends WebTestCase
{
    public function testInvoke(): void
    {
        $client = static::createClient();
        $client->request('GET', '/teams');

        $this->assertResponseIsSuccessful();
    }
}
