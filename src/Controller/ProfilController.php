<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProfilController extends AbstractController
{
//    public function __construct(BusinessStatsCalculator $businessStatsCalculator)
//    {
//        $this->businessStatsCalculator = $businessStatsCalculator;
//    }
    /**
     * @Route("/profil", name="admin-profil")
     */
    public function index(): Response
    {
        return $this->render('profil/index.html.twig', [
            'controller_name' => 'ProfilController',
        ]);
    }

}
