<?php

namespace Web\CompanyBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;
use Web\CompanyBundle\Form\UserType;



class ProfileController extends Controller
{
    
   
    public function profileAction()
  { 
      
     $contexto = $this->get('security.context');
        if ($contexto->isGranted('IS_AUTHENTICATED_REMEMBERED'))
      {
      $usuario = $this->get('security.context')->getToken()->getUser();     
      $formulario = $this->createForm(new UserType(), $usuario);
      
   
      $peticion = $this->getRequest();
      
      if ($peticion->getMethod() == 'POST') {
        $passwordOriginal = $formulario->getData()->getPassword();
        
        $formulario->bindRequest($peticion);
        if ($formulario->isValid()) {
            
            if (null == $usuario->getPassword()) {
            $usuario->setPassword($passwordOriginal);
            }
           
            
            else {
            $encoder = $this->get('security.encoder_factory')
            ->getEncoder($usuario);
            $passwordCodificado = $encoder->encodePassword(
            $usuario->getPassword(),
            $usuario->getSalt()
            );
            $usuario->setPassword($passwordCodificado);
            }
            
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($usuario);
            $em->flush();
            $this->get('session')->setFlash('info',
            'Los datos de tu perfil se han actualizado correctamente'   ); 
        
            return $this->redirect($this->generateUrl('WebCompanyBundle_perfil'));
            
            }
           
        }

         $em = $this->getDoctrine()->getEntityManager();
         $destacada5 = $em->getRepository('WebCompanyBundle:Company')->findDestacadafive();
        
        return $this->render('WebCompanyBundle:Perfil:profile.html.twig', array(
            'usuario' => $usuario,
            'formulario' => $formulario->createView(),
            'top'=> $destacada5
            ));  
            
          }
              
      return $this->redirect($this->generateUrl('WebCompanyBundle_homepage'));
  }
     
   
}
