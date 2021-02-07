<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    /**
     * @Route("/", name="products")
     */
    public function index(): Response
    {
        return $this->render('product/index.html.twig', [
            'controller_name' => 'ProductController',
        ]);
    }

    /**
     * @Route("/products/create", name="pCreate")
     */
    public function create()
    {
        return $this->render('product/create.html.twig');
    }

    /**
     * @Route("/products/create", name="pStore")
     */
    public function store($requet)
    {

    }

    /**
     * @Route("/products/{id}", name="pShow")
     */
    public function show(int $id)
    {
        return $this->render('product/show.html.twig');
    }

    /**
     * @Route("/products/{id}/edit", name="pEdit")
     */
    public function edit(int $id)
    {
        return $this->render('product/edit.html.twig');
    }

    /**
     * @Route("/products/{id}", name="pUpdate")
     */
    public function update($request, int $id)
    {

    }

    /**
     * @Route("/products/{id}", name="pDestroy")
     */
    public function destroy(int $id)
    {

    }
}
