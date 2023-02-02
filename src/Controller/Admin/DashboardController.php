<?php

namespace App\Controller\Admin;

use App\Entity\Option;
use App\Entity\Property;
use App\Repository\OptionRepository;
use App\Repository\PropertyRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Controller\Admin\PropertyCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Config\Assets;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;

class DashboardController extends AbstractDashboardController
{
    protected $PropertyRepository;
    protected $optionRepository;
    public function __construct(PropertyRepository $PropertyRepository, OptionRepository $optionRepository)
    {
        $this->PropertyRepository = $PropertyRepository;
        $this->optionRepository = $optionRepository;
    }

    public function configureAssets(): Assets
    {
        return Assets::new()->addCssFile('css/admin.css');
    }
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        /* redirect to some CRUD controller
        $routeBuilder = $this->get(AdminUrlGenerator::class);

        return $this->redirect($routeBuilder->setController(PropertyCrudController::class)->generateUrl());
        */
        return $this->render('bundles/EasyAdminBundle/welcome.html.twig', [
            'countAllProperty' => $this->PropertyRepository->countAllProperty(),
            'countAllOption' => $this->optionRepository->countAllOption()
        ]);
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('<span class="fw-bolder">AGENCE <span class="text-small">TahiryM.</span></span> ');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linktoDashboard('Tableau de bord', 'fa fa-home');
        yield MenuItem::linkToCrud('Property', 'fas fa-list', Property::class);
        yield MenuItem::linkToCrud('Option', 'fa fa-recycle', Option::class);
    }
}
