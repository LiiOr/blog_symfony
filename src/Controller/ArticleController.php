<?php

namespace App\Controller;

use App\Entity\Article;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{
    /**
     * @Route("/article", name="article.index")
     */
    public function index(): Response
    {
        $articleRepository = $this->getDoctrine()->getRepository(Article::class);
        $articles = $articleRepository->findAll();
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
