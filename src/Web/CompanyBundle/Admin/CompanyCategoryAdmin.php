<?php

namespace Web\CompanyBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;

class CompanyCategoryAdmin extends Admin
{
   
       protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->with('Company && Category')
                ->add('company', null)
				->add('typeofproduct', null)
				
              
                ->end();
    }
	
	
	 public function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('company');
    }
   
    
    
}

