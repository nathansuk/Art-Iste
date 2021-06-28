<?php

namespace App\Form;

use App\Entity\Artisan;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArtisanSettingsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('vitrineName', TextType::class, [
                'label' => 'Intitulé de la vitrine'
            ])
            ->add('vitrineDesc', TextareaType::class, [
                'label' => 'Description de la vitrine (max. 255 caractères)'
            ])
            ->add('kbis', TextType::class, [
                'attr' => [
                    'disabled' => true
                ]
            ])
            ->add('AdressePro', TextType::class, [
                'label' => 'Adresse profesionnelle'
            ])
            ->add('atHome', CheckboxType::class, [
                'label' => 'Exercice à domicile'
            ])
            ->add('canMove', CheckboxType::class, [
                'label' => 'Je me déplace'
            ])
            ->add('activityPerimeter', IntegerType::class, [
                'label' => 'Périmètre de déplacement'
            ])
            ->add('cover_image', FileType::class, [
                'label' => 'Modifier la photo de couverture',
                'multiple' => false,
                'mapped' => false,
                'required' => false,
                'attr' => [
                    'accept' => 'image/jpeg,image/png,image/jpg'
                ]
            ])
            ->add('phoneNumber', TelType::class, [
                'label' => 'Numéro de téléphone professionel'
            ])
            ->add('category')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Artisan::class,
        ]);
    }
}
