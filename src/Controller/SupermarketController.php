<?php

namespace App\Controller;

use App\Entity\Supermarket;
use App\Form\SupermarketType;
use App\Repository\SupermarketRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/supermarket')]
class SupermarketController extends AbstractController
{
    #[Route('/', name: 'app_supermarket_index', methods: ['GET'])]
    public function index(SupermarketRepository $supermarketRepository): Response
    {
        return $this->render('supermarket/index.html.twig', [
            'supermarkets' => $supermarketRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_supermarket_new', methods: ['GET', 'POST'])]
    public function new(Request $request, SupermarketRepository $supermarketRepository): Response
    {
        $supermarket = new Supermarket();
        $form = $this->createForm(SupermarketType::class, $supermarket);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $supermarketRepository->save($supermarket, true);

            return $this->redirectToRoute('app_supermarket_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('supermarket/new.html.twig', [
            'supermarket' => $supermarket,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_supermarket_show', methods: ['GET'])]
    public function show(Supermarket $supermarket): Response
    {
        return $this->render('supermarket/show.html.twig', [
            'supermarket' => $supermarket,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_supermarket_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Supermarket $supermarket, SupermarketRepository $supermarketRepository): Response
    {
        $form = $this->createForm(SupermarketType::class, $supermarket);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $supermarketRepository->save($supermarket, true);

            return $this->redirectToRoute('app_supermarket_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('supermarket/edit.html.twig', [
            'supermarket' => $supermarket,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_supermarket_delete', methods: ['POST'])]
    public function delete(Request $request, Supermarket $supermarket, SupermarketRepository $supermarketRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$supermarket->getId(), $request->request->get('_token'))) {
            $supermarketRepository->remove($supermarket, true);
        }

        return $this->redirectToRoute('app_supermarket_index', [], Response::HTTP_SEE_OTHER);
    }
}
