<?php

namespace Web\CompanyBundle\Entity;
use Doctrine\ORM\EntityRepository;

class CountryRepository extends EntityRepository {
      
    
	public function findCountryOrdenados()
   {
      return $this->getEntityManager()
	->createQuery('SELECT p FROM WebCompanyBundle:Country p ORDER BY p.name ASC')
	->getResult();
  
   }	
   
}
