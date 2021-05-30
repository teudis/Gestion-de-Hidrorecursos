<?php

namespace Web\CompanyBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;

class CountryAdmin extends Admin
{
   
   protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->with('Country')
                ->add('name', null, array('help'=>'Name of country'))
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

