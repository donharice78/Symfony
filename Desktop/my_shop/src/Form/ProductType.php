<?php

namespace App\Form;

use App\Entity\Product;
use App\Enum\CollectionEnum;
use App\Form\DataTransformer\CollectionEnumTransformer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductType extends AbstractType
{
    private $collectionEnumTransformer;

    public function __construct(CollectionEnumTransformer $collectionEnumTransformer)
    {
        $this->collectionEnumTransformer = $collectionEnumTransformer;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title')
            ->add('description')
            ->add('colour')
            ->add('collection', ChoiceType::class, [
                'choices' => [
                    'm' => CollectionEnum::M->value,
                    'f' => CollectionEnum::F->value,
                ],
                'choice_label' => fn($choice) => ucfirst($choice),
                'choice_value' => fn($choice) => $choice,
            ] )
            ->add('photo', FileType::class, [
                'label' => 'Photo (JPEG, PNG, GIF file)',
                'mapped' => false,
                'required' => false,
               
            ])
            ->add('price')
            ->add('stock')
            ->add('createdAt', null, [
                'widget' => 'single_text',
            ]);

        // Apply the data transformer to the 'collection' field
       
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
    }
}
