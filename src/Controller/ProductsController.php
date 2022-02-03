<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Product;
use App\Form\EditProductType;
use App\Form\ProductsByCategoryType;
use App\Repository\CategoryRepository;
use App\Repository\DepartmentRepository;
use App\Repository\ManufacturerRepository;
use App\Repository\ProductRepository;
//use ContainerROafclf\getProductRepositoryService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\RouterInterface;
use Twig\Environment;

/**
 * ProductsController
 */
class ProductsController extends AbstractController
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
     * @var Environment
     */
    private $twig;

    /**
     * @var CategoryRepository
     */
    private $categoryRepository;

    /**
     * @var DepartmentRepository
     */
    private $departmentRepository;

    /**
     * @var ManufacturerRepository
     */
    private $manufacturerRepository;

    /**
     * @var FormFactoryInterface
     */
    private $formFactory;

    /**
     * @var FlashBagInterface
     */
    private $flashBag;

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @param ProductRepository $productRepository
     * @param RouterInterface $router
     * @param Environment $twig
     * @param CategoryRepository $categoryRepository
     * @param DepartmentRepository $departmentRepository
     * @param ManufacturerRepository $manufacturerRepository
     * @param FormFactoryInterface $formFactory
     * @param EntityManagerInterface $entityManager
     * @param FlashBagInterface $flashBag
     */
    public function __construct(ProductRepository $productRepository, RouterInterface $router,
                                Environment $twig, CategoryRepository $categoryRepository,
                                DepartmentRepository $departmentRepository, ManufacturerRepository $manufacturerRepository,
                                FormFactoryInterface $formFactory, EntityManagerInterface $entityManager,
                                FlashBagInterface $flashBag)
    {
        $this->productRepository = $productRepository;
        $this->router = $router;
        $this->twig = $twig;
        $this->categoryRepository = $categoryRepository;
        $this->departmentRepository = $departmentRepository;
        $this->manufacturerRepository = $manufacturerRepository;
        $this->formFactory = $formFactory;
        $this->entityManager = $entityManager;
        $this->flashBag = $flashBag;
    }

    /**
     * @Route("/index", name="index")
     */
    public function index(ProductRepository $productRepository): Response
    {
        $data = $productRepository->findAll();
        if(!$data)
        {
            $message = "Insert data to database";
            return $this->render('index.html.twig', [
                'param' => $message
            ]);
        }
//        echo 'Oh noo';
//        return $this->render('index.html.twig', [
//            'params' => $data
//        ]);
        return new redirectResponse($this->router->generate("products"));
    }

    /**
     * @Route("/products", name="products")
     */
    public function products(ProductRepository $productRepository): Response
    {
        return $this->render('products/products.html.twig',
            ['params' => $this->productRepository->findBy([], ['id' => 'ASC'])
            ]);

//        $html = $this->twig->render('products.html.twig', [
//            'params' => $this->productRepository->findBy(['id' => 'DESC'])
//        ]);
//        return new Response($html);
    }

    /**
     * @Route("/product/{id}", name="product")
     */
    public function product(ProductRepository $productRepository, Product $productNumber): Response
    {
        $categoryId = $productNumber->{'category'}->{'id'};
        $departmentId = $productNumber->{'department'}->{'id'};
        $manufacturerId = $productNumber->{'manufacturer'}->{'id'};
        $category = $this->categoryRepository->findBy(['id' => $categoryId]);
        $categoryName = $category[0]->{'category_name'};
        $department = $this->departmentRepository->findBy(['id' => $departmentId]);
        $departmentName = $department[0]->{'department_name'};
        $manufacturer = $this->manufacturerRepository->findBy(['id' => $manufacturerId]);
        $manufacturerName = $manufacturer[0]->{'manufacturer_name'};
//        var_dump($departmentName);die;

        $html = $this->twig->render('products/product.html.twig', [
            'param' => $productNumber,
            'category_name' => $categoryName,
            'department_name' => $departmentName,
            'manufacturer_name' => $manufacturerName,
        ]);
        return new Response($html);
    }

    /**
     * @Route("/product-edit/{id}", name="product-edit")
     * @param Product $product
     * @param Request $request
     * @return Response
     */
    public function productEdit(Product $product, Request $request)
    {
        $form = $this->formFactory->create(EditProductType::class, $product);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($product);
            $entityManager->flush();
            $this->addFlash('notice', 'Product has been updated successfully!');

            $this->redirect('index');
        }
        return $this->render('products/product-edit.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/product-delete/{id}", name="product-delete")
     * @param Product $product
     * @return Response
     */
    public function productDelete(Product $product): RedirectResponse
    {
        $this->entityManager->remove($product);
        $this->entityManager->flush();
        $this->flashBag->add('notice', 'Product has been deleted');

        return new RedirectResponse($this->router->generate("products"));
    }

    /**
     * @Route("/products-by-category", name="products-by-category")
     * @param Request $request
     * @return Response
     */
    public function productsByCategory(Request $request)
    {
        $category = new Category();
        $form = $this->formFactory->create(ProductsByCategoryType::class, $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $entityObject = $form->get('categoryName')->getData();
            $categoryId = $entityObject->getId();
            return $this->render('products/products.html.twig',
                ['params' => $this->productRepository->findBy(['category_id' => $categoryId], ['id' => 'ASC'])
                ]);
        }
        return $this->render('products/category-form.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
