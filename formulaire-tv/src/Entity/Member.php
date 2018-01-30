<?php
namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity
 * @Vich\Uploadable
 * @UniqueEntity("email")
 */
class Member
{
	/**
	 * @var integer
	 *
	 * @ORM\Column(name="id", type="integer", options={"unsigned"=true})
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="IDENTITY")
	 */
	protected $id;
	
	/**
	 * @var string
	 *
	 * @Assert\NotBlank()
	 * @Assert\Email(
	 *     message = "L'email '{{ value }}' n'est pas une adresse email valide.",
	 * )
	 * @ORM\Column(name="email", type="string", length=255, nullable=false, unique=true)
	 */
	protected $email;
	
	/**
	 * @var string
	 *
	 * @Assert\NotBlank()
	 * @Assert\Type("string")
	 * @ORM\Column(name="name", type="string", length=200, nullable=false)
	 */
	protected $name;
	
	/**
	 * @var File
	 * NOTE: This is not a mapped field of entity metadata, just a simple property.
	 *
	 * @Assert\NotBlank()
	 * @Vich\UploadableField(mapping="logo", fileNameProperty="imageName", size="imageSize")
	 */
	protected $imageFile;
	
	/**
	 * @var string
	 *
	 * @ORM\Column(type="string", length=255, nullable=false)
	 */
	protected $imageName;
	
	/**
	 * @var integer
	 *
	 * @ORM\Column(type="integer")
	 */
	protected $imageSize;
	
	/**
	 * @var \DateTime
	 *
	 * @ORM\Column(type="datetime")
	 */
	protected $updatedAt;
	
	/**
	 * @var string
	 *
	 * @Assert\NotBlank()
	 * @Assert\Type("string")
	 * @ORM\Column(type="text")
	 */
	protected $bio;
	
	/**
	 * @var string
	 *
	 * @Assert\Url(
	 *    protocols = {"http", "https"}
	 * )
	 * @ORM\Column(type="string", nullable=true)
	 */
	protected $url;
	
	/**
	 * @var string
	 *
	 * @Assert\Url(
	 *    message = "L'url '{{ value }}' n'est pas une URL valide",
	 *    protocols = {"http", "https"}
	 * )
	 * @Assert\Regex("/facebook/")
	 * @ORM\Column(type="string", nullable=true)
	 */
	protected $facebook;
	
	/**
	 * @var string
	 *
	 * @Assert\Type("string")
	 * @Assert\Regex("/@/")
	 * @ORM\Column(type="string", nullable=true)
	 */
	protected $twitter;
	
	/**
	 * @var string
	 *
	 * @Assert\Type("string")
	 * @ORM\Column(type="string", nullable=true)
	 */
	protected $instagram;
	
	/**
	 * @var string
	 *
	 * @Assert\Url(
	 *    message = "L'url '{{ value }}' n'est pas une URL valide",
	 *    protocols = {"http", "https"}
	 * )
	 * @Assert\Regex("/linkedin\.com/")
	 * @ORM\Column(type="string", nullable=true)
	 */
	protected $linkedin;
	
	/**
	 * @var bool
	 *
	 * @ORM\Column(type="boolean", nullable=false, options={"default"=true})
	 */
	protected $valid = true;
	
	/**
	 * Get id
	 *
	 * @return int
	 */
	public function getId()
	{
		return $this->id;
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
	
	/**
	 * Set email
	 *
	 * @param $email
	 * @return Member
	 */
	public function setEmail($email)
	{
		$this->email = $email;
		
		return $this;
	}
	
	/**
	 * Get name
	 *
	 * @return string
	 */
	public function getName()
	{
		return $this->name;
	}
	
	/**
	 * Set name
	 *
	 * @param $name
	 * @return Member
	 */
	public function setName($name)
	{
		$this->name = $name;
		
		return $this;
	}
	
	/**
	 * If manually uploading a file (i.e. not using Symfony Form) ensure an instance
	 * of 'UploadedFile' is injected into this setter to trigger the  update. If this
	 * bundle's configuration parameter 'inject_on_load' is set to 'true' this setter
	 * must be able to accept an instance of 'File' as the bundle will inject one here
	 * during Doctrine hydration.
	 *
	 * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile $image
	 */
	public function setImageFile($image = null)
	{
		$this->imageFile = $image;
		
		if (null !== $image) {
			// It is required that at least one field changes if you are using doctrine
			// otherwise the event listeners won't be called and the file is lost
			$this->updatedAt = new \DateTimeImmutable();
		}
	}
	
	/**
	 * Get imageFile
	 *
	 * @return string
	 */
	public function getImageFile()
	{
		return $this->imageFile;
	}
	
	/**
	 * Set imageName
	 *
	 * @param $imageName
	 * @return Member
	 */
	public function setImageName($imageName)
	{
		$this->imageName = $imageName;
		
		return $this;
	}
	
	/**
	 * Get imageName
	 *
	 * @return string
	 */
	public function getImageName()
	{
		return $this->imageName;
	}
	
	/**
	 * Set imageSize
	 *
	 * @param $imageSize
	 * @return Member
	 */
	public function setImageSize($imageSize)
	{
		$this->imageSize = $imageSize;
		
		return $this;
	}
	
	/**
	 * Get imageSize
	 *
	 * @return int
	 */
	public function getImageSize()
	{
		return $this->imageSize;
	}
	
	/**
	 * Get bio
	 *
	 * @return string
	 */
	public function getBio()
	{
		return $this->bio;
	}
	
	/**
	 * Set bio
	 *
	 * @param $bio
	 * @return Member
	 */
	public function setBio($bio)
	{
		$this->bio = $bio;
		
		return $this;
	}
	
	/**
	 * Get url
	 *
	 * @return string
	 */
	public function getUrl()
	{
		return $this->url;
	}
	
	/**
	 * Set url
	 *
	 * @param $url
	 * @return Member
	 */
	public function setUrl($url)
	{
		$this->url = $url;
		
		return $this;
	}
	
	/**
	 * Get facebook
	 *
	 * @return string
	 */
	public function getFacebook()
	{
		return $this->facebook;
	}
	
	/**
	 * Set facebook
	 *
	 * @param $facebook
	 * @return Member
	 */
	public function setFacebook($facebook)
	{
		$this->facebook = $facebook;
		
		return $this;
	}
	
	/**
	 * Get twitter
	 *
	 * @return string
	 */
	public function getTwitter()
	{
		return $this->twitter;
	}
	
	/**
	 * Set twitter
	 *
	 * @param $twitter
	 * @return Member
	 */
	public function setTwitter($twitter)
	{
		$this->twitter = $twitter;
		
		return $this;
	}
	
	/**
	 * Get instagram
	 *
	 * @return string
	 */
	public function getInstagram()
	{
		return $this->instagram;
	}
	
	/**
	 * Set instagram
	 *
	 * @param $instagram
	 * @return Member
	 */
	public function setInstagram($instagram)
	{
		$this->instagram = $instagram;
		
		return $this;
	}
	
	/**
	 * Get linkedin
	 *
	 * @return string
	 */
	public function getLinkedin()
	{
		return $this->linkedin;
	}
	
	/**
	 * Set linkedin
	 *
	 * @param $linkedin
	 * @return Member
	 */
	public function setLinkedin($linkedin)
	{
		$this->linkedin = $linkedin;
		
		return $this;
	}
	
	/**
	 * Get if member is valid
	 *
	 * @return boolean
	 */
	public function getValid()
	{
		return $this->valid;
	}
	
	/**
	 * Set a member valid
	 *
	 * @param $valid
	 * @return Member
	 */
	public function setValid($valid)
	{
		$this->valid = $valid;
		
		return $this;
	}
}