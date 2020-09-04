<?php

namespace App\Entity;

use App\Repository\CandidatRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * @ORM\Entity(repositoryClass=CandidatRepository::class)
 * @ORM\HasLifecycleCallbacks()
 */
class Candidat
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @var int
      * @Assert\NotBlank(message="field.not_blank")
     * @ORM\Column(name="gender", type="smallint")
     */
    private $gender;

    /**
    * @var string
    * @Assert\NotBlank(message="field.not_blank")
    * @ORM\Column(name="first_name", type="string", length=25)
    */
   private $first_name;

   /**
    * @var string
     * @Assert\NotBlank(message="field.not_blank")
    * @ORM\Column(name="last_name", type="string", length=25, nullable=true)
    */
   private $last_name;

   /**
   * @var string
    * @Assert\NotBlank(message="field.not_blank")
   * @ORM\Column(name="first_name_ar", type="string", length=25, nullable=true)
   */
  private $first_name_ar;

  /**
   * @var string
    * @Assert\NotBlank(message="field.not_blank")
   * @ORM\Column(name="last_name_ar", type="string", length=25, nullable=true)
   */
  private $last_name_ar;

  /**
   * @var string
    * @Assert\NotBlank(message="field.not_blank")
   * @ORM\Column(name="lieu_naissance_ar", type="string", nullable=true)
   */
  private $lieu_naissance_ar;



  /**
   * @var string
    * @Assert\NotBlank(message="field.not_blank")
   * @ORM\Column(name="address_ar", type="string", nullable=true)
   */
  private $address_ar;



  /**
    * @var string
    * @Assert\Regex("/^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$/",message="field.not_blank")
    * @ORM\Column(name="email", type="string", length=120)
    */
   private $email;

   /**
    * @var \DateTime
     * @Assert\NotBlank(message="field.not_blank")
    * @ORM\Column(name="date_naissance", type="date", nullable=true)
    */
   private $date_naissance;

   /**
    * @var string
     * @Assert\NotBlank(message="field.not_blank")
    * @ORM\Column(name="lieu_naissance", type="string", nullable=true)
    */
   private $lieu_naissance;

   /**
    * @var string
     * @Assert\NotBlank(message="field.not_blank")
    * @ORM\Column(name="pays_naissance", type="string", nullable=true)
    */
   private $pays_naissance = null;

   /**
    * @var string
     * @Assert\NotBlank(message="field.not_blank")
    * @ORM\Column(name="telephone1", type="string", length=15, nullable=true)
    */
   private $telephone1;

   /**
    * @var string
    *
    * @ORM\Column(name="telephone2", type="string", length=15, nullable=true)
    */
   private $telephone2;

   /**
    * @var string
    * @ORM\Column(name="address", type="string", nullable=true)
    */
   private $address;

   /**
    * @var string
    * @ORM\Column(name="carte_identite", type="string", nullable=true)
    */
   private $carte_identite;
   /**
    * @var string
    * @ORM\Column(name="type_permis", type="string", nullable=true)
    */
   private $type_permis;

   /**
    * @var string
    * @ORM\Column(name="job", type="string", nullable=true)
    */
   private $job;

   /**
    * @var decimal
    * @ORM\Column(name="prix", type="decimal",  precision=10, scale=2, nullable=true)
    */
   private $prix;

   /**
    * @var int
    * @ORM\Column(name="note", type="integer", nullable=true)
    */
   private $note;


   /**
    * @var string
    * @ORM\Column(name="numero_inscription", type="string", nullable=true)
    */
   private $numero_inscription;

   /**
    * @var \DateTime
    * @ORM\Column(name="date_inscription", type="date", nullable=true)
    */
   private $date_inscription;


   /**
    * @var \DateTime
    * @ORM\Column(name="date_debut_theorique", type="date", nullable=true)
    */
   private $date_debut_theorique;

   /**
    * @var \DateTime
    * @ORM\Column(name="date_debut_pratique", type="date", nullable=true)
    */
   private $date_debut_pratique;

   /**
    * @var \DateTime
    * @ORM\Column(name="date_examen_theorique", type="date", nullable=true)
    */
   private $date_examen_theorique;

   /**
    * @var \DateTime
    * @ORM\Column(name="date_examen_pratique", type="date", nullable=true)
    */
   private $date_examen_pratique;

   /**
    * @var \DateTime
    * @ORM\Column(name="date2_examen_theorique", type="date", nullable=true)
    */
   private $date2_examen_theorique;

   /**
    * @var \DateTime
    * @ORM\Column(name="date2_examen_pratique", type="date", nullable=true)
    */
   private $date2_examen_pratique;


   /**
    * @var string
    * @ORM\Column(name="numero_immatriculation", type="string", nullable=true)
    */
   private $numero_immatriculation;

     /**
     * @var int
     * @ORM\OneToMany(targetEntity="App\Entity\Cpayment",  mappedBy="candidat")
     */
    protected $cpayments;

    /**
    * @var int
    * @ORM\OneToMany(targetEntity="App\Entity\Ctheorique",  mappedBy="candidat")
    */
   protected $ctheoriques;

   /**
   * @var int
   * @ORM\OneToMany(targetEntity="App\Entity\Cpratique",  mappedBy="candidat")
   */
  protected $cpratiques;



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
    * @var bool
    *
    * @ORM\Column(name="is_dossier", type="boolean" , nullable=true)
    */
   private $is_dossier = false;

   /**
    * @var bool
    *
    * @ORM\Column(name="is_visite_medicale", type="boolean", nullable=true)
    */
   private $is_visite_medicale = false;

   /**
    * @var bool
    *
    * @ORM\Column(name="is_succeeded", type="boolean", nullable=true)
    */
   private $is_succeeded = false;






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


  public function __construct()
  {
      $this->cpayments = new ArrayCollection();
        $this->ctheoriques = new ArrayCollection();
          $this->cpratiques = new ArrayCollection();
}

	// ============================== Getters & Setters =======================


   /**
      * Set gender
      *
      * @param integer $gender
      *
      * @return Condidat
      */
     public function setGender($gender)
     {
         $this->gender = $gender;

         return $this;
     }

     /**
      * Get gender
      *
      * @return integer
      */
     public function getGender()
     {
         return $this->gender;
     }
     /**
      * Set last_name
      *
      * @param string $last_name
      *
      * @return Condidat
      */
     public function setLastName($last_name)
     {
         $this->last_name = $last_name;

         return $this;
     }

     /**
      * Get last_name
      *
      * @return string
      */
     public function getLastName()
     {
         return $this->last_name;
     }

     /**
      * Set first_name
      *
      * @param string $first_name
      *
      * @return Condidat
      */
     public function setFirstName($first_name)
     {
         $this->first_name = $first_name;

         return $this;
     }

     /**
      * Get first_name
      *
      * @return string
      */
     public function getFirstName()
     {
         return $this->first_name;
     }

     /**
      * Set email
      *
      * @param string $email
      *
      * @return Condidat
      */
     public function setEmail($email)
     {
         $this->email = $email;

         return $this;
     }

     /**
      * Get email
      *
      * @return string
      */
     public function getEmail()
     {
         return $this->email;
     }

     public function setDateNaissance($date_naissance)
   {
       $this->date_naissance = $date_naissance;
       return $this;
   }
   public function getDateNaissance()
   {
       return $this->date_naissance;
   }

   /**
    * Set telephone1
    *
    * @param string $telephone1
    *
    * @return Condidat
    */
   public function setTelephone1($telephone1)
   {
       $this->telephone1 = $telephone1;

       return $this;
   }

   /**
    * Get telephone1
    *
    * @return string
    */
   public function getTelephone1()
   {
       return $this->telephone1;
   }

   /**
    * Set telephone2
    *
    * @param string $telephone2
    *
    * @return Condidat
    */
   public function setTelephone2($telephone2)
   {
       $this->telephone2 = $telephone2;

       return $this;
   }

   /**
    * Get telephone2
    *
    * @return string
    */
   public function getTelephone2()
   {
       return $this->telephone2;
   }

   /**
    * Set photo
    *
    * @param string $photo
    *
    * @return Candidat
    */
   public function setPhoto($photo)
   {
       $this->photo = $photo;

       return $this;
   }

   /**
    * Get photo
    *
    * @return string
    */
   public function getPhoto()
   {
       return $this->photo;
   }

   public function setJob($job)
   {
       $this->job = $job;

       return $this;
   }

   public function getJob()
   {
       return $this->job;
   }

   public function setPrix($prix)
   {
       $this->prix = $prix;

       return $this;
   }

   public function getPrix()
   {
       return $this->prix;
   }

   public function setNote($note)
   {
       $this->note = $note;

       return $this;
   }

   public function getNote()
   {
       return $this->note;
}



     public function setLieuNaissance($lieu_naissance)
     {
         $this->lieu_naissance = $lieu_naissance;
         return $this;
     }
     public function getLieuNaissance()
     {
         return $this->lieu_naissance;
     }

     public function setPaysNaissance($pays_naissance)
     {
         $this->pays_naissance = $pays_naissance;
         return $this;
     }
     public function getPaysNaissance()
     {
         return $this->pays_naissance;
     }

     public function setCarteIdentite($carte_identite)
     {
         $this->carte_identite = $carte_identite;
         return $this;
     }
     public function getCarteIdentite()
     {
         return $this->carte_identite;
     }


     public function setAddress($address)
     {
         $this->address = $address;
         return $this;
     }
     public function getAddress()
     {
         return $this->address;
     }


       /**
     * Set created
     *
     * @param \DateTime $created
     *
     * @return Condidat
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
       * @return Condidat
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
       * @return Condidat
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
            return ($this->first_name . " " . $this->last_name . " - " . $this->email);
        }

      public function getTypePermis()
      {
          return $this->type_permis;
      }

      public function setTypePermis($type_permis)
      {
          $this->type_permis = $type_permis;

          return $this;
      }

      public function getNumeroInscription()
      {
          return $this->numero_inscription;
      }

      public function setNumeroInscription($numero_inscription)
      {
          $this->numero_inscription = $numero_inscription;

          return $this;
      }

      public function getDateInscription()
      {
          return $this->date_inscription;
      }

      public function setDateInscription($date_inscription)
      {
          $this->date_inscription = $date_inscription;

          return $this;
      }

      public function getDateDebutTheorique()
      {
          return $this->date_debut_theorique;
      }

      public function setDateDebutTheorique($date_debut_theorique)
      {
          $this->date_debut_theorique = $date_debut_theorique;

          return $this;
      }

      public function getDateDebutPratique()
      {
          return $this->date_debut_pratique;
      }

      public function setDateDebutPratique($date_debut_pratique)
      {
          $this->date_debut_pratique = $date_debut_pratique;

          return $this;
      }

      public function getDateExamenTheorique()
      {
          return $this->date_examen_theorique;
      }

      public function setDateExamenTheorique($date_examen_theorique)
      {
          $this->date_examen_theorique = $date_examen_theorique;

          return $this;
      }

      public function getDateExamenPratique()
      {
          return $this->date_examen_pratique;
      }

      public function setDateExamenPratique($date_examen_pratique)
      {
          $this->date_examen_pratique = $date_examen_pratique;

          return $this;
      }

      public function getDate2ExamenTheorique()
      {
          return $this->date2_examen_theorique;
      }

      public function setDate2ExamenTheorique($date2_examen_theorique)
      {
          $this->date2_examen_theorique = $date2_examen_theorique;

          return $this;
      }

      public function getDate2ExamenPratique()
      {
          return $this->date2_examen_pratique;
      }

      public function setDate2ExamenPratique($date2_examen_pratique)
      {
          $this->date2_examen_pratique = $date2_examen_pratique;

          return $this;
      }

      public function getNumeroImmatriculation()
      {
          return $this->numero_immatriculation;
      }

      public function setNumeroImmatriculation($numero_immatriculation)
      {
          $this->numero_immatriculation = $numero_immatriculation;

          return $this;
      }

      public function setCpayments($cpayments)
      {
       $this->cpayments = $cpayments;
       return $this;
      }

       public function getCpayments()
       {
           return $this->cpayments;
       }

       public function setCtheoriques($ctheoriques)
       {
        $this->ctheoriques = $ctheoriques;
        return $this;
       }

        public function getCtheoriques()
        {
            return $this->ctheoriques;
        }

        public function setCpratiques($cpratiques)
        {
         $this->cpratiques = $cpratiques;
         return $this;
        }

         public function getCpratiques()
         {
             return $this->cpratiques;
         }

       public function getIsDossier()
       {
           return $this->is_dossier;
       }

       public function setIsDossier($is_dossier)
       {
           $this->is_dossier = $is_dossier;

           return $this;
       }

       public function getIsVisiteMedicale()
       {
           return $this->is_visite_medicale;
       }

       public function setIsVisiteMedicale($is_visite_medicale)
       {
           $this->is_visite_medicale = $is_visite_medicale;

           return $this;
       }

       public function getIsSucceeded()
       {
           return $this->is_succeeded;
       }

       public function setIsSucceeded($is_succeeded)
       {
           $this->is_succeeded = $is_succeeded;

           return $this;
       }

       public function getFirstNameAr()
       {
           return $this->first_name_ar;
       }

       public function setFirstNameAr($first_name_ar)
       {
           $this->first_name_ar = $first_name_ar;

           return $this;
       }

       public function getLastNameAr()
       {
           return $this->last_name_ar;
       }

       public function setLastNameAr($last_name_ar)
       {
           $this->last_name_ar = $last_name_ar;

           return $this;
       }

       public function getLieuNaissanceAr()
       {
           return $this->lieu_naissance_ar;
       }

       public function setLieuNaissanceAr($lieu_naissance_ar)
       {
           $this->lieu_naissance_ar = $lieu_naissance_ar;

           return $this;
       }



       public function getAddressAr()
       {
           return $this->address_ar;
       }

       public function setAddressAr($address_ar)
       {
           $this->address_ar = $address_ar;

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

       public function addCpayment(Cpayment $cpayment): self
       {
           if (!$this->cpayments->contains($cpayment)) {
               $this->cpayments[] = $cpayment;
               $cpayment->setCandidat($this);
           }

           return $this;
       }

       public function removeCpayment(Cpayment $cpayment): self
       {
           if ($this->cpayments->contains($cpayment)) {
               $this->cpayments->removeElement($cpayment);
               // set the owning side to null (unless already changed)
               if ($cpayment->getCandidat() === $this) {
                   $cpayment->setCandidat(null);
               }
           }

           return $this;
       }



}
