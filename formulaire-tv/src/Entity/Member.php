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
	 */
	protected $email;
	
	/**
	 * @var string
	 *
	 * @Assert\NotBlank()
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
	 */
	protected $bio;
	
	/**
	 * @var string
	 *
	 */
	protected $url;
	
	/**
	 * @var string
	 *
	 */
	protected $facebook;
	
	/**
	 * @var string
	 *
	 */
	protected $twitter;
	
	/**
	 * @var string
	 *
	 */
	protected $instagram;
	
	/**
	 * @var string
	 *
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