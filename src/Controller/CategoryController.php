<?php
/**
 * Created by PhpStorm.
 * User: aleks
 * Date: 02.03.18
 * Time: 20:52
 */

namespace App\Controller;

use App\Entity\Category;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class CategoryController extends Controller
{

    /**
     * @Route("category/{slugName}")
     */
    public function ActionIndex($slugName)
    {
        $menu = $this->get('category_menu')->getCategoryMenu();
        $currentCategory = $this->getDoctrine()
            ->getRepository(Category::class)
            ->findOneBy(['slugName' => $slugName]);

        $childCategory = $this->getDoctrine($slugName)
            ->getRepository(Category::class)
            ->findBy(['parent' => $currentCategory]);


        return $this->render('category.html.twig', [
            'menu' => $menu,
            'currentCategory' => $currentCategory,
            'childCategory' => $childCategory,
        ]);
    }

}