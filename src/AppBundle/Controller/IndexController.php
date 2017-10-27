<?php

namespace AppBundle\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
// Model
use AppBundle\Entity\User;
// Form
use AppBundle\Form\AddNewForm;

class IndexController extends Controller
{
    /**
     * @Route("/index", name="homepage")
     */
    public function indexAction(Request $request)
    {
      $user = $this->getDoctrine()
              ->getRepository('AppBundle:User')
              ->findall();
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
            'user'=>$user,
        ]);
    }
    /**
     * @Route("/index/create", name="homepage.create")
     */
    public function createAction(Request $request)
    {
      $user = new User();
      $form = $this->createForm(AddNewForm::class, $user);
      $form->handleRequest($request);
      if ($form->isSubmitted() && $form->isValid()) {
        $this->addFlash(
            'notice',
            'User created'
        );
        $name = $form['Name']->getData();
        $username = $form['Username']->getData();
        $password = $form['Password']->getData();
        $now = new\DateTime('now');
        $user->setName($name);
        $user->setUsername($username);
        $user->setPassword($password);
        $user->setCreateDate($now);
        // you can fetch the EntityManager via $this->getDoctrine()
        // or you can add an argument to your action: createAction(EntityManagerInterface $em)
        $em = $this->getDoctrine()->getManager();
        // tells Doctrine you want to (eventually) save the Product (no queries yet)
        $em->persist($user);
        // actually executes the queries (i.e. the INSERT query)
        $em->flush();

        return $this->redirectToRoute('homepage');
      }
      return $this->render('default/create.html.twig',[
        'form'=>$form->createView(),
      ]);
    }
    /**
     * @Route("/index/read/{id}", name="homepage.read")
     */
    public function ReadAction($id)
    {
      $user = $this->getDoctrine()
              ->getRepository('AppBundle:User')
              ->find($id);
        // replace this example code with whatever you need
        return $this->render('default/detail.html.twig', [
            'user'=>$user,
        ]);
    }
    /**
     * @Route("/index/update/{id}", name="homepage.update")
     */
    public function UpdateAction($id,Request $request)
    {
      $user = $this->getDoctrine()
              ->getRepository('AppBundle:User')
              ->find($id);
      $form = $this->createForm(AddNewForm::class, $user);
      $form->handleRequest($request);
      if ($form->isSubmitted() && $form->isValid()) {

        $name = $form['Name']->getData();
        $username = $form['Username']->getData();
        $password = $form['Password']->getData();
        $now = new\DateTime('now');
        $user->setName($name);
        $user->setUsername($username);
        $user->setPassword($password);
        $user->setUpdateDate($now);
        // you can fetch the EntityManager via $this->getDoctrine()
        // or you can add an argument to your action: createAction(EntityManagerInterface $em)
        $em = $this->getDoctrine()->getManager();
        // tells Doctrine you want to (eventually) save the Product (no queries yet)
        $em->persist($user);
        // actually executes the queries (i.e. the INSERT query)
        $em->flush();
        $this->addFlash(
            'notice',
            'User updated'
        );
        return $this->redirectToRoute('homepage');
      }
      return $this->render('default/create.html.twig',[
        'form'=>$form->createView(),
      ]);
    }
    /**
     * @Route("/index/delete/{id}", name="homepage.delete")
     */
    public function DeleteAction($id)
    {
      $this->addFlash(
          'notice',
          'User deleted'
      );
      $em = $this->getDoctrine()->getManager();
      $user = $em->getRepository('AppBundle:User')
              ->find($id);
      // $user->setDeleteDate($now);
      // $em->flush();
      $em->remove($user);
      $em->flush();
      return $this->redirectToRoute('homepage');
    }
}
