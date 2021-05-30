<?php

namespace Web\CompanyBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;



class DefaultController extends Controller
{
    
    public function indexAction()
    {
        return $this->render('WebCompanyBundle:Default:index.html.twig');
    }
    
    
    public function contactAction()
    {
        $peticion = $this->getRequest();
        $em = $this->getDoctrine()->getEntityManager();
        $destacada5 = $em->getRepository('WebCompanyBundle:Company')->findDestacadafive();
        
        // Se crea un formulario "in situ", sin clase asociada
        $formulario = $this->createFormBuilder()
            ->add('remitente', 'email')
            ->add('mensaje', 'textarea')
            ->getForm()
        ;
        
        if ($peticion->getMethod() == 'POST') {
            $formulario->bindRequest($peticion);
            
            if ($formulario->isValid()) {
                $datos = $formulario->getData();
                
                $contenido = sprintf(" Remitente: %s \n\n Mensaje: %s \n\n Navegador: %s \n Dirección IP: %s \n",
                    $datos['remitente'],
                    htmlspecialchars($datos['mensaje']),
                    $peticion->server->get('HTTP_USER_AGENT'),
                    $peticion->server->get('REMOTE_ADDR')
                );
                
                $mensaje = \Swift_Message::newInstance()
                    ->setSubject('Contacto')
                    ->setFrom($datos['remitente'])
                    ->setTo('teudisnaranjo@gmail.com')
                    ->setBody($contenido)
                ;
                
                $this->container->get('mailer')->send($mensaje);
                
                $this->get('session')->setFlash('info',
                    'Tu mensaje se ha enviado correctamente.'
                );
                
                return $this->redirect($this->generateUrl('WebCompanyBundle_contact'));
            }
        }
        
        return $this->render('WebCompanyBundle:Home:contacto.html.twig', array(
            'formulario' => $formulario->createView(),'top'=>$destacada5
        ));
      
      
        
    }
    
    public function directorioAction()
    {
          $em = $this->getDoctrine()->getEntityManager();
         
        $destacada5 = $em->getRepository('WebCompanyBundle:Company')->findDestacadafive();

        $entity = $em->getRepository('WebCompanyBundle:Company')->allCountryOrdenados();
        
         return $this->render('WebCompanyBundle:Home:directorio.html.twig',array('pais'=>$entity,
         'top'=>$destacada5));
        
    }
    
    public function searchcountryAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $destacada5 = $em->getRepository('WebCompanyBundle:Company')->findDestacadafive();
        $entity = $em->getRepository('WebCompanyBundle:Company')->findByCountry($id);
        return $this->render('WebCompanyBundle:Home:directorio_pais.html.twig',array('pais'=>$entity,
        'top'=>$destacada5));
        
    }
    
    public function show_companyAction($id)
    {
        
        $em = $this->getDoctrine()->getEntityManager();
        $destacada5 = $em->getRepository('WebCompanyBundle:Company')->findDestacadafive();

        $entity = $em->getRepository('WebCompanyBundle:Company')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('No se ha encontrado la empresa solicitada');
        }

        return $this->render('WebCompanyBundle:Home:show_company.html.twig', array(
            'entity'      => $entity,
            'top'=> $destacada5           
        ));
        
        
        
    }
    
    public function categoriaAction()
    {        
             
         $em =  $this->getDoctrine()->getEntityManager();
        
          $entity =  $em->
                  createQuery('SELECT p FROM WebCompanyBundle:TypeofProduct p ORDER BY p.name ASC')
                        ->getResult();
          $destacada5 = $em->getRepository('WebCompanyBundle:Company')->findDestacadafive();
        
        
        $cantidad = count($entity);
      
        return $this->render('WebCompanyBundle:Company:categoria.html.twig',array(
            'categories'      => $entity ,
            'cantidad' => $cantidad,
            'top'=>$destacada5
            ));
    }
    
    
    public function allcompanyAction($indice = 0)
    {
       $em = $this->getDoctrine()->getEntityManager();
       $cantFija = $this->container->getParameter('cant_fija_paginar');
       $cantEmp = count($em->getRepository('WebCompanyBundle:Company')->findCantidadEmpresas(true));
       $indice = $indice * $cantFija;
        $destacada5 = $em->getRepository('WebCompanyBundle:Company')->findDestacadafive();
       
       $empresas = $em->getRepository('WebCompanyBundle:Company')->findEmpresaPaginar($indice, $cantFija, true);
       return $this->render('WebCompanyBundle:Company:all.html.twig', 
               array('empresas' => $empresas, 'indice' => $indice, 'cantidadEmp' => $cantEmp,'top'=>$destacada5));
        
    }
    
}
