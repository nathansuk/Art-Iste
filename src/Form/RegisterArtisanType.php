<?php

namespace App\Form;

use App\Entity\Artisan;
use App\Entity\ArtisansJob;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RegisterArtisanType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('category', EntityType::class, [
                'class' => ArtisansJob::class,
                'choice_label' => 'name',
            ])
            ->add('kbis', TextType::class, [
                'attr' => [
                    'placeholder' => 'Numéro KBIS'
                ]
            ])
            ->add('AdressePro', TextType::class, [
                'attr' => [
                    'placeholder' => 'Adresse professionnelle'
                ]
            ])
            ->add('city', TextType::class, [
                'attr' => [
                    'placeholder' => 'Ville'
                ]
            ])
            ->add('zipCode', TextType::class, [
                'attr' => [
                    'placeholder' => 'Code postal'
                ]
            ])
            ->add('atHome', CheckboxType::class, [
                'label' => 'Vous exercez à domicile ?'
            ])
            ->add('canMove', CheckboxType::class, [
                'label' => 'Vous vous déplacez ?'
            ])
            ->add('activityPerimeter', IntegerType::class, [
                'label'  => 'Périmètre activité',
                'attr' => [
                    'placeholder' => 'Périmètre de déplacement (km)'
                ]
            ])
            ->add('phoneNumber', TelType::class, [
                'attr' => [
                    'placeholder' => 'Numéro de téléphone professionnel'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Artisan::class,
        ]);
    }
}
