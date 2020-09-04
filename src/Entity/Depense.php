<?php

namespace App\Entity;

use App\Repository\DepenseRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=DepenseRepository::class)
 */
class Depense
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string
     * @Assert\NotBlank(message="field.not_blank")
     * @ORM\Column(name="name", type="string", length=25, nullable=true)
     */
    private $name;


    /**
      * @var decimal
      * @Assert\NotBlank(message="field.not_blank")
      * @ORM\Column(name="montant", type="decimal", precision=10, scale=2)
      */
     private $montant;

     /**
     * @ORM\ManyToOne(targetEntity="Candidat", inversedBy="candidat")
      * @ORM\JoinColumn(name="candidat_id", referencedColumnName="id" , nullable=true)
      */
     private $candidat;

     /**
      * @ORM\Column(name="statut" , type="integer")
      */
     private $statut;


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



    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    public function getStatut()
    {
        return $this->statut;
    }

    public function setStatut($statut)
    {
        $this->statut = $statut;

        return $this;
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



    public function getDeleted()
    {
        return $this->deleted;
    }

    public function setDeleted(bool $deleted)
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

    public function getCandidat()
    {
        return $this->candidat;
    }

    public function setCandidat($candidat)
    {
        $this->candidat = $candidat;

        return $this;
    }






}
