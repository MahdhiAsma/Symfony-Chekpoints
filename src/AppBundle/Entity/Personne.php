<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * Personne
 *
 * @ORM\Table(name="personne")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PersonneRepository")
 */
class Personne
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *@Assert\NotBlank(message="Veuillez introduire votre nom")
     * @ORM\Column(name="Nom", type="string", length=255)
     */
    private $nom;

    /**
     * @var string
     * @Assert\NotBlank(message="Veuillez introduire votre prenom")
     * @ORM\Column(name="Prenom", type="string", length=255)
     */
    private $prenom;

    /**
     * @var int
     *@Assert\NotBlank(message="Veuillez introduire votre age")
     * @ORM\Column(name="Age", type="integer")
     */
    private $age;

    private $image;

    /**
    *@Assert\Image(
     *     minWidth = 200,
     *     maxWidth = 400,
     *     minHeight = 200,
     *     maxHeight = 400
     * )
     * @return mixed
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param mixed $image
     */
    public function setImage($image)
    {
        $this->image = $image;
    }

    /**
     * Get id
     *
     * @return int
     */

    /**
    /**
     *@Assert\Choice(
     *     choices = { "Unemployed", "Doctor","Nurse","Professeur" },
     *     message = "Choose a valid genre.")
     *@ORM\ManyToMany(targetEntity="AppBundle\Entity\Emploi")
     */
    private $emploi;
    /**
     *@ORM\ManyToOne(targetEntity="AppBundle\Entity\Adresse")
     */
    private $addresse;

    /**
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Media")
     *
     */
    private $media;
    /**
     * Personne constructor.
     * @param int $id
     * @param string $nom
     * @param string $prenom
     * @param int $age
     * @param $emploi
     * @param $addresse
     */
    public function __construct( $nom=null, $prenom=null, $age=0,$emploi=null,$adresse=null,$media=null)
    {

        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->age = $age;
        $this->emploi = $emploi;
        $this->adresse = $adresse;
        $this->Media = $media;
    }

    /**
     * @return mixed
     */
    public function getAddresse()
    {
        return $this->addresse;
    }

    /**
     * @param mixed $addresse
     */
    public function setAddresse($addresse)
    {
        $this->addresse = $addresse;
    }

    /**
     * @return mixed
     */
    public function getEmploi()
    {
        return $this->emploi;
    }

    /**
     *
     * @param mixed $emploi
     */
    public function setEmploi($emploi)
    {
        $this->emploi = $emploi;
    }

    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return Personne
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set prenom
     *
     * @param string $prenom
     *
     * @return Personne
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get prenom
     *
     * @return string
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set age
     *
     * @param integer $age
     *
     * @return Personne
     */
    public function setAge($age)
    {
        $this->age = $age;

        return $this;
    }

    /**
     * Get age
     *
     * @return int
     */
    public function getAge()
    {
        return $this->age;
    }

    /**
     * Add emploi
     *
     * @param \AppBundle\Entity\Emploi $emploi
     *
     * @return Personne
     */
    public function addEmploi(\AppBundle\Entity\Emploi $emploi)
    {
        $this->emploi[] = $emploi;

        return $this;
    }

    /**
     * Remove emploi
     *
     * @param \AppBundle\Entity\Emploi $emploi
     */
    public function removeEmploi(\AppBundle\Entity\Emploi $emploi)
    {
        $this->emploi->removeElement($emploi);
    }

    /**
     * Set media
     *
     * @param \AppBundle\Entity\Media $media
     *
     * @return Personne
     */
    public function setMedia(\AppBundle\Entity\Media $media = null)
    {
        $this->media = $media;

        return $this;
    }

    /**
     * Get media
     *
     * @return \AppBundle\Entity\Media
     */
    public function getMedia()
    {
        return $this->media;
    }
}
