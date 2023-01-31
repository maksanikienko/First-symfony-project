<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MyController extends AbstractController
{
    #[Route('/', name: 'app')]
    public function index(): Response
    {
        $data = [
            'name' => 'John',
            'age' => 25,
        ];
        //return new Response('Hello World!');
        return $this->render('base.html.twig', $data);
    }
}
