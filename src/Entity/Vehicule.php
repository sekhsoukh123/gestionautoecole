<?php

namespace App\Entity;

use App\Repository\VehiculeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass=VehiculeRepository::class)
  * @ORM\HasLifecycleCallbacks()
 */
class Vehicule
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    public function getId()
    {
        return $this->id;
    }

    /**
   * @var string
   *
   * @Assert\NotBlank(message="field.not_blank")
   * @ORM\Column(name="immatriculation", type="string", length=255)
   */
  protected $immatriculation;

  /**
 * @var string
 * @Assert\File(
 *        maxSize = "5M",
 *        mimeTypes = {"image/jpeg","image/png", "image/jpg"},
 *        mimeTypesMessage = "uplaod.file.valid_image"
 * )
 * @ORM\Column(name="photo", type="string", length=255, nullable=true)
 */
private $photo;

    /**
   * @var string
   *
   * @Assert\NotBlank(message="field.not_blank")
   * @ORM\Column(name="marque", type="string")
   */
  protected $marque;

  /**
  * @var string
  *
  * @Assert\NotBlank(message="field.not_blank")
  * @ORM\Column(name="model", type="string")
  */
  protected $model;

  /**
  * @var int
  * @ORM\OneToMany(targetEntity="App\Entity\Assurance",  mappedBy="vehicule")
  */
  protected $assurances;

  /**
  * @var int
  * @ORM\OneToMany(targetEntity="App\Entity\VisiteTechnique",  mappedBy="vehicule")
  */
  protected $visite_techniques;

  /**
  * @var int
  * @ORM\OneToMany(targetEntity="App\Entity\Vignette",  mappedBy="vehicule")
  */
  protected $vignettes;

  /**
  * @var int
  * @ORM\OneToMany(targetEntity="App\Entity\CarteGrise",  mappedBy="vehicule")
  */
  protected $carte_grises;

  /**
   * @var \DateTime
   *
   * @ORM\Column(name="date_exp_carte_grise", type="datetime", nullable=true)
   */
  private $date_exp_carte_grise;

  /**
   * @var \DateTime
   *
   * @ORM\Column(name="date_prc_assurance", type="datetime", nullable=true)
   */
  private $date_prc_assurance;

  /**
   * @var \DateTime
   *
   * @ORM\Column(name="date_prc_vignette", type="datetime", nullable=true)
   */
  private $date_prc_vignette;

  /**
   * @var \DateTime
   *
   * @ORM\Column(name="date_prc_visite_technique", type="datetime", nullable=true)
   */
  private $date_prc_visite_technique;

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
    protected $created;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated", type="datetime")
     */
    protected $updated;



  public function __construct()
  {
      $this->assurances = new ArrayCollection();
      $this->visite_techniques = new ArrayCollection();
      $this->vignettes = new ArrayCollection();
      $this->carte_grises = new ArrayCollection();

  }

  public function getImmatriculation()
  {
      return $this->immatriculation;
  }

  public function setImmatriculation($immatriculation)
  {
      $this->immatriculation = $immatriculation;

      return $this;
  }

  public function getPhoto()
  {
      return $this->photo;
  }

  public function setPhoto($photo)
  {
      $this->photo = $photo;

      return $this;
  }

  public function getMarque()
  {
      return $this->marque;
  }

  public function setMarque($marque)
  {
      $this->marque = $marque;

      return $this;
  }

  public function getModel()
  {
      return $this->model;
  }

  public function setModel($model)
  {
      $this->model = $model;

      return $this;
  }

  public function getAssurances()
  {
      return $this->assurances;
  }

  public function setAssurances($assurances)
  {
      $this->assurances = $assurances;

      return $this;
  }

  public function getVignettes()
  {
      return $this->vignettes;
  }

  public function setVignettes($vignettes)
  {
      $this->vignettes = $vignettes;

      return $this;
  }

  public function getCarteGrises()
  {
      return $this->carte_grises;
  }

  public function setCarteGrises($carte_grises)
  {
      $this->carte_grises = $carte_grises;

      return $this;
  }

  public function getVisiteTechniques()
  {
      return $this->visite_techniques;
  }


  public function setVisiteTechniques($visite_techniques)
  {
      $this->visite_techniques = $visite_techniques;

      return $this;
  }


         /**
       * Set created
       *
       * @param \DateTime $created
       *
       * @return Vehicule
       */
      public function setCreated($created)
      {
          $this->created = $created;

          return $this;
      }

      /**
       * Get created
       *
       * @return \DateTime
       */
      public function getCreated()
      {
          return $this->created;
      }
      ///////////////////////////////////////

        /**
         * Set updated
         *
         * @param \DateTime $updated
         *
         * @return Vehicule
         */
        public function setUpdated($updated)
        {
            $this->updated = $updated;

            return $this;
        }

        /**
         * Get updated
         *
         * @return \DateTime
         */
        public function getUpdated()
        {
            return $this->updated;
        }

        /**
         * Set deleted
         *
         * @param boolean $deleted
         *
         * @return Vehicule
         */
        public function setDeleted($deleted)
        {
            $this->deleted = $deleted;

            return $this;
        }

        /**
         * Get deleted
         *
         * @return boolean
         */
        public function getDeleted()
        {
            return $this->deleted;
        }


        // LifeCycleCallback ------------------------------------------------------

        /**
         * @ORM\PrePersist
         */
        public function onPrePersist() {
          $this->created = new \DateTime("now");
          $this->updated = new \DateTime();
        }

        /**
         * @ORM\PreUpdate
         */
        public function onPreUpdate() {
          $this->updated = new \DateTime();
        }

        public function __toString()
          {
              return ($this->immatriculation);
          }

        public function getDateExpCarteGrise()
        {
            return $this->date_exp_carte_grise;
        }

        public function setDateExpCarteGrise($date_exp_carte_grise)
        {
            $this->date_exp_carte_grise = $date_exp_carte_grise;

            return $this;
        }

        public function getDatePrcAssurance()
        {
            return $this->date_prc_assurance;
        }

        public function setDatePrcAssurance($date_prc_assurance)
        {
            $this->date_prc_assurance = $date_prc_assurance;

            return $this;
        }

        public function getDatePrcVignette()
        {
            return $this->date_prc_vignette;
        }

        public function setDatePrcVignette($date_prc_vignette)
        {
            $this->date_prc_vignette = $date_prc_vignette;

            return $this;
        }

        public function getDatePrcVisiteTechnique()
        {
            return $this->date_prc_visite_technique;
        }

        public function setDatePrcVisiteTechnique($date_prc_visite_technique)
        {
            $this->date_prc_visite_technique = $date_prc_visite_technique;

            return $this;
        }

        // ============================== Extra functions =========================

    /**
     * Upload photo
     * @param Boolean add
     * @return Boolean
     */
    public function uploadFile($path, $oldFile = null)
    {
        $file = $this->getPhoto();
        if ($file instanceof UploadedFile) {
            $fileName = md5(uniqid()) . '.' . $file->guessExtension();
            $file->move($path, $fileName);
            $this->setPhoto($fileName);
            if ($oldFile !== null) {
                $oldFilePath = $path . '/' . $oldFile;
                if (file_exists($oldFilePath)) {
                    unlink($oldFilePath);
                }
            }
        } else {
            $this->setPhoto($oldFile);
        }
    }

    public function addAssurance(Assurance $assurance): self
    {
        if (!$this->assurances->contains($assurance)) {
            $this->assurances[] = $assurance;
            $assurance->setVehicule($this);
        }

        return $this;
    }

    public function removeAssurance(Assurance $assurance): self
    {
        if ($this->assurances->contains($assurance)) {
            $this->assurances->removeElement($assurance);
            // set the owning side to null (unless already changed)
            if ($assurance->getVehicule() === $this) {
                $assurance->setVehicule(null);
            }
        }

        return $this;
    }

    public function addVisiteTechnique(VisiteTechnique $visiteTechnique): self
    {
        if (!$this->visite_techniques->contains($visiteTechnique)) {
            $this->visite_techniques[] = $visiteTechnique;
            $visiteTechnique->setVehicule($this);
        }

        return $this;
    }

    public function removeVisiteTechnique(VisiteTechnique $visiteTechnique): self
    {
        if ($this->visite_techniques->contains($visiteTechnique)) {
            $this->visite_techniques->removeElement($visiteTechnique);
            // set the owning side to null (unless already changed)
            if ($visiteTechnique->getVehicule() === $this) {
                $visiteTechnique->setVehicule(null);
            }
        }

        return $this;
    }

    public function addVignette(Vignette $vignette): self
    {
        if (!$this->vignettes->contains($vignette)) {
            $this->vignettes[] = $vignette;
            $vignette->setVehicule($this);
        }

        return $this;
    }

    public function removeVignette(Vignette $vignette): self
    {
        if ($this->vignettes->contains($vignette)) {
            $this->vignettes->removeElement($vignette);
            // set the owning side to null (unless already changed)
            if ($vignette->getVehicule() === $this) {
                $vignette->setVehicule(null);
            }
        }

        return $this;
    }

    public function addCarteGrise(CarteGrise $carteGrise): self
    {
        if (!$this->carte_grises->contains($carteGrise)) {
            $this->carte_grises[] = $carteGrise;
            $carteGrise->setVehicule($this);
        }

        return $this;
    }

    public function removeCarteGrise(CarteGrise $carteGrise): self
    {
        if ($this->carte_grises->contains($carteGrise)) {
            $this->carte_grises->removeElement($carteGrise);
            // set the owning side to null (unless already changed)
            if ($carteGrise->getVehicule() === $this) {
                $carteGrise->setVehicule(null);
            }
        }

        return $this;
    }
































}
