<?php

declare(strict_types=1);

namespace App\Football\UI\Controller;

use App\Football\Domain\FootballServiceInterface;
use App\Football\UI\Model\TeamsAutocompleteView;
use Iterator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class FrenchTeamsController extends AbstractController
{
    /**
     * @Route("/teams")
     */
    public function __invoke(FootballServiceInterface $footballService): JsonResponse
    {
        $teams = $this->buildAutocompleteView($footballService->getFrenchTeamsList());

        return new JsonResponse(iterator_to_array($teams));
    }

    private function buildAutocompleteView(array $teams): Iterator
    {
        foreach ($teams as $team) {
            yield new TeamsAutocompleteView((int) $team['team']['id'], $team['team']['name']);
        }
    }
}
