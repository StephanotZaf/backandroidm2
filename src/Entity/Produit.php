<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\ProduitRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *     collectionOperations={"get","post"},
 *     itemOperations={
 *          "get"={"normalization_context"={"groups"={"product_listing:write"}}
 *                  },
 *          "put"
 *                      },
 *     normalizationContext={"groups"={"product_listing:read"}},
 *     denormalizationContext={"groups"={"product_listing:write"}}
 * )
 * @ORM\Entity(repositoryClass=ProduitRepository::class)
 * @ORM\HasLifecycleCallbacks()
 */
class Produit
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"product_listing:read","product_listing:write"})
     */
    private $libelleProduit;

    /**
     * @ORM\Column(type="float")
     * @Groups({"product_listing:read","product_listing:write"})
     */
    private $prixUnitaire;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"product_listing:read"})
     */
    private $quantiteEnStock;

    /**
     * @ORM\OneToMany(targetEntity=ProduitApprovisionnement::class, mappedBy="produit", orphanRemoval=true)
     */
    private $produitApprovisionnements;

    /**
     * @ORM\OneToMany(targetEntity=LigneCommande::class, mappedBy="produit", orphanRemoval=true)
     */
    private $ligneCommandes;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"product_listing:write","product_listing:read"})
     */
    private $image;

    public function __construct()
    {
        $this->produitApprovisionnements = new ArrayCollection();
        $this->ligneCommandes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelleProduit(): ?string
    {
        return $this->libelleProduit;
    }

    public function setLibelleProduit(string $libelleProduit): self
    {
        $this->libelleProduit = $libelleProduit;

        return $this;
    }

    public function getPrixUnitaire(): ?float
    {
        return $this->prixUnitaire;
    }

    public function setPrixUnitaire(float $prixUnitaire): self
    {
        $this->prixUnitaire = $prixUnitaire;

        return $this;
    }

    public function getQuantiteEnStock(): ?int
    {
        return $this->quantiteEnStock;
    }

    public function setQuantiteEnStock(int $quantiteEnStock): self
    {
        $this->quantiteEnStock = $quantiteEnStock;

        return $this;
    }

    /**
     * @return Collection|ProduitApprovisionnement[]
     */
    public function getProduitApprovisionnements(): Collection
    {
        return $this->produitApprovisionnements;
    }

    public function addProduitApprovisionnement(ProduitApprovisionnement $produitApprovisionnement): self
    {
        if (!$this->produitApprovisionnements->contains($produitApprovisionnement)) {
            $this->produitApprovisionnements[] = $produitApprovisionnement;
            $produitApprovisionnement->setProduit($this);
        }

        return $this;
    }

    public function removeProduitApprovisionnement(ProduitApprovisionnement $produitApprovisionnement): self
    {
        if ($this->produitApprovisionnements->removeElement($produitApprovisionnement)) {
            // set the owning side to null (unless already changed)
            if ($produitApprovisionnement->getProduit() === $this) {
                $produitApprovisionnement->setProduit(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|LigneCommande[]
     */
    public function getLigneCommandes(): Collection
    {
        return $this->ligneCommandes;
    }

    public function addLigneCommande(LigneCommande $ligneCommande): self
    {
        if (!$this->ligneCommandes->contains($ligneCommande)) {
            $this->ligneCommandes[] = $ligneCommande;
            $ligneCommande->setProduit($this);
        }

        return $this;
    }

    public function removeLigneCommande(LigneCommande $ligneCommande): self
    {
        if ($this->ligneCommandes->removeElement($ligneCommande)) {
            // set the owning side to null (unless already changed)
            if ($ligneCommande->getProduit() === $this) {
                $ligneCommande->setProduit(null);
            }
        }

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

    /**
     * @ORM\PrePersist
     */
    public function setQuantiteEnStockInit()
    {
        $this->quantiteEnStock = 0;
    }
}
