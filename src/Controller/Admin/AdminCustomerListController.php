<?php

namespace App\Controller\Admin;

use App\Entity\Users;
use App\Entity\Announcement;
use App\Repository\UsersRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use App\Form\Admin\AdminModifyAnnoucementType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminCustomerListController extends AbstractController
{
    private $Users;

    public function __construct(UsersRepository $Users)
    {
        $this->Users = $Users;
    }

    /**
     * @Route("/admin/admin/customer/list", name="admin_admin_customer_list")
     */
    public function index(Request $request, PaginatorInterface $paginator): Response
    {
        $ListUserAdmin = $paginator->paginate(
            $this->Users->ListUserAdmin(),
            $request->query->getInt('page', 1),
            32
        );

        return $this->render('admin/admin_customer_list/index.html.twig', [
            'controller_name' => 'AdminCustomerListController',
            'users' => $ListUserAdmin,
        ]);
    }

    /**
     * @Route("/admin/admin/customer/list/view/{id}", name="admin_admin_customer_list_view")
     */
    public function view($id): Response
    {
        // dd($this->getDoctrine()->getManager()->getRepository(Announcement::class)->findBY( array('users' => $id) ));
        return $this->render('admin/admin_customer_list/view.html.twig', [
            'controller_name' => 'AdminCustomerListController',
            'users' => $this->getDoctrine()->getManager()->getRepository(Users::class)->find($id),
            'annonce' => $this->getDoctrine()->getManager()->getRepository(Announcement::class)->findBY( array('users' => $id) ),
        ]);
    }

    /**
     * @Route("/admin/admin/customer/list/view/{id}/{statuts}", name="admin_admin_customer_change_statuts")
     */
    public function ChangeStatuts($id, $statuts): Response
    {
        // Update the User
        $entityManager   = $this->getDoctrine()->getManager();
        $Update_User  = $entityManager->getRepository(Users::class)->find($id);

        if (!$Update_User) {
            throw $this->createNotFoundException(
                'No product found for id ' . $id
            );
        }
        $Update_User->setIsVerified($statuts);
        $entityManager->persist($Update_User);
        $entityManager->flush();

        // Show message customer
        $this->addFlash(
            'ProfileMiseAJour',
            'Le profile à bien été mise a jour.'
        );

        // Go to the show profile
        return $this->redirectToRoute('admin_admin_customer_list');
    }

    /**
     * @Route("/admin/admin/customer/Modify/annoucement/{id}", name="AdminModifyAnnoucement")
     */
    public function AdminModifyAnnoucement(Request $request, $id): Response
    {
        $ModifyAnnoucement = new Announcement();
        
        $form = $this->createForm(AdminModifyAnnoucementType::class, $ModifyAnnoucement);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager   = $this->getDoctrine()->getManager();
            $ModifyAnnoucement =  $entityManager ->getRepository(Announcement::class)->find($id);

            $ModifyAnnoucement->setEndAt($form->get('EndAt')->getData());

            $entityManager->flush();

            return $this->redirectToRoute('admin_admin_customer_list_view', [
                'id' => $id
            ]);
        }
        
        return $this->render('admin/admin_customer_list/modify_annoucement_by_admin.html.twig', [
            'annonce' => $this->getDoctrine()->getManager()->getRepository(Announcement::class)->find($id),
            'form' => $form->createView(),
        ]);
    }
}
