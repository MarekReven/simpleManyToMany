<?php
/**
 * Created by PhpStorm.
 * User: Laptop
 * Date: 2018-01-27
 * Time: 14:57
 */

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

class SimpleSql
{
    /**
     * @Route("/simplesql")
     */
    public function showAction(){
        return new Response("juhuuu");
    }

}