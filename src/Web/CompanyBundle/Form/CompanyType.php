<?php

namespace Web\CompanyBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class CompanyType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('name', 'text',array('label' => 'Nombre de Empresa','required' => true))
	        ->add('country', 'entity', array(
                    'class' => 'WebCompanyBundle:Country',
                    'empty_value' => 'Select Country',
                    'query_builder' => function($er) {
                        return $er->createQueryBuilder('u')
                                ->select('u')
                                ->orderBy('u.name','ASC');
                    }))     
                         
            
             ->add('typeofproducts', 'entity', array(
                    'class' => 'WebCompanyBundle:TypeofProduct',
                    'multiple' => 'true',
                    'query_builder' => function($er) {
                        return $er->createQueryBuilder('u')
                                ->select('u')
                                ->orderBy('u.name','ASC');
                    }))                  
            ->add('description','textarea',array('label'=>'Descripcion'))
            ->add('web_site', 'textarea', array('label' => 'Sitio Web'))
            ->add('email', 'email')
            ->add('address',null,array('label'=>'Direccion')) 
            ->add('created','birthday',array('label'=>'Creada'))                
                     
            ;

    }

    public function getName()
    {
        return 'web_companybundle_companytype';
    }

}