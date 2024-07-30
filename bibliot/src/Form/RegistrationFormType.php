<?php
namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Entity\User;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('pseudo', TextType::class, [
                'label' => 'Pseudo',
                'attr' => ['class' => 'form-control'],
            ])
            ->add('nom', TextType::class, [
                'label' => 'Nom',
                'attr' => ['class' => 'form-control'],
            ])
            ->add('prenom', TextType::class, [
                'label' => 'Prenom',
                'attr' => ['class' => 'form-control'],
            ])
            ->add('plainPassword', PasswordType::class, [
                'label' => 'Password',
                'mapped' => false,
                'attr' => ['autocomplete' => 'new-password', 'class' => 'form-control']
            ])
            ->add('roles', ChoiceType::class, [
                'choices' => [
                    'Lecteur' => 'ROLE_LECTEUR',
                    'Bibliothécaire' => 'ROLE_BIBLIOTHECAIRE',
                    'Administrateur' => 'ROLE_ADMIN',
                ],
                'expanded' => true, // Single select
                'multiple' => true, // Single selection
                'label' => 'Role',
                'attr' => ['class' => 'form-control']
            ])
            ->add('agreeTerms', CheckboxType::class, [
                'mapped' => false,
                'label' => 'Agree to terms',
                'required' => true,
                'attr' => ['class' => 'form-check-input']
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class, // Ensure this matches the entity used
        ]);
    }
}
