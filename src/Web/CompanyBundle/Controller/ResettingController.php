<?php

namespace Web\CompanyBundle\Controller;


use FOS\UserBundle\Controller\ResettingController as BaseController;


class ResettingController extends BaseController
{
    
   
    public function requestAction()
  { 
    $response = parent::requestAction();
    // ... do custom stuff
    return $response;
   }
  
   
   
   
}
