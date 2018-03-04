<?php

namespace App\Repository;

use Doctrine\ORM\EntityRepository;

class ProductRepository extends EntityRepository
{
        public function getNewProduct()
        {
            return $this->findBy(['isNew' => 1]);
        }
}