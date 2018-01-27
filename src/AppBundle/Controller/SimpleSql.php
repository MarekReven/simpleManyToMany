<?php
/**
 * Created by PhpStorm.
 * User: Laptop
 * Date: 2018-01-27
 * Time: 14:57
 */

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\User;

class SimpleSql extends Controller
{
    /**
     * @Route("/simplesql")
     */
    public function showAction(){

        $user = new User();
        $user->setName('Dawid');

        $em = $this->getDoctrine()->getManager();
        $em->persist($user);
        $em->flush();

        return new Response("user added");
    }

    /**
     * @Route("simplesql/addUser/{name}")
     */
    public function addUser($name){

        $user = new User();
        $user->setName($name);

        $em = $this->getDoctrine()->getManager();
        $em->persist($user);
        $em->flush();

        return new Response("user {$name} added");
    }

    /**
     * @Route("simplesql/getAllUsers")
     */
    public function getAllUsers(){

        $users = $this->getDoctrine()
            ->getRepository(User::class)
            ->findAll();


        return $this->render('simplesql/allUsers.html.twig', array('users' => $users));
    }


}