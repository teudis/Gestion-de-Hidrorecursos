<?php

namespace Web\CompanyBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;
use Web\CompanyBundle\Form\CompanyType;
use Web\CompanyBundle\Entity\Company;
use Web\CompanyBundle\Entity\Country;
use Web\CompanyBundle\Entity\CompanyUser;

class CompanyController extends Controller
{
    
    public function createcompanyAction()
    {
        $contexto = $this->get('security.context');
        if ($contexto->isGranted('IS_AUTHENTICATED_REMEMBERED'))
        {

           $empresa = new Company();
           $peticion = $this->getRequest();
           $formulario = $this->createForm(new CompanyType(), $empresa);
        if ($peticion->getMethod() == 'POST') {
        // Validar los datos enviados y guardarlos en la base de datos
            $formulario->bindRequest($peticion);
            if ($formulario->isValid()) {
            // guardar la información en la base de datos
                
                $em = $this->getDoctrine()->getEntityManager();
                $empresa->setAccept(0);
                $empresa->setDestacada(0);
                $usuario = $this->get('security.context')->getToken()->getUser();  
                $empresa->setUser($usuario);
                $em->persist($empresa);
               
               
                  //Buscar Administradores para enviar correo
                /*$userManager = $this->get('fos_user.user_manager');

                $users = $userManager->findUsers();
                foreach($users as $user)
                {

                foreach($user->getRoles() as $role)
                {
                  //die($role);
                    if($role == "ROLE_SUPER_ADMIN"){

                          //Send email
                       $destinatario = $user->getEmail();
                      $message = \Swift_Message::newInstance()
                      ->setSubject('New Company')
                      ->setFrom('admin@hidrorecursos.com')
                      ->setTo($destinatario)
                      ->setBody('Datos de la empresa......');

                    }

                }
               }  */

               //Enviar Correo a Alex con datos de empresa

               

            $message = \Swift_Message::newInstance()
            ->setSubject('Company Data')
            ->setFrom('admin@hidrorecursos.com')
            ->setTo('teudis2008@gmail.com')
            ->setBody($this->renderView('WebCompanyBundle:Company:email.txt.twig', 
                    array('empresa' =>
             $empresa)));
            $this->get('mailer')->send($message);
            $em->flush();
      return $this->redirect($this->generateUrl('WebCompanyBundle_message_company'));
              


            }
        }

        $em = $this->getDoctrine()->getEntityManager();
         $destacada5 = $em->getRepository('WebCompanyBundle:Company')->findDestacadafive();

        return $this->render('WebCompanyBundle:Company:create_company.html.twig',
                array('formulario' => $formulario->createView(),'top'=>$destacada5)
        );

      }

      return $this->redirect($this->generateUrl('WebCompanyBundle_homepage'));
    }
    

    public function message_companyAction()
    {


         $em = $this->getDoctrine()->getEntityManager();
         $destacada5 = $em->getRepository('WebCompanyBundle:Company')->findDestacadafive();

        return $this->render('WebCompanyBundle:Company:mensaje_company.html.twig',
                array('top'=>$destacada5));
    }
    
    public function listadoAction()
    {
         $contexto = $this->get('security.context');
        if ($contexto->isGranted('IS_AUTHENTICATED_REMEMBERED'))
        {
       $usuario = $this->get('security.context')->getToken()->getUser();               
       $repository = $this->getDoctrine()->getRepository('WebCompanyBundle:Company');
       $empresas = $repository->findByUser($usuario->getId());
          $em = $this->getDoctrine()->getEntityManager();
         $destacada5 = $em->getRepository('WebCompanyBundle:Company')->findDestacadafive();

       return $this->render('WebCompanyBundle:Company:listado_company.html.twig',array('empresas' => $empresas,'top'=>$destacada5)); 
       }
          return $this->redirect($this->generateUrl('WebCompanyBundle_homepage')); 
    }
            
            
            
    public function editcompanyAction($id)
    {
         $contexto = $this->get('security.context');
        if ($contexto->isGranted('IS_AUTHENTICATED_REMEMBERED'))
        {
      

        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('WebCompanyBundle:Company')->find($id);
        

        if (!$entity) {
            throw $this->createNotFoundException('No se ha encontrado empresas');
        }

        $editForm = $this->createForm(new CompanyType(), $entity);
        $deleteForm = $this->createDeleteForm($id);
		
         $em = $this->getDoctrine()->getEntityManager();
         $destacada5 = $em->getRepository('WebCompanyBundle:Company')->findDestacadafive();

        return $this->render('WebCompanyBundle:Company:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'top'=>$destacada5
        ));
       
      }

      return $this->redirect($this->generateUrl('WebCompanyBundle_homepage'));

    }
    
    public function updatecompanyAction($id)
    {
        
        $contexto = $this->get('security.context');
        if ($contexto->isGranted('IS_AUTHENTICATED_REMEMBERED'))
        {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('WebCompanyBundle:Company')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('No se ha encontrado la empresa solicitada');
        }

        $editForm   = $this->createForm(new CompanyType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();
            
              $this->get('session')->setFlash('info',
            'La Empresa se ha actualizado  correctamente'); 

            return $this->redirect($this->generateUrl('WebCompanyBundle_editar_company', array('id' => $id)));
        }
           
        $em = $this->getDoctrine()->getEntityManager();
         $destacada5 = $em->getRepository('WebCompanyBundle:Company')->findDestacadafive();   
        return $this->render('WebCompanyBundle:Company:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'top' => $destacada5
        ));
        
    }

     return $this->redirect($this->generateUrl('WebCompanyBundle_homepage'));
        
    }
    
      private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
    
    
    public function deletecompanyAction($id)
    {
          
           $contexto = $this->get('security.context');
        if ($contexto->isGranted('IS_AUTHENTICATED_REMEMBERED'))
        {   

            $em = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('WebCompanyBundle:Company')->find($id);
            
            if (!$entity) {
                throw $this->createNotFoundException('No se ha encontrado la empresa solicitada');
            }
            
            $em->remove($entity);
            $em->flush();
//        }
        
        return $this->redirect($this->generateUrl('WebCompanyBundle_listado_company'));

        }

        return $this->redirect($this->generateUrl('WebCompanyBundle_homepage'));
    }
    
    
    
    public function showcompanyAction ($id)
    {
       
         $contexto = $this->get('security.context');
        if ($contexto->isGranted('IS_AUTHENTICATED_REMEMBERED'))
        {   
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('WebCompanyBundle:Company')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('No se ha encontrado la empresa solicitada');
        }

        $deleteForm = $this->createDeleteForm($id);
        $em = $this->getDoctrine()->getEntityManager();
         $destacada5 = $em->getRepository('WebCompanyBundle:Company')->findDestacadafive();

        return $this->render('WebCompanyBundle:Company:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
            'top'=>$destacada5
        ));

        }
      return $this->redirect($this->generateUrl('WebCompanyBundle_homepage'));
    }
    
    
    public function searchletterAction($letter)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $destacada5 = $em->getRepository('WebCompanyBundle:Company')->findDestacadafive();

        $empresas = $em->getRepository('WebCompanyBundle:Company')->findAll();
        
        
        return $this->render('WebCompanyBundle:Company:directorio_letras.html.twig',
                array('letra'=>$letter,
                'company'=>$empresas,
                'top'=>$destacada5)
                );
        
    }


    public function lettercategetoryAction($letter)
    {
         $em = $this->getDoctrine()->getEntityManager();
         $destacada5 = $em->getRepository('WebCompanyBundle:Company')->findDestacadafive();

        $empresas = $em->getRepository('WebCompanyBundle:TypeofProduct')->findAll();
        
        
        return $this->render('WebCompanyBundle:Company:directory_categories.html.twig',
                array('letra'=>$letter,
                'company'=>$empresas,
                'top'=>$destacada5)
                );
        


    }
    
    
    
    public function searchnameAction()
    {
         $peticion = $this->getRequest();
         $name = $peticion->request->get('nombre');        
         $em = $this->getDoctrine()->getEntityManager();
         $destacada5 = $em->getRepository('WebCompanyBundle:Company')->findDestacadafive();

         $empresas = $em->getRepository('WebCompanyBundle:Company')->findByName($name);
         return $this->render('WebCompanyBundle:Company:directorio_name.html.twig',
                array('company'=>$empresas,'top'=>$destacada5)
                );
    }
    
    public function searchproductAction($id)
    {
       
        $em = $this->getDoctrine()->getEntityManager();
               $destacada5 = $em->getRepository('WebCompanyBundle:Company')->findDestacadafive();
        $empCat = $em->getRepository('WebCompanyBundle:Company')->findEmpresaCategoria($id);
        return $this->render('WebCompanyBundle:Company:categoriaproduct.html.twig', 
                array('empCat' => $empCat, 'cantTotal' => count($empCat),'top'=>$destacada5));
        
    }
    
    
    
}
