<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{
    /**
     * @Route("/category", name="category")
     */
    public function index(): Response
    {
        return $this->render('category/index.html.twig', [
            'controller_name' => 'CategoryController',
        ]);
    }

    /**
     * @Route("/products/create", name="cCreate")
     */
    public function create()
    {
        return $this->render('category/create.html.twig');
    }

    /**
     * @Route("/products/create", name="cStore")
     */
    public function store($requet)
    {

    }

    /**
     * @Route("/products/{id}", name="cShow")
     */
    public function show(int $id)
    {
        return $this->render('category/show.html.twig');
    }

    /**
     * @Route("/products/{id}/edit", name="cEdit")
     */
    public function edit(int $id)
    {
        return $this->render('category/edit.html.twig');
    }

    /**
     * @Route("/products/{id}", name="cUpdate")
     */
    public function update($request, int $id)
    {

    }

    /**
     * @Route("/products/{id}", name="cDestroy")
     */
    public function destroy(int $id)
    {

    }
}
