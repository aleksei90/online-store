<?php
/**
 * Created by PhpStorm.
 * User: aleks
 * Date: 18.02.18
 * Time: 14:27
 */

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity()
 * @ORM\Table(indexes={@ORM\Index(name="slugName", columns={"slug_name"})})
 */
class Category
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;
    /**
     * @ORM\Column(type="string")
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity="Category")
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="id", nullable=true, onDelete="CASCADE" )
     */
    private $parent;
    /**
     * @ORM\Column(type="string")
     */
    private $slugName;

    /**
     * @return mixed
     */
    public function getSlugName()
    {
        return $this->slugName;
    }

    /**
     * @param mixed $slugName
     */
    public function setSlugName($slugName)
    {
        $this->slugName = $slugName;
    }


    public function __toString()
    {
        return $this->getName();
    }

    public function getLaveledTitle()
    {
        return (string)$this;
    }


    public function getId()
    {
        return $this->id;
    }


    public function getName()
    {
        return $this->name;
    }


    public function setName($name)
    {
        $this->name = $name;
    }


    public function getParent()
    {
        return $this->parent;
    }


    public function setParent($parent)
    {
        $this->parent = $parent;
    }
}