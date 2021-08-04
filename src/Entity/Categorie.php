<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\CategorieRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=CategorieRepository::class)
 */

#[ApiResource(
    normalizationContext:['groups' =>['lire_categorie']],
    denormalizationContext:['groups' =>['modifier_categorie']],
    
    itemOperations:[
        'put',
        'delete',
        'get'=> [
            'normalization_context' => ['groups' => ['lire_une_categorie','lire_categorie']]
        ]
    ]
)]

class Categorie
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups("lire_categorie")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("lire_categorie","modifier_categorie","lire_une_chambre")
     */
    private $libele;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("lire_categorie","modifier_categorie","lire_une_chambre")
     */
    private $description;

    /**
     * @Groups("lire_une_categorie")
     * @ORM\OneToMany(targetEntity=Chambre::class, mappedBy="categorie")
     */
    private $chambres;

    public function __construct()
    {
        $this->chambres = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibele(): ?string
    {
        return $this->libele;
    }

    public function setLibele(string $libele): self
    {
        $this->libele = $libele;

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

    /**
     * @return Collection|Chambre[]
     */
    public function getChambres(): Collection
    {
        return $this->chambres;
    }

    public function addChambre(Chambre $chambre): self
    {
        if (!$this->chambres->contains($chambre)) {
            $this->chambres[] = $chambre;
            $chambre->setCategorie($this);
        }

        return $this;
    }

    public function removeChambre(Chambre $chambre): self
    {
        if ($this->chambres->removeElement($chambre)) {
            // set the owning side to null (unless already changed)
            if ($chambre->getCategorie() === $this) {
                $chambre->setCategorie(null);
            }
        }

        return $this;
    }
}
