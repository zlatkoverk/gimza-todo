<?php


namespace App\Controller;


use App\Entity\TodoItem;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


class TodoController extends AbstractController
{
    /**
     * @Route("/", methods={"GET"})
     * @Security("has_role('ROLE_USER')")
     */
    public function index()
    {
        $todos = $this->getDoctrine()->getRepository(TodoItem::class)->findAll();

        return $this->render('todo/index.html.twig', ['todos' => $todos]);
    }

    /**
     * @Route("/", methods={"POST"})
     * @Security("has_role('ROLE_USER')")
     */
    public function addTodoAction(Request $request)
    {
        $todo = new TodoItem();
        $todo->setName($request->get('name', ''));
        $todo->setLabel($request->get('label', ''));
        $todo->setUser($this->getUser());

        $dueDate = $request->get('dueDate');
        if (!empty($dueDate)) {
            $todo->setDueDate($dueDate);
        }

        $this->getDoctrine()->getManager()->persist($todo);
        $this->getDoctrine()->getManager()->flush();

        return $this->redirect('/');
    }
}