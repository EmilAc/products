<?php

namespace App\Form;

use App\Entity\Category;
use Doctrine\ORM\EntityManagerInterface as ObjectManager;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductsByCategoryType extends AbstractType
{
    /** @var string $dropDownEntities */
    private static $dropDownEntities = 'Category';

    /** @var ObjectManager $em */
    private $em;

    /** @var array $formCollection */
    private $formCollection;

    /**
     * ProductsByCategoryType constructor.
     * @param ObjectManager $em
     */

    public function __construct(ObjectManager $em)
    {
        $this->em = $em;
        $this->setFormCollection();
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('categoryName', EntityType::class, [
                'class' => Category::class,
                'choices' => $this->formCollection['Category'],
                'choice_label' => 'categoryName',
                'required' => true,
                'label' => 'Select category',
                'expanded' => false,
                'multiple' => false,
                'placeholder' => 'Select category'
            ])
            ->add('search', SubmitType::class, [
                'label' => 'Search'
            ]);
//            ->add('generateCSV', SubmitType::class, [
//                'label' => 'Generate csv'
//            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Category::class
        ]);
    }

    /**
     * Set form collection
     */
    private function setFormCollection(): void
    {
        $repo = $this->em->getRepository('App:' . ucfirst(strtolower(self::$dropDownEntities)));
        $this->formCollection[ucfirst(strtolower(self::$dropDownEntities))] = $repo->getCollection()->getQuery()->getResult();
    }
}
