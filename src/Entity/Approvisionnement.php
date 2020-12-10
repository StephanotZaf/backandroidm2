<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\ApprovisionnementRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource(
 *     collectionOperations={"get","post"},
 *     itemOperations={"get","put","delete"},
 *     shortName="approvismt"
 * )
 * @ORM\Entity(repositoryClass=ApprovisionnementRepository::class)
 */
class Approvisionnement
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $dateApprovisionnement;

    /**
     * @ORM\OneToMany(targetEntity=ProduitApprovisionnement::class, mappedBy="approvisionnement", orphanRemoval=true)
     */
    private $produitApprovisionnements;

    public function __construct()
    {
        $this->produitApprovisionnements = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateApprovisionnement(): ?\DateTimeInterface
    {
        return $this->dateApprovisionnement;
    }

    public function setDateApprovisionnement(\DateTimeInterface $dateApprovisionnement): self
    {
        $this->dateApprovisionnement = $dateApprovisionnement;

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
            $produitApprovisionnement->setApprovisionnement($this);
        }

        return $this;
    }

    public function removeProduitApprovisionnement(ProduitApprovisionnement $produitApprovisionnement): self
    {
        if ($this->produitApprovisionnements->removeElement($produitApprovisionnement)) {
            // set the owning side to null (unless already changed)
            if ($produitApprovisionnement->getApprovisionnement() === $this) {
                $produitApprovisionnement->setApprovisionnement(null);
            }
        }

        return $this;
    }
}
