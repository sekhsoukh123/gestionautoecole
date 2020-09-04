<?php

namespace App\Entity;

use App\Repository\CpratiqueRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass=CpratiqueRepository::class)
 * @ORM\HasLifecycleCallbacks()
 */
class Cpratique
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
      * @ORM\Column(name="seance", type="integer")
      */
     private $seance;


    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Candidat", inversedBy="cpratiques", cascade={"persist"})
     * @ORM\JoinColumn(name="candidat_id", referencedColumnName="id")
     */
    private $candidat;

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

    public function getSeance()
    {
        return $this->seance;
    }

    public function setSeance($seance)
    {
        $this->seance = $seance;

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
