<?php

namespace App\Menu;

use App\Repository\CategoryRepository;
use Knp\Menu\FactoryInterface;


class MenuBuilder
{
    private $factory;

    private $CategoryRepository;

    public function __construct(FactoryInterface $factory, CategoryRepository $CategoryRepository)
    {
        $this->factory            = $factory;
        $this->CategoryRepository = $CategoryRepository;
        
    }

    public function createMainMenu()
    { 
        // Add a parent NULL
        $MenuCategory = $this->CategoryRepository->Menu();

        $menu = $this->factory->createItem('root');
        foreach($MenuCategory as $e) {
            $menu->addChild($e->getName(), 
                ['uri' => $e->getId().'-'.$e->getSlug()]
            );

            $SubCategory = $e->getId();
            $MenuCategory = $this->CategoryRepository->SubMenu($SubCategory);

            if($MenuCategory != '') {
                foreach($MenuCategory as $r) {
                    $menu[$e->getName()]->addChild($r->getName(), [
                        'uri' => $r->getId().'-'.$r->getSlug()]
                    );
                }
            }

        }
        return $menu;
    }
}