<?php
namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;

class Member
{
	/**
	 * @var integer
	 */
	protected $id;
	
	/**
	 * @var string
	 *
	 * @Assert\NotBlank()
	 * @Assert\Email(
	 *     message = "L'email '{{ value }}' n'est pas une adresse email valide.",
	 *     checkMX = true
	 * )
	 */
	protected $email;
	
	/**
	 * @var string
	 *
	 * @Assert\NotBlank()
	 * @Assert\Type("string")
	 */
	protected $name;
	
	/**
	 * @var string
	 *
	 */
	protected $logo;
	
	/**
	 * @var string
	 *
	 * @Assert\NotBlank()
	 * @Assert\Type("string")
	 */
	protected $bio;
	
	/**
	 * @var string
	 *
	 * @Assert\Url(
	 *    protocols = {"http", "https"}
	 * )
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
	 */
	protected $facebook;
	
	/**
	 * @var string
	 *
	 * @Assert\Type("string")
	 * @Assert\Regex("/@/")
	 */
	protected $twitter;
	
	/**
	 * @var string
	 *
	 * @Assert\Type("string")
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
	 */
	protected $linkedin;
	
	public function getEmail()
	{
		return $this->email;
	}
	
	public function setEmail($email)
	{
		$this->email = $email;
	}
	
	public function getName()
	{
		return $this->name;
	}
	
	public function setName($name)
	{
		$this->name = $name;
	}
	
	public function getLogo()
	{
		return $this->logo;
	}
	
	public function setLogo($logo)
	{
		$this->logo = $logo;
	}
	
	public function getBio()
	{
		return $this->bio;
	}
	
	public function setBio($bio)
	{
		$this->bio = $bio;
	}
	
	public function getUrl()
	{
		return $this->url;
	}
	
	public function setUrl($url)
	{
		$this->url = $url;
	}
	
	public function getFacebook()
	{
		return $this->facebook;
	}
	
	public function setFacebook($facebook)
	{
		$this->facebook = $facebook;
	}
	
	public function getTwitter()
	{
		return $this->twitter;
	}
	
	public function setTwitter($twitter)
	{
		$this->twitter = $twitter;
	}
	
	public function getInstagram()
	{
		return $this->instagram;
	}
	
	public function setInstagram($instagram)
	{
		$this->instagram = $instagram;
	}
	
	public function getLinkedin()
	{
		return $this->linkedin;
	}
	
	public function setLinkedin($linkedin)
	{
		$this->linkedin = $linkedin;
	}
}