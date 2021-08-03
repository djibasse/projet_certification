<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\ReservationRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=ReservationRepository::class)
 */
#[ApiResource(
    
    normalizationContext:['groups' =>['lire_reservation']],
    denormalizationContext:['groups' =>['modifier_reservation']],
 
    itemOperations:[
        'put',
        'delete',
        'get'=> [
            'normalization_context' => ['groups' => ['lire_reservation']]
        ]
    ]
)]
class Reservation
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups("lire_reservation")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     * @Groups("lire_reservation")
     */
    private $numeroReservation;

    /**
     * @ORM\Column(type="datetime")
     * @Groups("lire_reservation")
     */
    private $dateReservation;

    /**
     * @ORM\Column(type="date")
     * @Groups("lire_reservation")
     */
    private $dateFinReservation;

    /**
     * @ORM\Column(type="integer")
     * @Groups("lire_reservation")
     */
    private $nombreDePersonne;

    /**
     * @ORM\OneToMany(targetEntity=Option::class, mappedBy="reservation")
     * @Groups("lire_reservation")
     */
    private $options;

    /**
     * @ORM\ManyToOne(targetEntity=Client::class, inversedBy="reservations")
     */
    private $client;

    /**
     * @ORM\ManyToOne(targetEntity=Chambre::class, inversedBy="reservations")
     */
    private $chambre;

    public function __construct()
    {
        $this->options = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumeroReservation(): ?int
    {
        return $this->numeroReservation;
    }

    public function setNumeroReservation(int $numeroReservation): self
    {
        $this->numeroReservation = $numeroReservation;

        return $this;
    }

    public function getDateReservation(): ?\DateTimeInterface
    {
        return $this->dateReservation;
    }

    public function setDateReservation(\DateTimeInterface $dateReservation): self
    {
        $this->dateReservation = $dateReservation;

        return $this;
    }

    public function getDateFinReservation(): ?\DateTimeInterface
    {
        return $this->dateFinReservation;
    }

    public function setDateFinReservation(\DateTimeInterface $dateFinReservation): self
    {
        $this->dateFinReservation = $dateFinReservation;

        return $this;
    }

    public function getNombreDePersonne(): ?int
    {
        return $this->nombreDePersonne;
    }

    public function setNombreDePersonne(int $nombreDePersonne): self
    {
        $this->nombreDePersonne = $nombreDePersonne;

        return $this;
    }

    /**
     * @return Collection|Option[]
     */
    public function getOptions(): Collection
    {
        return $this->options;
    }

    public function addOption(Option $option): self
    {
        if (!$this->options->contains($option)) {
            $this->options[] = $option;
            $option->setReservation($this);
        }

        return $this;
    }

    public function removeOption(Option $option): self
    {
        if ($this->options->removeElement($option)) {
            // set the owning side to null (unless already changed)
            if ($option->getReservation() === $this) {
                $option->setReservation(null);
            }
        }

        return $this;
    }

    public function getClient(): ?Client
    {
        return $this->client;
    }

    public function setClient(?Client $client): self
    {
        $this->client = $client;

        return $this;
    }

    public function getChambre(): ?Chambre
    {
        return $this->chambre;
    }

    public function setChambre(?Chambre $chambre): self
    {
        $this->chambre = $chambre;

        return $this;
    }
}
