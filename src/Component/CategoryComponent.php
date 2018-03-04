<?php

namespace App\Component;

use App\Entity\Category;
use Doctrine\ORM\EntityManager;

class CategoryComponent
{
    private $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function getCategoryMenu()
    {
        $categories = $this->em->getRepository(Category::class)->findAll();
        $categories = $this->indexKeys($categories);
        $menuArray = $this->mapping($categories);
        return $this->createMenu($menuArray);
    }


    private function createMenu($menuArray)
    {

        $i = 1;
        $count = count($menuArray);
        $html = '<ul id="nav">';
        $html .= '<li><a href="/">Home</a></li>';
        foreach ($menuArray as $menu) {
            $html .= '<li class="level0 level-top ' . $this->getClasses($menu, $i, $count) . '">';
            $html .= '<a href="/category/' . $menu['slugName'] . '" class="level-top">';
            $html .= '<span>' . $menu['name'] . '</span>';
            $html .= '</a>';
            if (!empty($menu['childs'])) {
                $html .= '<ul class="level0">';
                $html .= $this->getSubMenu($menu['childs']);
                $html .= '</ul>';
            }


            $html .= '</li>';

            $i++;
        }
        $html .= '</ul>';

        return $html;
    }

    private function getSubMenu($menu, $level = 0)
    {
        $i = 1;
        $count = count($menu);
        $html = '';
        foreach ($menu as $child) {
            $html .= '<li class="level' . ($level + 1) . '  ' . $this->getClasses($child, $i, $count) . ' ">';
            $html .= '<a href="/category/' .$child['slugName'] . '"><span>' . $child['name'] . '</span></a>';
            if (!empty($child['childs'])) {
                $html .= '<ul class="level ' . ($level + 1) . '">';
                $html .= $this->getSubMenu($child['childs'], $level + 1);
                $html .= '</ul>';

            }
            $html .= '</li>';
            $i++;
        }

        return $html;
    }

    private function getClasses($menu, $i, $count)
    {
        $classes = '';
        if ($i == 1) {
            $classes .= 'first ';
        } elseif ($i == $count) {
            $classes .= 'last ';
        }

        if (!empty($menu['childs'])) {
            $classes .= 'parent ';
        }


        return $classes;
    }

    private function mapping(array $categories)
    {
        $tree = [];
        foreach ($categories as $id => &$node) {
            if (!$node['parent']) {
                $tree[$id] = &$node;
            } else {
                $categories[$node['parent']]['childs'][$id] = &$node;
            }
        }
        return $tree;
    }

    private function indexKeys($categories)
    {
        $newArray = [];
        foreach ($categories as $category) {
            $newArray[$category->getId()] = [
                'id' => $category->getId(),
                'name' => $category->getName(),
                'parent' => $category->getParent() ? $category->getParent()->getId() : null,
                'slugName'=> $category->getSlugName()
            ];
        }

        return $newArray;
    }
}