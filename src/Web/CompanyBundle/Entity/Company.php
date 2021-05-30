<?php

namespace Web\CompanyBundle\Entity;

use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints as DoctrineAssert;

/**
 * Web\CompanyBundle\Entity\Company
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Web\CompanyBundle\Entity\CompanyRepository")
 * @DoctrineAssert\UniqueEntity("name")
 */
class Company
{
        /**
        * @ORM\Id
        * @ORM\Column(type="integer")
        * @ORM\GeneratedValue
        */
      protected $id;
	  
	  /** @ORM\Column(type="text") */
           protected $description;
	  /** @ORM\Column(type="text")
	  
	  */
	  protected $web_site;
	  /** @ORM\Column(type="string", length=100) 
	  *   @Assert\Email()
	  */
	  protected $email;	
	   /**
     * @var date $created
     *
     * @ORM\Column(name="created", type="date")
     */
           protected $created;
           
           
           
	  /** @ORM\Column(type="boolean")
	  *   
	  */
	  protected $accept;
          
           /** @ORM\Column(type="boolean")
             *  
	     *   
	     */
	   protected $destacada;
	   /** @ORM\Column(type="text") 
	   *
           * 
	   */
	  protected $address;
	  /** @ORM\Column(type="string", length=255) */
          protected $name;
	 
	  /** @ORM\ManyToOne(targetEntity="Web\CompanyBundle\Entity\Country") */
	  protected $country;
	  		  
      
        /**
        * @ORM\ManyToMany(targetEntity="Web\CompanyBundle\Entity\TypeofProduct")
        * @ORM\JoinTable(name="company_category",
        * joinColumns={@ORM\JoinColumn(name="company_id", referencedColumnName="id")},
        * inverseJoinColumns={@ORM\JoinColumn(name="typeofproduct_id", referencedColumnName="id")}
        * )
        */
	 private $typeofproducts;
           
        /** @ORM\ManyToOne(targetEntity="Application\Sonata\UserBundle\Entity\User") */
	 protected $user;
         
        /**
        * @ORM\OneToMany(targetEntity="CompanyCategory", mappedBy="company")
        */   
        protected $companycategorys;

        protected $empresa_update;

       
    public function __construct() {

    $this->typeofproducts = new \Doctrine\Common\Collections\ArrayCollection();
 
    }
    

    /**
     * Get id
     *
     *
     * @return integer 
	 */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set description
     *
     * @param text $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * Get description
     *
     * @return text 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set web_site
     *
     * @param string $webSite
     */
    public function setWebSite($webSite)
    {
        $this->web_site = $webSite;
    }

    /**
     * Get web_site
     *
     * @return string 
     */
    public function getWebSite()
    {
        return $this->web_site;
    }

    /**
     * Set email
     *
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
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
     * Set status
     *
     * @param string $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * Get status
     *
     * @return string 
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set address
     *
     * @param text $address
     */
    public function setAddress($address)
    {
        $this->address = $address;
    }

    /**
     * Get address
     *
     * @return text 
     */
    public function getAddress()
    {
        return $this->address;
    }

    
    /**
     * Set country
     *
     * @param Web\CompanyBundle\Entity\Country $country
     */
    public function setCountry(\Web\CompanyBundle\Entity\Country $country)
    {
        $this->country = $country;
    }

    /**
     * Get country
     *
     * @return Web\CompanyBundle\Entity\Country 
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set accept
     *
     * @param boolean $accept
     */
    public function setAccept($accept)
    {
        $this->accept = $accept;
    }

    /**
     * Get accept
     *
     * @return boolean 
     */
    public function getAccept()
    {
        return $this->accept;
    }

    /**
     * Set name
     *
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
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
	
	public function __toString()
	{
	  return $this->getName();
	}

    /**
     * Set created
     *
     * @param date $created
     */
    public function setCreated($created)
    {
        $this->created = $created;
    }

    /**
     * Get created
     *
     * @return date 
     */
    public function getCreated()
    {
        return $this->created;
    }

   

    /**
     * Add typeofproduct
     *
     * @param Web\CompanyBundle\Entity\TypeofProduct $typeofproduct
     */
    public function addTypeofProduct(\Web\CompanyBundle\Entity\TypeofProduct $typeofproduct)
    {
        $this->typeofproduct[] = $typeofproduct;
    }

    /**
     * Get typeofproduct
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getTypeofproduct()
    {
        return $this->typeofproduct;
    }

    /**
     * Get typeofproducts
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getTypeofproducts()
    {
        return $this->typeofproducts;
    }




    /**
     * Set user
     *
     * @param Application\Sonata\UserBundle\Entity\User $user
     */
    public function setUser(\Application\Sonata\UserBundle\Entity\User $user)
    {
        $this->user = $user;
    }

    /**
     * Get user
     *
     * @return Application\Sonata\UserBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set destacada
     *
     * @param boolean $destacada
     */
    public function setDestacada($destacada)
    {
        $this->destacada = $destacada;
    }

    /**
     * Get destacada
     *
     * @return boolean 
     */
    public function getDestacada()
    {
        return $this->destacada;
    }

    public function getdatacompany($accept)
    {
        $this->empresa_update = $accept;

    }

      public function getEmpresaUpdate()
    {
        return $this->empresa_update;
    }
    

}