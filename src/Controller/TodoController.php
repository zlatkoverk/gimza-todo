<?php


namespace App\Controller;


use App\Entity\TodoItem;
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
        $todos = $this->getDoctrine()->getRepository(TodoItem::class)->findAll();

        return $this->render('todo/index.html.twig', ['todos' => $todos]);
    }
}