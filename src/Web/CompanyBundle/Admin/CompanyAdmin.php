<?php

namespace Web\CompanyBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
class CompanyAdmin extends Admin
{
    
	
	
	
     protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->with('Company')
                ->add('name', null)
				->add('country', null)
				->add('typeofproducts', 'sonata_type_model')
				->add('address', null,array('required' => false))
                                ->add('description', null)
                                ->add('web_site', null)
                                ->add('email', null,array('required' => false)) 
				->add('created', null)
                                ->add('destacada', null,array('required' => false))
				->add('accept', null,array('required' => false))
                                ->end();
    }
	
	
	 public function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('name')
                ->add('description')
                ->add('web_site')
                ->add('email');
    }
	
	public function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('name');
    }
	
	public function preUpdate($Company) 
    {
       $Company->getdatacompany($Company->getAccept());
    }

     public function prePersist($Company) 
     {
        if($Company->getEmpresaUpdate()==false && $Company->getAccept())
        {
            die("OK");
            

        }

     }
	
	
    
    
    
}

?>
