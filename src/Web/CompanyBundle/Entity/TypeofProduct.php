<?php

namespace Web\CompanyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Web\CompanyBundle\Entity\TypeofProduct
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class TypeofProduct
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
	

    /**
     * @var string $name
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

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
	
	public function __toString()
	{
	  return $this->getName();
	}
   

    /**
     * Add companys
     *
     * @param Web\CompanyBundle\Entity\Company $companys
     */
    public function addCompany(\Web\CompanyBundle\Entity\Company $companys)
    {
        $this->companys[] = $companys;
    }

    /**
     * Get companys
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getCompanys()
    {
        return $this->companys;
    }
}