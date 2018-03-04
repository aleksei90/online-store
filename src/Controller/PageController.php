<?php
/**
 * Created by PhpStorm.
 * User: skillup_student
 * Date: 04.02.18
 * Time: 13:43
 */

namespace App\Controller;

use App\Entity\Slider;
use App\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PageController extends Controller
{
    public function actionIndex()
    {
        $sliders = $this-> getDoctrine()
            ->getRepository(Slider::class)
            ->getActiveSliders();

        $banners = $this-> getDoctrine()
            ->getRepository(Slider::class)
            ->getActiveBanners();

        $newProduct = $this-> getDoctrine()
            ->getRepository(Product::class)
            ->getNewProduct();

        $menu = $this->get('category_menu')->getCategoryMenu();


        return $this->render('home.html.twig', [
            'sliders' => $sliders,
            'banners' => $banners,
            'newProduct' => $newProduct,
            'menu' => $menu,
        ]);
    }


}