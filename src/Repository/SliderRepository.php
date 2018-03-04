<?php
/**
 * Created by PhpStorm.
 * User: aleks
 * Date: 17.02.18
 * Time: 13:57
 */

namespace App\Repository;
use Doctrine\ORM\EntityRepository;


class SliderRepository extends EntityRepository
{
        public function getActiveSliders()
        {
            return $this->findBy(['isActive' => 1, 'typeSlider' => 'Slider']);
        }

        public function getActiveBanners()
        {
            return $this->findBy(['isActive' => 1, 'typeSlider' => 'banner']);
        }
}