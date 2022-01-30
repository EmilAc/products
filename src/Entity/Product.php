<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProductRepository::class)
 */
class Product
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $product_number;

    /**
     * @ORM\Column(type="integer")
     */
    private $category_name;

    /**
     * @ORM\Column(type="integer")
     */
    private $department_name;

    /**
     * @ORM\Column(type="integer")
     */
    private $manufacturer_name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $upc;

    /**
     * @ORM\Column(type="integer")
     */
    private $sku;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=0)
     */
    private $regular_price;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=0)
     */
    private $sale_price;

    /**
     * @ORM\Column(type="string", length=1024, nullable=true)
     */
    private $description;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProductNumber(): ?string
    {
        return $this->product_number;
    }

    public function setProductNumber(string $product_number): self
    {
        $this->product_number = $product_number;

        return $this;
    }

    public function getCategoryName(): ?int
    {
        return $this->category_name;
    }

    public function setCategoryName(int $category_name): self
    {
        $this->category_name = $category_name;

        return $this;
    }

    public function getDepartmentName(): ?int
    {
        return $this->department_name;
    }

    public function setDepartmentName(int $department_name): self
    {
        $this->department_name = $department_name;

        return $this;
    }

    public function getManufacturerName(): ?int
    {
        return $this->manufacturer_name;
    }

    public function setManufacturerName(int $manufacturer_name): self
    {
        $this->manufacturer_name = $manufacturer_name;

        return $this;
    }

    public function getUpc(): ?string
    {
        return $this->upc;
    }

    public function setUpc(string $upc): self
    {
        $this->upc = $upc;

        return $this;
    }

    public function getSku(): ?int
    {
        return $this->sku;
    }

    public function setSku(int $sku): self
    {
        $this->sku = $sku;

        return $this;
    }

    public function getRegularPrice(): ?string
    {
        return $this->regular_price;
    }

    public function setRegularPrice(string $regular_price): self
    {
        $this->regular_price = $regular_price;

        return $this;
    }

    public function getSalePrice(): ?string
    {
        return $this->sale_price;
    }

    public function setSalePrice(string $sale_price): self
    {
        $this->sale_price = $sale_price;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }
}
