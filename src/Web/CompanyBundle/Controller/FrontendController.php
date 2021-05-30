<?php

namespace Web\CompanyBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

//use Symfony\Component\HttpFoundation\Response;

class FrontendController extends Controller{

    public function portadaAction($indice = 0)
    {


        $em = $this->getDoctrine()->getEntityManager();
        $destacada5 = $em->getRepository('WebCompanyBundle:Company')->findDestacadafive();
        $cantFija = $this->container->getParameter('cant_fija_paginar');
        $cantEmp = count($em->getRepository('WebCompanyBundle:Company')->findCantidadEmpresas());
        $indice = $indice * $cantFija;
        $empresas = $em->getRepository('WebCompanyBundle:Company')->findEmpresaPaginar($indice, $cantFija);
        return $this->render('WebCompanyBundle:Frontend:portada.html.twig', 
                array('destacada' => $empresas, 'indice' => $indice, 'cantidadEmp' => $cantEmp,'top'=>$destacada5));
        
    }
    
    
 
            
}

