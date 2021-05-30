<?php

namespace Web\CompanyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Web\CompanyBundle\Entity\Product
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Product
{
    
    
     /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
     protected $id;
     /**
     * @var string $name
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
     protected $name;
     /** @ORM\Column(type="text") */
     protected $description;
      /** @ORM\Column(type="string", length=255) */
     protected $image;
     /**  @ORM\Column(type="decimal", scale=2) */    
     protected $price;
     /**
     * @ORM\ManyToOne(targetEntity="Web\CompanyBundle\Entity\TypeofProduct")
     */
     protected $typeofproduct;
	 
    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
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
     * Set image
     *
     * @param string $image
     */
    public function setImage($image)
    {
        $this->image = $image;
    }

    /**
     * Get image
     *
     * @return string 
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set price
     *
     * @param decimal $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }

    /**
     * Get price
     *
     * @return decimal 
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set typeofproduct
     *
     * @param Web\CompanyBundle\Entity\TypeofProduct $typeofproduct
     */
    public function setTypeofproduct(\Web\CompanyBundle\Entity\TypeofProduct $typeofproduct)
    {
        $this->typeofproduct = $typeofproduct;
    }

    /**
     * Get typeofproduct
     *
     * @return Web\CompanyBundle\Entity\TypeofProduct 
     */
    public function getTypeofproduct()
    {
        return $this->typeofproduct;
    }
	
	
	public function __toString()
	{
	  return $this->getName();
	}
        
  
	}