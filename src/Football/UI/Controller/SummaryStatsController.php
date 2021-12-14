<?php

declare(strict_types=1);

namespace App\Football\UI\Controller;

use App\Football\Domain\FootballServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class SummaryStatsController extends AbstractController
{
  /**
   * @Route("/summary-stats")
   */
    public function __invoke(Request $request, FootballServiceInterface $footballService)
    {
        return $this->render('summary_stats.html.twig', [
          'headtohead' => $footballService->getHeadToHead((int) $request->get('firstTeamId'), (int) $request->get('secondTeamId')),
      ]);
    }
}
