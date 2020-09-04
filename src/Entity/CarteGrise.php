<?php

namespace App\Entity;

use App\Repository\CarteGriseRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=CarteGriseRepository::class)
 */
class CarteGrise
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
      * @var decimal
      * @Assert\NotBlank(message="field.not_blank")
      * @ORM\Column(name="montant", type="decimal", precision=10, scale=2)
      */
     private $montant;

  /**
   * @var \DateTime
   * @ORM\Column(name="date_debut", type="datetime")
   */
    private $date_debut;

    /**
     * @var \DateTime
     * @ORM\Column(name="date_fin", type="datetime")
     */
      private $date_fin;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Vehicule", inversedBy="carteGrises", cascade={"persist"})
     * @ORM\JoinColumn(name="vehicule_id", referencedColumnName="id")
     */
    private $vehicule;

    /**
     * @var bool
     *
     * @ORM\Column(name="deleted", type="boolean")
     */
    private $deleted = 0;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created", type="datetime")
     */
    private $created;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated", type="datetime")
     */
    private $updated;

    // getters & setters

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMontant()
    {
        return $this->montant;
    }

    public function setMontant($montant)
    {
        $this->montant = $montant;

        return $this;
    }

    public function getDateDebut()
    {
        return $this->date_debut;
    }

    public function setDateDebut($date_debut)
    {
        $this->date_debut = $date_debut;

        return $this;
    }

    public function getDateFin()
    {
        return $this->date_fin;
    }

    public function setDateFin($date_fin)
    {
        $this->date_fin = $date_fin;

        return $this;
    }

    public function getDeleted()
    {
        return $this->deleted;
    }

    public function setDeleted($deleted)
    {
        $this->deleted = $deleted;

        return $this;
    }

    public function getCreated()
    {
        return $this->created;
    }

    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

    public function getUpdated()
    {
        return $this->updated;
    }

    public function setUpdated($updated)
    {
        $this->updated = $updated;

        return $this;
    }

    public function getVehicule()
    {
        return $this->vehicule;
    }

    public function setVehicule($vehicule)
    {
        $this->vehicule = $vehicule;

        return $this;
    }
}
