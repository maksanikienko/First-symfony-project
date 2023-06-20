<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use Symfony\Component\Serializer\Annotation\Ignore;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: ProductRepository::class)]
class Product
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy:'SEQUENCE')]
    #[ORM\Column(type:'integer')]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['fav_product'])]
    private ?string $name = null;

    #[ORM\Column(type: 'text')]
    #[Groups(['fav_product'])]
    private ?string $description = null;

    #[ORM\Column]
    #[Groups(['fav_product'])]
    private ?int $price = null;

    #[ORM\Column(length:255, nullable: true)]
    private ?int $rating = null;

    #[ORM\Column(length: 255)]
    private ?string $brand = null;

    #[ORM\Column]
    private ?bool $availability = null;

    #[ORM\Column(nullable: true)]
    private ?int $number = null;

    #[ORM\Column(length:255, nullable: true)]
    private bool $promoted = false;

    #[ORM\Column(length:255, nullable: true)]
    private ?string $image = null;

    #[ORM\ManyToOne(inversedBy: 'products')]
    #[ORM\JoinColumn(nullable: true)]
    private ?Category $category = null;

    #[ORM\OneToMany(mappedBy: 'product', targetEntity: FavoriteProduct::class)]
    #[Ignore]
    private Collection $favoriteProducts;

    public function __construct()
    {
        $this->favoriteProducts = new ArrayCollection();
    }


    public function setId(string $id): self
    {
        $this->id = $id;

        return $this;
    }
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getRating(): ?int
    {
        return $this->rating;
    }

    public function setRating(int $rating): self
    {
        $this->rating = $rating;

        return $this;
    }

    public function getBrand(): ?string
    {
        return $this->brand;
    }

    public function setBrand(string $brand): self
    {
        $this->brand = $brand;

        return $this;
    }

    public function isAvailability(): ?bool
    {
        return $this->availability;
    }

    public function setAvailability(bool $availability): self
    {
        $this->availability = $availability;

        return $this;
    }

    public function getNumber(): ?int
    {
        return $this->number;
    }

    public function setNumber(int $number): self
    {
        $this->number = $number;

        return $this;
    }

    public function isPromoted(): ?bool
    {
        return $this->promoted;
    }

    public function setPromoted(bool $promoted): self
    {
        $this->promoted = $promoted;

        return $this;
    }
    
    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }

    /**
     * @return Collection<int, FavoriteProduct>
     */
    public function getFavoriteProducts(): Collection
    {
        return $this->favoriteProducts;
    }

    public function addFavoriteProduct(FavoriteProduct $favoriteProduct): self
    {
        if (!$this->favoriteProducts->contains($favoriteProduct)) {
            $this->favoriteProducts->add($favoriteProduct);
            $favoriteProduct->setProduct($this);
        }

        return $this;
    }

    public function removeFavoriteProduct(FavoriteProduct $favoriteProduct): self
    {
        if ($this->favoriteProducts->removeElement($favoriteProduct)) {
            // set the owning side to null (unless already changed)
            if ($favoriteProduct->getProduct() === $this) {
                $favoriteProduct->setProduct(null);
            }
        }

        return $this;
    }

    
}
