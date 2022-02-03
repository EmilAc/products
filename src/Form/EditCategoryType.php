<?php

namespace App\Form;

use App\Entity\Category;
use Doctrine\ORM\EntityManagerInterface as ObjectManager;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EditCategoryType extends AbstractType
{
    /** @var string $dropDownEntities */
    private static $entities = 'Category';

    /** @var ObjectManager $em */
    private $em;

    /** @var array $formCollection */
    private $formCollection;

    /**
     * EditCategoryType constructor.
     * @param ObjectManager $em
     */
    public function __construct(ObjectManager $em)
    {
        $this->em = $em;
        $this->setFormCollection();
    }

    public function buildForm(FormBuilderInterface $builder, array $options):void
    {
        $builder
//            ->add('category', EntityType::class, [
//                'class' => Category::class,
//                'choices' => $this->formCollection['Category'],
//                'choice_label' => 'categoryName',
//                'required' => true,
//                'expanded' => false,
//                'multiple' => false,
//                'placeholder' => 'Select Category'
//            ])
            ->add('categoryName', TextType::class, array(
                'invalid_message' => 'The entered upc is not valid',
                'required' => true
            ))
            ->add('Edit', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
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
        $repo = $this->em->getRepository('App:' . ucfirst(strtolower(self::$entities)));
        $this->formCollection[ucfirst(strtolower(self::$entities))] = $repo->getCollection()->getQuery()->getResult();
    }
}
