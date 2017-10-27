<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
// Model
use AppBundle\Entity\Role;
// Form
use AppBundle\Form\RoleForm;

class RoleController extends Controller
{
    /**
     * @Route("/role", name="role.index")
     */
     public function indexAction(Request $request)
     {
       $role = $this->getDoctrine()
               ->getRepository('AppBundle:Role')
               ->findall();
         // replace this example code with whatever you need
         return $this->render('role/index.html.twig', [
             'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
             'role'=>$role,
         ]);
     }
     /**
      * @Route("/role/create", name="role.create")
      */
     public function createAction(Request $request)
     {
       $role = new Role();
       $form = $this->createForm(RoleForm::class, $role);
       $form->handleRequest($request);
       if ($form->isSubmitted() && $form->isValid()) {
         $this->addFlash(
             'notice',
             'Role created'
         );
         $role->setName($form['Name']->getData());
         $role->setDescription($form['Description']->getData());
         // you can fetch the EntityManager via $this->getDoctrine()
         // or you can add an argument to your action: createAction(EntityManagerInterface $em)
         $em = $this->getDoctrine()->getManager();
         // tells Doctrine you want to (eventually) save the Product (no queries yet)
         $em->persist($role);
         // actually executes the queries (i.e. the INSERT query)
         $em->flush();

         return $this->redirectToRoute('role.index');
       }
       return $this->render('role/create.html.twig',[
         'form'=>$form->createView(),
       ]);
     }
     /**
      * @Route("/role/read/{id}", name="role.read")
      */
     public function ReadAction($id)
     {
       $role = $this->getDoctrine()
               ->getRepository('AppBundle:Role')
               ->find($id);
         // replace this example code with whatever you need
         return $this->render('role/detail.html.twig', [
             'role'=>$role,
         ]);
     }
     /**
      * @Route("/role/update/{id}", name="role.update")
      */
     public function UpdateAction($id,Request $request)
     {
       $role = $this->getDoctrine()
               ->getRepository('AppBundle:Role')
               ->find($id);
       $form = $this->createForm(RoleForm::class, $role);
       $form->handleRequest($request);
       if ($form->isSubmitted() && $form->isValid()) {
         $role->setName($form['Name']->getData());
         $role->setDescription($form['Description']->getData());
         // you can fetch the EntityManager via $this->getDoctrine()
         // or you can add an argument to your action: createAction(EntityManagerInterface $em)
         $em = $this->getDoctrine()->getManager();
         // tells Doctrine you want to (eventually) save the Product (no queries yet)
         $em->persist($role);
         // actually executes the queries (i.e. the INSERT query)
         $em->flush();
         $this->addFlash(
             'notice',
             'User updated'
         );
         return $this->redirectToRoute('role.index');
       }
       return $this->render('default/edit.html.twig',[
         'form'=>$form->createView(),
       ]);
     }
     /**
      * @Route("/role/delete/{id}", name="role.delete")
      */
     public function DeleteAction($id)
     {
       $this->addFlash(
           'notice',
           'User deleted'
       );
       $em = $this->getDoctrine()->getManager();
       $role = $em->getRepository('AppBundle:Role')
               ->find($id);
       // $role->setDeleteDate($now);
       // $em->flush();
       $em->remove($role);
       $em->flush();
       return $this->redirectToRoute('role.index');
     }
}
