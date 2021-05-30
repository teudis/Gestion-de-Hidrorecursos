<?php

namespace Web\CompanyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Web\CompanyBundle\Entity\ComapnyCategory
 *
 * @ORM\Table(name="company_category")
 * @ORM\Entity(repositoryClass="Web\CompanyBundle\Entity\ComapnyCategoryRepository")
 */
class CompanyCategory
{
    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="TypeofProduct")     
     */
    protected $typeofproduct;
    
    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="Company", inversedBy="companycategorys")
     * @ORM\JoinColumn(name="company_id", referencedColumnName="id")
     */
    protected $company;

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

    /**
     * Set company
     *
     * @param Web\CompanyBundle\Entity\Company $company
     */
    public function setCompany(\Web\CompanyBundle\Entity\Company $company)
    {
        $this->company = $company;
    }

    /**
     * Get company
     *
     * @return Web\CompanyBundle\Entity\Company 
     */
    public function getCompany()
    {
        return $this->company;
    }
}