<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\OptionRepository;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=OptionRepository::class)
 * @ORM\Table(name="`option`")
 */
#[ApiResource(
    normalizationContext:['groups' =>['lire_option']],
    denormalizationContext:['groups' =>['modifier_option']],
 
    itemOperations:[
        'put',
        'delete',
        'get'=> [
            'normalization_context' => ['groups' => ['lire_option']]
        ]
    ]
)]
class Option
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups("lire_option")
     */
    private $id;

    /**
     * @Groups("lire_option")
     * @ORM\Column(type="string", length=255)
     */
    private $libele;

    /**
     * @Groups("lire_option")
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    /**
     * @Groups("lire_option")
     * @ORM\Column(type="integer")
     */
    private $tarification;

    /**
     * @Groups("lire_option")
     * @ORM\ManyToOne(targetEntity=Reservation::class, inversedBy="options")
     */
    private $reservation;

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

    public function getTarification(): ?int
    {
        return $this->tarification;
    }

    public function setTarification(int $tarification): self
    {
        $this->tarification = $tarification;

        return $this;
    }

    public function getReservation(): ?Reservation
    {
        return $this->reservation;
    }

    public function setReservation(?Reservation $reservation): self
    {
        $this->reservation = $reservation;

        return $this;
    }
}
