<?php

namespace App\Controller\Admin;

use App\Entity\PackageAdTextual;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\Admin\AdminCatalogAnnouncementType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminCatalogAnnouncementController extends AbstractController
{
    /**
     * @Route("/admin/admin/catalog/announcement", name="admin_admin_catalog_announcement")
     */
    public function index_catalog_annoncement(): Response
    {
        return $this->render('admin/admin_catalog_announcement/index.html.twig', [
            'controller_name' => 'AdminCatalogAnnouncementController',
        ]);
    }

    /**
     * @Route("/admin/admin/catalog/announcement/view/{id}", name="admin_admin_catalog_announcement_view")
     */
    public function view_catalog_annoncement($id): Response
    {
        $entityManager   = $this->getDoctrine()->getManager();
        $ViewPack  = $entityManager->getRepository(PackageAdTextual::class)->findBy(  array('type' => $id)  );
        
        return $this->render('admin/admin_catalog_announcement/view_package.html.twig', [
            'controller_name' => 'AdminCatalogAnnouncementController',
            'ViewPack' => $ViewPack,

        ]);
    }


    /**
     * @Route("/admin/admin/catalog/announcement/edit/{id}", name="admin_admin_catalog_announcement_edit")
     */
    public function edit_catalog_annoncement($id, Request $request): Response
    {
        $view = new PackageAdTextual();
        $view = $this->createForm(AdminCatalogAnnouncementType::class, $view);
        $view->handleRequest($request);

        $entityManager   = $this->getDoctrine()->getManager();
        $Update_Catalog_Annoncement  = $entityManager->getRepository(PackageAdTextual::class)->find($id);

        if ($view->isSubmitted() && $view->isValid()) {

            $entityManager   = $this->getDoctrine()->getManager();
            $Update_Catalog_Annoncement  = $entityManager->getRepository(PackageAdTextual::class)->find($id);

            if (!$Update_Catalog_Annoncement) {
                throw $this->createNotFoundException(
                    'No product found for id ' . $this->getUser()->getId()
                );
            }

            $Update_Catalog_Annoncement->setName($view->get('name')->getData());
            $Update_Catalog_Annoncement->setNbrDays($view->get('nbrDays')->getData());
            $Update_Catalog_Annoncement->setPricePerDay($view->get('pricePerDay')->getData());
            $Update_Catalog_Annoncement->setType($id);

            $entityManager->persist($Update_Catalog_Annoncement);
            $entityManager->flush();

            return $this->redirectToRoute('admin_admin_catalog_announcement');

        }
        
        return $this->render('admin/admin_catalog_announcement/edit_package.html.twig', [
            'controller_name' => 'AdminCatalogAnnouncementController',
            'form' => $view->createView(),
            'Update_Catalog_Annoncement' => $Update_Catalog_Annoncement,
        ]);
    }


}
