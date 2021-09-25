<?php

namespace App\Twig;

use App\Repository\CategoryRepository;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class AppExtension extends AbstractExtension
{
    private CategoryRepository $CategoryRepository;
    public function __construct(CategoryRepository $repository)
    {
        $this->CategoryRepository = $repository;
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
                'uri' => '/'.$e->getId().'-'.$e->getSlug(),
                'submenus' => []
            ];
            $SubCategory = $e->getId();
            $MenuCategory = $this->CategoryRepository->SubMenu($SubCategory);

            if($MenuCategory != '') {
                foreach($MenuCategory as $r) {
                    $submenu = [
                        'name' => $r->getName(),
                        'uri' => '/'.$r->getId().'-'.$r->getSlug(),
                    ];
                    $menu['submenus'][] = $submenu;
                }
            }
            $allmenu[] = $menu;

        }
        return $allmenu;
    }
}