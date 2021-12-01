<?php

namespace App\Controller;

use App\Entity\Article;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{
    /**
     * @Route("/article", name="article.index")
     */
    public function index(PaginatorInterface $paginator, Request $request): Response
    {
        $articleRepository = $this->getDoctrine()->getRepository(Article::class);
        $articles = $articleRepository->findAll();

        $articles = $paginator->paginate($articles, $request->query->getInt('page', 1), 10);
        //dd($articles);
        return $this->render('article/index.html.twig', [
            //'controller_name' => 'ArticleController',
            'articles' => $articles
        ]);
    }

    /**
     * @Route("/article/{id}", name="article.show")
     */
    public function show($id): Response
    {
        $articleRepository = $this->getDoctrine()->getRepository(Article::class);
        $article = $articleRepository->find($id);
        if (!$article) {
            throw $this->createNotFoundException('The article does not exist');
        }
        return $this->render('article/show.html.twig', [
            //'controller_name' => 'ArticleController',
            'article' => $article
        ]);
    }
}
