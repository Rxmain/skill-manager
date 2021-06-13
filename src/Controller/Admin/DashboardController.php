<?php

namespace App\Controller\Admin;

use App\Entity\Candidate;
use App\Entity\Competences;
use App\Entity\Entreprise;
use App\Entity\Experience;
use App\Entity\User;
use App\Repository\CandidateRepository;
use App\Repository\UserRepository;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;

class DashboardController extends AbstractDashboardController
{
    protected $candidateRepository;
    protected $userRepository;

    public function __construct(
        CandidateRepository $candidateRepository,
        UserRepository $userRepository
    )
    {
        $this->userRepository = $userRepository;
        $this->candidateRepository = $candidateRepository;

    }

    /**
     * @Route("/admin", name="admin")
     * @Security("is_granted('ROLE_ADMIN')")
     */
    public function index(): Response
    {
        return $this->render('bundles/EasyAdminBundle/welcome.html.twig', [
            'nameCandidate' => $this->candidateRepository->findAll(),
//            'countAllHelp' => ,

        ]);
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Gestionnaire de compétences');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linktoDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Collaborateurs', 'fas fa-user', User::class);
        yield MenuItem::linkToCrud('Candidats', 'fas fa-address-card', Candidate::class);
        yield MenuItem::linkToCrud('Entreprises', 'fas fa-archive', Entreprise::class);
        yield MenuItem::linkToCrud('Competences', 'fas fa-star', Competences::class);
        yield MenuItem::linkToCrud('Experiences', 'fas fa-cogs', Experience::class);
    }
}
