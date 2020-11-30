<?php

namespace App\Entity;

use App\Repository\ProduitApprovisionnementRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProduitApprovisionnementRepository::class)
 */
class ProduitApprovisionnement
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $quantiteApprovisionnee;

    /**
     * @ORM\ManyToOne(targetEntity=Approvisionnement::class, inversedBy="produitApprovisionnements")
     * @ORM\JoinColumn(nullable=false)
     */
    private $approvisionnement;

    /**
     * @ORM\ManyToOne(targetEntity=Produit::class, inversedBy="produitApprovisionnements")
     * @ORM\JoinColumn(nullable=false)
     */
    private $produit;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuantiteApprovisionnee(): ?int
    {
        return $this->quantiteApprovisionnee;
    }

    public function setQuantiteApprovisionnee(int $quantiteApprovisionnee): self
    {
        $this->quantiteApprovisionnee = $quantiteApprovisionnee;

        return $this;
    }

    public function getApprovisionnement(): ?Approvisionnement
    {
        return $this->approvisionnement;
    }

    public function setApprovisionnement(?Approvisionnement $approvisionnement): self
    {
        $this->approvisionnement = $approvisionnement;

        return $this;
    }

    public function getProduit(): ?Produit
    {
        return $this->produit;
    }

    public function setProduit(?Produit $produit): self
    {
        $this->produit = $produit;

        return $this;
    }
}
