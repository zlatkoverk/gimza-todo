<?php


namespace App\Controller;


use App\Entity\TodoItem;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class ApiController extends AbstractController
{
    /**
     * @Route("/api/todo")
     */
    public function index()
    {
        $todos    = $this->getDoctrine()->getRepository(TodoItem::class)->findAll();
        $response = new Response();
        $response->setContent(json_encode(array_map(function (TodoItem $todo) {
            return ['name' => $todo->getName(), 'dueDate' => $todo->getDueDate() ? $todo->getDueDate()->format('d/m/Y') : null, 'label' => $todo->getLabel()];
        }, $todos)));
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

    /**
     * @Route("/")
     * @Security("has_role('ROLE_USER')")
     */
    public function addTodoAction()
    {
        $todos = $this->getDoctrine()->getRepository(TodoItem::class)->findAll();

        return $this->render('todo/index.html.twig', ['todos' => $todos]);
    }
}