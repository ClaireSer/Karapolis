<?php

namespace App\Controller;

use App\Repository\ActivityRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted('ROLE_USER', message: 'More priviledge are required to access the resource.')]
class HomeController extends AbstractController
{
    #[Route('/home', name: 'app_home')]
    public function index(ActivityRepository $activityRepository): Response
    {
        $activities = $activityRepository->findAll();

        return $this->render('home/index.html.twig', [
            'activities' => $activities,
        ]);
    }
}
