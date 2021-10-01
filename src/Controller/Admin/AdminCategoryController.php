<?php

namespace App\Controller\Admin;

use App\Entity\Category;
use App\Form\Admin\CategoryType;
use App\Repository\CategoryRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminCategoryController extends AbstractController
{
    private $Category;

    public function __construct(CategoryRepository $Category)
    {
        $this->Category = $Category;
    }
    
    /**
     * @Route("/admin/admin/category", name="admin_admin_category")
     */
    public function index(): Response
    {
        $Category = $this->Category->Menu();

        return $this->render('admin/admin_category/index.html.twig', [
            'controller_name' => 'AdminCategoryController',
            'category' => $Category
        ]);
    }

    /**
     * @Route("/admin/admin/subcategory/{SubCategory}", name="admin_admin_subcategory")
     */
    public function SubCategory($SubCategory): Response
    {
        $Category = $this->Category->SubMenu($SubCategory);

        return $this->render('admin/admin_category/index.html.twig', [
            'subcategory' => 'subcategory',
            'category' => $Category,
            'id' => $SubCategory,
        ]);
    }

    /**
     * @Route("/admin/admin/subcategory/delete/{SubCategory}", name="admin_admin_subcategory_delete")
     */
    public function DeleteSubCategory($SubCategory): Response
    {

        return $this->render('admin/admin_category/index.html.twig', [
            'controller_name' => 'AdminCategoryController',
        ]);
    }

    /**
     * @Route("/admin/admin/category/update/{id}", name="admin_admin_subcategory_update")
     */
    public function UpdateCategory($id, Request $request): Response
    {

        $category = new Category();
        $category = $this->createForm(CategoryType::class, $category); 
        $category->handleRequest($request);

        if ($category->isSubmitted() && $category->isValid()) {

            $entityManager   = $this->getDoctrine()->getManager();
            $Update_Category  = $entityManager->getRepository(category::class)->find($id);

            if (!$Update_Category) {
                throw $this->createNotFoundException(
                    'No product found for id ' . $this->getUser()->getId()
                );
            }

            $Update_Category->setName($category->get('Name')->getData());

            $entityManager->persist($Update_Category);
            $entityManager->flush();

            return $this->redirectToRoute('admin_admin_category');

        }
        
        return $this->render('admin/admin_category/update_category.html.twig', [
            'controller_name' => 'AdminCategoryController',
            'form' => $category->createView(),
        ]);
    }

    /**
     * @Route("/admin/admin/category/createcategory", name="admin_admin_category_createcategory")
     */
    public function CreateCategory(Request $request): Response
    {
        $category = new Category();
        $category = $this->createForm(CategoryType::class, $category); 
        $category->handleRequest($request);

        if ($category->isSubmitted() && $category->isValid()) { 
          $entityManager = $this->getDoctrine()->getManager();
          
          $updatecategory = new Category();
          $updatecategory->setName($category->get('Name')->getData());

          $entityManager->persist($updatecategory);
          $entityManager->flush();

          return $this->redirectToRoute('admin_admin_category');
        }

        return $this->render('admin/admin_category/add_category.html.twig', [
            'controller_name' => 'AdminCategoryController',
            'form' => $category->createView(),
        ]);
    }

    /**
     * @Route("/admin/admin/category/createSubcategory/{id}", name="admin_admin_category_createSubcategory")
     */
    public function CreateSubCategory(Request $request, $id): Response
    {
        $category = new Category();
        $category = $this->createForm(CategoryType::class, $category); 
        $category->handleRequest($request);

        if ($category->isSubmitted() && $category->isValid()) {

            $entityManager   = $this->getDoctrine()->getManager();
            $Update_Category  = $entityManager->getRepository(category::class)->find($id);

            $UpdateSubCategory = new Category();

            $UpdateSubCategory->setName($category->get('Name')->getData());
            $UpdateSubCategory->setParent($Update_Category);

            $entityManager->persist($UpdateSubCategory);
            $entityManager->flush();

            return $this->redirectToRoute('admin_admin_subcategory', [
                'SubCategory' => $id
            ]);

        }
        
        return $this->render('admin/admin_category/add_subcategory.html.twig', [
            'controller_name' => 'AdminCategoryController',
            'form' => $category->createView(),
        ]);
    }
}
