<?php

namespace Web\CompanyBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class UserType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
		    ->add('username',null,array('label'=>'Nombre Completo'))
            ->add('firstname',null,array('label'=>'Nombre'))
            ->add('lastName', null, array('label' => 'Apellidos'))
            ->add('email', 'email')
            ->add('website',null,array('label'=>'Sitio Web'))
	    ->add('phone',null,array('label'=>'Telefono')) 
            ->add('password', 'repeated', array(
                'type' => 'password',
                'invalid_message' => 'Las dos contraseñas deben coincidir',
                'options' => array('label' => 'Contraseña'),
				'required' => false
                ))
            ;

    }

    public function getName()
    {
        return 'web_companybundle_usertype';
    }

}