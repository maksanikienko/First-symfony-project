<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;
use App\Repository\ProductRepository;

class IndexController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(ProductRepository $productRepository, Environment $twig): Response
    {
        return new Response($twig->render('front/homepage.html.twig', [
            'products' => $productRepository->findAllByPromoted(),
        ]));
      
    }

}
