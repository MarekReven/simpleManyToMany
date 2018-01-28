<?php
/**
 * Created by PhpStorm.
 * User: Laptop
 * Date: 2018-01-27
 * Time: 14:57
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Category;
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
     * @Route("simplesql/addCategory/{sex}")
     */
    public function addCategory($sex){

        $category = new Category();
        $category->setSex($sex);

        $em = $this->getDoctrine()->getManager();
        $em->persist($category);
        $em->flush();

        return new Response("category {$sex} added");
    }

    /**
     * @Route("simplesql/joinCategoryToUser/{userid}/{categoryid}")
     */
    public function joinCategoryToUser($userid, $categoryid)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository(User::class)->find($userid);

        if(!$user instanceof User)
        {
            return new Response("not joined");
        }

        $category = $em->getRepository(Category::class)->find($categoryid);
        $user->addNewCategory($category);

        $em->persist($user);
        $em->flush();

        return new Response("joined");
    }

    /**
     * @Route("simplesql/joinUserToCategory/{userid}/{categoryid}")
     */
    public function joinUserToCategory($userid, $categoryid)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository(User::class)->find($userid);
        $category = $em->getRepository(Category::class)->find($categoryid);
//        dump($user);
//        dump($category);

        if(!$category instanceof Category){
            return new Response("Category not instance of Category");
        }

        $category->addUser($user);
        $em->persist($category);
        $em->flush();

        return new Response("joined user to category");
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

    /**
     * @Route("simplesql/getAllFemales")
     */
    public function getAllFemales(){

        $users = $this->getDoctrine()
            ->getRepository(User::class)
            ->findAll();


        return $this->render('simplesql/allUsers.html.twig', array('users' => $users));
    }


}