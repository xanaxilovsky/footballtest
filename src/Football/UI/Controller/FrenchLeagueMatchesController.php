<?php

declare(strict_types=1);

namespace App\Football\UI\Controller;

use App\Football\Domain\FootballServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FrenchLeagueMatchesController extends AbstractController
{
    /**
     * @Route("/")
     */
    public function __invoke(Request $request, FootballServiceInterface $footballService): Response
    {
        $date = $request->get('date');

        return $this->render('french_league_matches.html.twig', [
            'fixtures' => $footballService->getFrenchLeagueMatchesList($date),
            'date' => $date ?? date('Y-m-d'),
        ]);
    }
}
