<?php

namespace Web\CompanyBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class SitioController extends Controller
{
    public function estaticaAction($pagina)
    {
        return $this->render('WebCompanyBundle:Sitio:'.$pagina.'.html.twig');
    }

}


