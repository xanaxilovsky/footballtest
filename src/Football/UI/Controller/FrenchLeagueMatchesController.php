<?php

declare(strict_types=1);

namespace App\Football\UI\Controller;

use App\Football\Domain\FootballServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FrenchLeagueMatchesController extends AbstractController
{
    /**
     * @Route("/")
     */
    public function __invoke(FootballServiceInterface $footballService): Response
    {
        return $this->render('french_league_matches.html.twig', [
            'fixtures' => $footballService->getFrenchLeagueMatchesList(),
        ]);
    }
}
