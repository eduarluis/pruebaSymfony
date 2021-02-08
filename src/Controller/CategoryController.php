<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\HttpFoundation\Request;

use App\Entity\Categories;
use App\Form\CategoryType;

class CategoryController extends AbstractController
{
    /**
     * @Route("/category", name="category")
     */
    public function index(): Response
    {
        $em = $this->getDoctrine()->getManager();

        $category = $em->getRepository(Categories::class)->findAll();

        return $this->render('category/index.html.twig', ['categories'=>$category]);
    }

    /**
     * @Route("category/create", name="cCreate")
     */
    public function create(Request $request)
    {
        $categories = new Categories();

        $form = $this->createForm(CategoryType::class, $categories);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $entityManager = $this->getDoctrine()->getManager();

            $categories->setCreatedAt( new \DateTime());
            $categories->setUpdatedAt( new \DateTime());

            $categories = $form->getData();

            $entityManager->persist($categories);
            $entityManager->flush(); 
            
            return $this->redirectToRoute('category');
            
        }

        return $this->render('category/create.html.twig',['form' => $form->createView()]);
    }

    /**
     * @Route("category/{id}", name="cShow")
     */
    public function show(int $id)
    {
        $em = $this->getDoctrine()->getManager();
        $category = $em->getRepository(Categories::class)->find($id); 
        return $this->render('category/show.html.twig',['category' => $category]);
    }

    /**
     * @Route("category/{id}/edit", name="cEdit")
     */
    public function edit(int $id,Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $category = $em->getRepository(Categories::class)->find($id);

        if (!$category) {
          throw $this->createNotFoundException(
                  'No category found for id ' . $id
          );
        }
        
        $form = $this->createForm(CategoryType::class, $category);
    
        $form->handleRequest($request);
     
        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();
            // return new Response('category updated successfully');
            return $this->redirectToRoute('category');
        }
        
        $build['form'] = $form->createView();

        return $this->render('category/edit.html.twig',$build);
    }

    /**
     * @Route("category/{id}", name="cDestroy")
     */
    public function destroy(int $id)
    {

    }
}
