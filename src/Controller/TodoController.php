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
        $todos = $this->getDoctrine()->getRepository(TodoItem::class)->findBy(['user' => $this->getUser()], ['createdAt' => 'ASC']);

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
            $dueDateTime = new \DateTime($dueDate);
            $todo->setDueDate($dueDateTime);
        }

        $this->getDoctrine()->getManager()->persist($todo);
        $this->getDoctrine()->getManager()->flush();

        return $this->redirect('/');
    }

    /**
     * @Route("/todo/delete/{id}", methods={"GET"})
     * @Security("has_role('ROLE_USER')")
     */
    public function removeTodoAction(int $id)
    {
        $todo = $this->getDoctrine()->getRepository(TodoItem::class)->find($id);

        if (empty($todo) || $todo->getUser()->getId() !== $this->getUser()->getId()) {
            return $this->json(['message' => 'Access Denied'], 403);
        }

        $this->getDoctrine()->getManager()->remove($todo);
        $this->getDoctrine()->getManager()->flush();

        return $this->redirect('/');
    }
}