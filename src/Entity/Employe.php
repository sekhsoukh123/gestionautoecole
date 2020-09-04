<?php

namespace App\Entity;

use App\Repository\EmployeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * @ORM\Entity(repositoryClass=EmployeRepository::class)
 */
 /**
 * Employe
 *
 * @ORM\Table(name="employe")
 * @ORM\Entity(repositoryClass=EmployeRepository::class)
 * @ORM\HasLifecycleCallbacks()
 */
class Employe
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(name="id" , type="integer")
     */
    private $id;

    /**
     * @var int
     * @Assert\NotBlank(message="field.not_blank")
     * @ORM\Column(name="gender", type="smallint")
     */
    private $gender;

    /**
    * @var string
    *
    * @Assert\NotBlank(message="field.not_blank")
    * @Assert\Length(
    *      min = 2,
    *      minMessage = "condidat.first_name.min",
    *      max = 25,
    *      maxMessage = "condidat.first_name.max",
    * )
    * @ORM\Column(name="first_name", type="string", length=25)
    */
   private $first_name;

   /**
    * @var string
    *
    * @Assert\Length(
    *      min = 2,
    *      minMessage = "condidat.last_name.min",
    *      max = 25,
    *      maxMessage = "Le nom ne doit pas dépasser 25 caractères.",
    * )
    * @ORM\Column(name="last_name", type="string", length=25, nullable=true)
    */
   private $last_name;

   /**
    * @var string
    *
    * @ORM\Column(name="email", type="string", length=255, nullable=true)
    */
   private $email;

   /**
    * @var \DateTime
    * @ORM\Column(name="date_naissance", type="date", nullable=true)
    */
   private $date_naissance;

   /**
    * @var string
    * @ORM\Column(name="lieu_naissance", type="string", nullable=true)
    */
   private $lieu_naissance;

   /**
    * @var string
    * @ORM\Column(name="pays_naissance", type="string", nullable=true)
    */
   private $pays_naissance = null;

   /**
    * @var string
    *
    * @Assert\NotBlank(message="field.not_blank")
    * @Assert\Regex(
    *     pattern ="/^(\+)?[0-9]{5,15}$/",
    *     message ="condidat.telephone1.regex"
    * )
    * @ORM\Column(name="telephone1", type="string", length=15)
    */
   private $telephone1;

   /**
    * @var string
    *
    * @Assert\Regex(
    *     pattern ="/^(\+)?[0-9]{5,15}$/",
    *     message ="condidat.telephone2.regex"
    * )
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
    * @ORM\Column(name="type", type="string", nullable=true)
    */
   private $type;


   /**
   * @Assert\Valid
   * @ORM\OneToOne(targetEntity="User", fetch="EAGER", cascade={"persist"},orphanRemoval=true)
   * @ORM\JoinColumn(name="user_id", referencedColumnName="id", nullable=true)
   */
  protected $user ;

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

    ////////////////////////////////getters & Setters ////////////////////////

    public function getId(): ?int
    {
        return $this->id;
    }



    public function getGender()
    {
        return $this->gender;
    }

    public function setGender(int $gender)
    {
        $this->gender = $gender;

        return $this;
    }

    public function getFirstName()
    {
        return $this->first_name;
    }

    public function setFirstName(string $first_name)
    {
        $this->first_name = $first_name;

        return $this;
    }

    public function getLastName()
    {
        return $this->last_name;
    }

    public function setLastName($last_name)
    {
        $this->last_name = $last_name;

        return $this;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    public function getDateNaissance()
    {
        return $this->date_naissance;
    }

    public function setDateNaissance($date_naissance)
    {
        $this->date_naissance = $date_naissance;

        return $this;
    }

    public function getLieuNaissance()
    {
        return $this->lieu_naissance;
    }

    public function setLieuNaissance($lieu_naissance)
    {
        $this->lieu_naissance = $lieu_naissance;

        return $this;
    }

    public function getPaysNaissance()
    {
        return $this->pays_naissance;
    }

    public function setPaysNaissance($pays_naissance)
    {
        $this->pays_naissance = $pays_naissance;

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

    public function getTelephone2()
    {
        return $this->telephone2;
    }

    public function setTelephone2($telephone2)
    {
        $this->telephone2 = $telephone2;

        return $this;
    }

    public function getAddress()
    {
        return $this->address;
    }

    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Set user
     *
     * @param \App\Entity\User $user
     *
     * @return Employe
     */
    public function setUser(\App\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \App\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    public function getCarteIdentite()
    {
        return $this->carte_identite;
    }

    public function setCarteIdentite($carte_identite)
    {
        $this->carte_identite = $carte_identite;

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

    public function setCreated( $created)
    {
        $this->created = $created;

        return $this;
    }

    public function getUpdated()
    {
        return $this->updated;
    }

    public function setUpdated( $updated)
    {
        $this->updated = $updated;

        return $this;
    }

      /**
       * Set photo
       *
       * @param string $photo
       *
       * @return Employe
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

      public function getType()
      {
          return $this->type;
      }

      public function setType($type)
      {
          $this->type = $type;

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


    public function __toString()
  {
      return "title";
  }



}
