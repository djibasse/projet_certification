<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\ChambreRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=ChambreRepository::class)
 */

#[ApiResource(
    normalizationContext:['groups' =>['lire_chambre']],
    denormalizationContext:['groups' =>['modifier_chambre']],
    
    itemOperations:[
        'put',
        'delete',
        'get'=> [
            'normalization_context' => ['groups' => ['lire_une_chambre','lire_chambre']]
        ]
    ]
)]

class Chambre
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups("lire_chambre","lire_une_chambre")
     */
    private $id;

    /**
     * @Groups("lire_chambre","lire_une_chambre","modifier_chambre")
     * @ORM\Column(type="integer")
     */
    private $numeroChambre;

    /**
     * @Groups("lire_chambre","lire_une_chambre","modifier_chambre")
     * @ORM\Column(type="integer")
     */
    private $etage;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("lire_chambre","modifier_chambre","lire_une_chambre")
     */
    private $description;

    /**
     * @ORM\Column(type="integer")
     * @Groups("lire_une_chambre","modifier_chambre")
     */
    private $prix;

    /**
     * @Groups("lire_une_chambre","modifier_chambre")
     * @ORM\Column(type="string", length=255)
     */
    private $etat;

    /**
     * @Groups("lire_une_chambre","modifier_chambre")
     * @ORM\Column(type="integer")
     */
    private $nombreDeLits;

    /**
     * @Groups("lire_une_chambre","modifier_chambre")
     * @ORM\Column(type="string", length=255)
     */
    private $chauffage;

    /**
     * @Groups("lire_une_chambre","modifier_chambre")
     * @ORM\Column(type="string", length=255)
     */
    private $salleDeBain;

    /** 
     *@Groups("lire_une_chambre","modifier_chambre")
     *@ORM\OneToMany(targetEntity=Reservation::class, mappedBy="chambre")
     */
    private $reservations;

    /**
     *@Groups("lire_une_chambre")
     *@ORM\ManyToOne(targetEntity=Categorie::class, inversedBy="chambres")
     */
    private $categorie;

    public function __construct()
    {
        $this->reservations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumeroChambre(): ?int
    {
        return $this->numeroChambre;
    }

    public function setNumeroChambre(int $numeroChambre): self
    {
        $this->numeroChambre = $numeroChambre;

        return $this;
    }

    public function getEtage(): ?int
    {
        return $this->etage;
    }

    public function setEtage(int $etage): self
    {
        $this->etage = $etage;

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

    public function getPrix(): ?int
    {
        return $this->prix;
    }

    public function setPrix(int $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getEtat(): ?string
    {
        return $this->etat;
    }

    public function setEtat(string $etat): self
    {
        $this->etat = $etat;

        return $this;
    }

    public function getNombreDeLits(): ?int
    {
        return $this->nombreDeLits;
    }

    public function setNombreDeLits(int $nombreDeLits): self
    {
        $this->nombreDeLits = $nombreDeLits;

        return $this;
    }

    public function getChauffage(): ?string
    {
        return $this->chauffage;
    }

    public function setChauffage(string $chauffage): self
    {
        $this->chauffage = $chauffage;

        return $this;
    }
    public function __toString()
    {
return (string) $this->numeroChambre;
    }


    public function getSalleDeBain(): ?string
    {
        return $this->salleDeBain;
    }

    public function setSalleDeBain(string $salleDeBain): self
    {
        $this->salleDeBain = $salleDeBain;

        return $this;
    }

    /**
     * @return Collection|Reservation[]
     */
    public function getReservations(): Collection
    {
        return $this->reservations;
    }

    public function addReservation(Reservation $reservation): self
    {
        if (!$this->reservations->contains($reservation)) {
            $this->reservations[] = $reservation;
            $reservation->setChambre($this);
        }

        return $this;
    }
    

    public function removeReservation(Reservation $reservation): self
    {
        if ($this->reservations->removeElement($reservation)) {
            // set the owning side to null (unless already changed)
            if ($reservation->getChambre() === $this) {
                $reservation->setChambre(null);
            }
        }

        return $this;
    }

    public function getCategorie(): ?Categorie
    {
        return $this->categorie;
    }

    public function setCategorie(?Categorie $categorie): self
    {
        $this->categorie = $categorie;

        return $this;
    }
}
