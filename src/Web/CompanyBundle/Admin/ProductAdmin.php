<?php

namespace Web\CompanyBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;

class ProductAdmin extends Admin
{
   
  
    
    
   protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->with('Product')
                ->add('name', null)
				 ->add('description', null)
				  ->add('price', null)
				   ->add('typeofproduct', null)
				   ->add('image', 'file', array('required' => false))					
                ->end();
    }    
   
    
      
    public function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('name');
    }
    
   public function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('name');
    }
    
    
    
  
   
    
    
}

