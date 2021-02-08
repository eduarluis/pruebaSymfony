<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\HttpFoundation\Request;

use App\Entity\Products;
use App\Form\ProductsType;

class ProductController extends AbstractController
{
    /**
     * @Route("/", name="products")
     */
    public function index(): Response
    {
        $em = $this->getDoctrine()->getManager();

        $products = $em->getRepository(Products::class)->findAll();

        return $this->render('product/index.html.twig',['products' => $products]);
    }

    /**
     * @Route("/products/create", name="pCreate")
     */
    public function create(Request $request)
    {
        $product = new Products();

        $form = $this->createForm(ProductsType::class, $product);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $entityManager = $this->getDoctrine()->getManager();
            
            $data = $form->getData();
            $product->setCreatedAt( new \DateTime());
            $product->setUpdatedAt( new \DateTime());

            $entityManager->persist($product);
            $entityManager->flush();

            $this->addFlash(
                'notice',
                'Se registro con exito el producto!'
            );

            return $this->redirectToRoute('pCreate');
        }

        return $this->render('product/create.html.twig',['form' => $form->createView()]);
    }

    /**
     * @Route("/products/{id}", name="pShow")
     */
    public function show(int $id)
    {
        $em = $this->getDoctrine()->getManager();
        $product = $em->getRepository(Products::class)->find($id);

        return $this->render('product/show.html.twig',['product' => $product]);
    }

    /**
     * @Route("/products/{id}/edit", name="pEdit")
     */
    public function edit(int $id,Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $product = $em->getRepository(Products::class)->find($id);
        if (!$product) {
          throw $this->createNotFoundException(
                  'No product found for id ' . $id
          );
        }
        
        $form = $this->createForm(ProductsType::class, $product);
    
        $form->handleRequest($request);
     
        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();
            // return new Response('Product updated successfully');
            $this->addFlash(
                'notice',
                'Se actualizo con exito el producto!'
            );
            return $this->redirectToRoute('products');
        }
        
        $build['form'] = $form->createView();

        return $this->render('product/edit.html.twig', $build);
    }

    /**
     * @Route("/products/{id}/delete", name="pDestroy")
     */
    public function destroy(int $id)
    {
        $em = $this->getDoctrine()->getManager();
        $product = $em->getRepository(Products::class)->find($id);

        $em->remove($product);
        $em->flush($product);

        $this->addFlash(
            'notice',
            'Se elimino con exito el producto!'
        );

        return $this->redirectToRoute('products');

    }
}
