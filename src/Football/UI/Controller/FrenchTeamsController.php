<?php

declare(strict_types=1);

namespace App\Football\UI\Controller;

use App\Football\Domain\FootballServiceInterface;
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
        return new JsonResponse($footballService->getFrenchTeamsList());
    }
}
