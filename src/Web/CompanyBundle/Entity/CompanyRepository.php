<?php

namespace Web\CompanyBundle\Entity;
use Doctrine\ORM\EntityRepository;

class CompanyRepository extends EntityRepository {
      
    public function findEmpresaPaginar($inicio, $cantidad, $all = false)
    {
        $em =$this->getEntityManager();
        $dql = '
            SELECT c
            FROM WebCompanyBundle:Company c 
            WHERE c.destacada = true
            ORDER BY c.name ASC';
        if($all)
            $dql = 'SELECT c
                    FROM WebCompanyBundle:Company c 
                    ORDER BY c.name ASC';
        $consulta = $em->createQuery($dql);
        
        $consulta->setMaxResults($cantidad);
        $consulta->setFirstResult($inicio);
        
        return $consulta->getResult();
    }
	
	   
    public function findCantidadEmpresas($all = false)
    {
        $em = $this->getEntityManager();
        $dql = 'SELECT c 
                FROM WebCompanyBundle:Company c
                WHERE c.destacada = true';
        if($all)
            $dql = 'SELECT c 
                    FROM WebCompanyBundle:Company c';
        $consulta = $em->createQuery($dql);
        
        return $consulta->getResult();
    }
    
    public function findEmpresaCategoria($id)
    {
        $em = $this->getEntityManager();
        $dql = 'SELECT cc
                FROM WebCompanyBundle:CompanyCategory cc
                JOIN cc.company c
                WHERE cc.typeofproduct = :id
                ORDER BY c.name ASC 
               ';
        $consulta = $em->createQuery($dql);
        $consulta->setParameter('id', $id);
        return $consulta->getResult();
    }
	
	public function allCountryOrdenados()
   {
      return $this->getEntityManager()
	->createQuery('SELECT p FROM WebCompanyBundle:Country p ORDER BY p.name ASC')
	->getResult();
  
   }

   public function findDestacadafive()
   {
        $em = $this->getEntityManager();

        $dql = 'SELECT c FROM WebCompanyBundle:Company c
                WHERE c.destacada = true';
        $consulta = $em->createQuery($dql);
        $consulta->setMaxResults(5);
        return $consulta->getResult();


   }	
   
}
