<?php

namespace App\Entity;

use App\Repository\EntrepriseRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=EntrepriseRepository::class)
 */
class Entreprise
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
     * @var string
     * @Assert\NotBlank(message="field.not_blank")
     * @ORM\Column(name="directeur_name", type="string", length=25, nullable=true)
     */
    private $directeur_name;

    /**
     * @var string
     * @Assert\NotBlank(message="field.not_blank")
     * @ORM\Column(name="num_licence", type="string", length=25, nullable=true)
     */
    private $num_licence;

    /**
     * @var \DateTime
      * @Assert\NotBlank(message="field.not_blank")
     * @ORM\Column(name="$date_licence", type="date", nullable=true)
     */
    private $date_licence;

    /**
     * @var string
     * @Assert\NotBlank(message="field.not_blank")
     * @ORM\Column(name="num_fiscal_pro", type="string", length=25, nullable=true)
     */
    private $num_fiscal_pro;
    /**
     * @var string
     * @Assert\NotBlank(message="field.not_blank")
     * @ORM\Column(name="num_enregistrement_commercial", type="string", length=25, nullable=true)
     */
    private $num_enregistrement_commercial;

    /**
     * @var string
     * @Assert\NotBlank(message="field.not_blank")
     * @ORM\Column(name="ville_commercial", type="string", length=25, nullable=true)
     */
    private $ville_commercial;

    /**
     * @var string
     * @Assert\NotBlank(message="field.not_blank")
     * @ORM\Column(name="ice", type="string", length=25, nullable=true)
     */
    private $ice;

    /**
     * @var string
      * @Assert\NotBlank(message="field.not_blank")
     * @ORM\Column(name="telephone1", type="string", length=15)
     */
    private $telephone1;

    /**
     * @var string
      * @Assert\NotBlank(message="field.not_blank")
     * @ORM\Column(name="fax", type="string", length=15, nullable=true)
     */
    private $fax;

    /**
      * @var string
      * @Assert\Regex("/^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$/",message="field.not_blank")
      * @ORM\Column(name="email", type="string", length=120)
      */
     private $email;

     /**
      * @var string
      * @Assert\NotBlank(message="field.not_blank")
      * @ORM\Column(name="ville", type="string", length=25, nullable=true)
      */
     private $ville;

     /**
      * @var string
      * @Assert\NotBlank(message="field.not_blank")
      * @ORM\Column(name="pays", type="string", length=25, nullable=true)
      */
     private $pays;


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

      // ////////////Getters & setters

    public function getId(): ?int
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

    public function getDirecteurName()
    {
        return $this->directeur_name;
    }

    public function setDirecteurName($directeur_name)
    {
        $this->directeur_name = $directeur_name;

        return $this;
    }

    public function getNumLicence()
    {
        return $this->num_licence;
    }

    public function setNumLicence($num_licence)
    {
        $this->num_licence = $num_licence;

        return $this;
    }

    public function getDateLicence()
    {
        return $this->date_licence;
    }

    public function setDateLicence($date_licence)
    {
        $this->date_licence = $date_licence;

        return $this;
    }

    public function getNumFiscalPro()
    {
        return $this->num_fiscal_pro;
    }

    public function setNumFiscalPro($num_fiscal_pro)
    {
        $this->num_fiscal_pro = $num_fiscal_pro;

        return $this;
    }

    public function getNumEnregistrementCommercial()
    {
        return $this->num_enregistrement_commercial;
    }

    public function setNumEnregistrementCommercial($num_enregistrement_commercial)
    {
        $this->num_enregistrement_commercial = $num_enregistrement_commercial;

        return $this;
    }

    public function getVilleCommercial()
    {
        return $this->ville_commercial;
    }

    public function setVilleCommercial($ville_commercial)
    {
        $this->ville_commercial = $ville_commercial;

        return $this;
    }

    public function getIce()
    {
        return $this->ice;
    }

    public function setIce($ice)
    {
        $this->ice = $ice;

        return $this;
    }

    public function getTelephone1()
    {
        return $this->telephone1;
    }

    public function setTelephone1(string $telephone1)
    {
        $this->telephone1 = $telephone1;

        return $this;
    }

    public function getFax()
    {
        return $this->fax;
    }

    public function setFax($fax)
    {
        $this->fax = $fax;

        return $this;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail(string $email)
    {
        $this->email = $email;

        return $this;
    }

    public function getVille()
    {
        return $this->ville;
    }

    public function setVille($ville)
    {
        $this->ville = $ville;

        return $this;
    }

    public function getPays()
    {
        return $this->pays;
    }

    public function setPays($pays)
    {
        $this->pays = $pays;

        return $this;
    }

    public function getDeleted(): ?bool
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
}
