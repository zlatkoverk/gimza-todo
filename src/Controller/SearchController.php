<?php


namespace App\Controller;


use App\Entity\TodoItem;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


class SearchController extends AbstractController
{

    /**
     * @Security("has_role('ROLE_USER')")
     * @Route("/search")
     */
    public function searchAction(Request $request)
    {
        $query = $request->get('query');

        $todos = $this->getDoctrine()->getRepository(TodoItem::class)->createQueryBuilder('todoItem')
            ->where('todoItem.user = :user')
            ->andWhere('todoItem.label = :label')
            ->orderBy('todoItem.createdAt', 'ASC')
            ->setParameters([
                'user'  => $this->getUser(),
                'label' => $query
            ])->getQuery()->getResult();

        return $this->render('todo/index.html.twig', ['todos' => $todos]);
    }
}