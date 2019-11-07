<?php


namespace App\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;


class TodoController extends AbstractController
{
    /**
     * @Route("/")
     * @Security("has_role('ROLE_USER')")
     */
    public function index()
    {
        return $this->render('todo/index.html.twig');
    }
}