<?php

namespace App\Twig;

use App\Repository\CategoryRepository;
use Symfony\Component\Routing\Generator\UrlGenerator;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class AppExtension extends AbstractExtension
{
    private CategoryRepository $CategoryRepository;
    private UrlGeneratorInterface $urlGenerator;

    public function __construct(CategoryRepository $repository,UrlGeneratorInterface $urlGenerator)
    {
        $this->CategoryRepository = $repository;
        $this->urlGenerator = $urlGenerator;
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('getCategories', [$this, 'getCategories']),
        ];
    }

    public function getCategories()
    {
        $MenuCategory = $this->CategoryRepository->Menu();

        $allmenu = [];
        foreach($MenuCategory as $e) {
            $menu = [
                'name' => $e->getName(),
                'uri' => $this->urlGenerator->generate('site_category',['id'=>$e->getId(),'slug'=>$e->getSlug()]),
                'submenus' => []
            ];
            $SubCategory = $e->getId();
            $MenuCategory = $this->CategoryRepository->SubMenu($SubCategory);

            if($MenuCategory != '') {
                foreach($MenuCategory as $r) {
                    $submenu = [
                        'name' => $r->getName(),
                        'uri' => $this->urlGenerator->generate('site_category',['id'=>$e->getId(),'slug'=>$e->getSlug()]),
                    ];
                    $menu['submenus'][] = $submenu;
                }
            }
            $allmenu[] = $menu;

        }
        return $allmenu;
    }
}