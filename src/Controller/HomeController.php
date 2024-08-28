<?php

namespace App\Controller;

use App\Entity\Activity;
use App\Entity\Category;
use App\Repository\ActivityRepository;
use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted('ROLE_USER', message: 'More priviledge are required to access the resource.')]
class HomeController extends AbstractController
{
    #[Route('/home', name: 'app_home')]
    public function index(CategoryRepository $categoryRepository): Response
    {
        $categories = $categoryRepository->findAll();

        return $this->render('home/index.html.twig', [
            'categories' => $categories,
        ]);
    }

    #[Route('/activities/{id}', name: 'app_activities')]
    public function getActivitiesByCategory(Category $category, ActivityRepository $activityRepository): Response
    {
        $activities = $activityRepository->findByCategory($category->getId());

        return $this->render('home/activities.html.twig', [
            'categoryName' => $category->getName(),
            'activities' => $activities,
        ]);
    }

    #[Route('/participate/{id}', name: 'app_participate')]
    public function participate(Activity $activity, EntityManagerInterface $em): Response
    {
        $activity->addParticipant($this->getUser());
        $em->flush();

        return $this->redirectToRoute('app_home');
    }
}
