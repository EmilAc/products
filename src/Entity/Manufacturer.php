<?php

namespace App\Entity;

use App\Repository\ManufacturerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=ManufacturerRepository::class)
 */
class Manufacturer
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=128)
     * @Assert\NotBlank()
     */
    private $manufacturer_name;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Product", mappedBy="manufacturer"
     */
    public $products;

    /**
     * User Constructor
     */
    public function __construct()
    {
        $this->products = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getManufacturerName()
    {
        return $this->manufacturer_name;
    }

    /**
     * @param mixed $manufacturer_name
     */
    public function setManufacturerName($manufacturer_name): void
    {
        $this->manufacturer_name = $manufacturer_name;
    }

    /**
     * @return ArrayCollection
     */
    public function getProducts(): ArrayCollection
    {
        return $this->products;
    }

    /**
     * @param ArrayCollection $products
     */
    public function setProducts(ArrayCollection $products): void
    {
        $this->products = $products;
    }

    public function getId(): ?int
    {
        return $this->id;
    }
}
