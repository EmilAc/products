<?php

namespace App\Controller;

use App\Entity\Category;
use App\Form\EditCategoryType;
use App\Repository\CategoryRepository;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\RouterInterface;

class CategoriesController extends AbstractController
{
    /**
     * @var ProductRepository
     */
    private $productRepository;

    /**
     * @var RouterInterface
     */
    private $router;

    /**
     * @var CategoryRepository
     */
    private $categoryRepository;

    /**
     * @var FormFactoryInterface
     */
    private $formFactory;


    public function __construct(ProductRepository $productRepository, RouterInterface $router,
                                CategoryRepository $categoryRepository, FormFactoryInterface $formFactory)
    {
        $this->productRepository = $productRepository;
        $this->router = $router;
        $this->categoryRepository = $categoryRepository;
        $this->formFactory = $formFactory;
    }

    /**
     * @Route("/categories-check", name="categories-check")
     */
    public function categoriesCheck(ProductRepository $productRepository): Response
    {
        $data = $productRepository->findAll();
        if(!$data)
        {
            $message = "Insert data to database";
            return $this->render('index.html.twig', [
                'param' => $message
            ]);
        }

        return new redirectResponse($this->router->generate("categories"));
    }

    /**
     * @Route("/categories", name="categories")
     */
    public function categories(CategoryRepository $categoryRepository): Response
    {
        return $this->render('categories/categories.html.twig',
            ['params' => $this->categoryRepository->findBy([], ['id' => 'ASC'])
            ]);
    }

    /**
     * @Route("/category-edit/{id}", name="category-edit")
     * @param Category $category
     * @param Request $request
     * @return Response
     */
    public function productEdit(Category $category, Request $request): Response
    {
        $form = $this->formFactory->create(EditCategoryType::class, $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($category);
            $entityManager->flush();
            $this->addFlash('notice', 'Category has been updated successfully!');

            $this->redirect('index');
        }

        return $this->render('products/product-edit.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
