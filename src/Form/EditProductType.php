<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Department;
use App\Entity\Manufacturer;
use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface as ObjectManager;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EditProductType extends AbstractType
{
    /** @var string $dropDownEntities */
    private static $entitiesCategory = 'Category';

    /** @var string $dropDownEntities */
    private static $entitiesDepartment = 'Department';

    /** @var string $dropDownEntities */
    private static $entitiesManufacturer = 'Manufacturer';

    /** @var ObjectManager $em */
    private $em;

    /** @var array $formCollection */
    private $formCollection;

    /**
     * EditProductType constructor.
     * @param ObjectManager $em
     */
    public function __construct(ObjectManager $em)
    {
        $this->em = $em;
        $this->setFormCollection();
        $this->setFormCollection2();
        $this->setFormCollection3();
    }

    public function buildForm(FormBuilderInterface $builder, array $options):void
    {
        $builder
            ->add('productNumber', TextType::class, array(
                'invalid_message' => 'The entered username is not valid',
                'required' => true
            ))
            ->add('category', EntityType::class, [
                'class' => Category::class,
                'choices' => $this->formCollection['Category'],
                'choice_label' => 'categoryName',
                'required' => true,
                'expanded' => false,
                'multiple' => false,
                'placeholder' => 'Select Category'
            ])
            ->add('department', EntityType::class, [
                'class' => Department::class,
                'choices' => $this->formCollection['Department'],
                'choice_label' => 'departmentName',
                'required' => true,
                'expanded' => false,
                'multiple' => false,
                'placeholder' => 'Select Department'
            ])
            ->add('manufacturer', EntityType::class, [
                'class' => Manufacturer::class,
                'choices' => $this->formCollection['Manufacturer'],
                'choice_label' => 'manufacturerName',
                'required' => true,
                'expanded' => false,
                'multiple' => false,
                'placeholder' => 'Select Manufacturer'
            ])
            ->add('upc', TextType::class, array(
                'invalid_message' => 'The entered upc is not valid',
                'required' => true
            ))
            ->add('sku', TextType::class, array(
                'invalid_message' => 'The entered sku is not valid',
                'required' => true
            ))
            ->add('regularPrice', TextType::class, array(
                'invalid_message' => 'The entered regular price is not valid',
                'required' => true
            ))
            ->add('salePrice', TextType::class, array(
                'invalid_message' => 'The entered sale price is not valid',
                'required' => true
            ))
            ->add('description', TextareaType::class, [
                'invalid_message' => 'The description text is not valid',
                'required' => true,
                'label' => 'Description',
                'attr' => array('rows' => '5'),
            ])
            ->add('Edit', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Product::class
        ]);
    }

    /**
     * Set form collection
     */
    private function setFormCollection(): void
    {
        $repo = $this->em->getRepository('App:' . ucfirst(strtolower(self::$entitiesCategory)));
        $this->formCollection[ucfirst(strtolower(self::$entitiesCategory))] = $repo->getCollection()->getQuery()->getResult();
    }

    /**
     * Set form collection
     */
    private function setFormCollection2(): void
    {
        $repo = $this->em->getRepository('App:' . ucfirst(strtolower(self::$entitiesDepartment)));
        $this->formCollection[ucfirst(strtolower(self::$entitiesDepartment))] = $repo->getCollection()->getQuery()->getResult();
    }

    /**
     * Set form collection
     */
    private function setFormCollection3(): void
    {
        $repo = $this->em->getRepository('App:' . ucfirst(strtolower(self::$entitiesManufacturer)));
        $this->formCollection[ucfirst(strtolower(self::$entitiesManufacturer))] = $repo->getCollection()->getQuery()->getResult();
    }
}
