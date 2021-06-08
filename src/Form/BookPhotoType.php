<?php

namespace App\Form;

use App\Entity\ArtisanPhotos;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BookPhotoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
              $builder->add('imageName', FileType::class, [
                  'label' => 'Ajouter une photo',
                  'multiple' => false,
                  'mapped' => false,
                  'required' => false,
                  'attr' => [
                      'accept' => 'image/jpeg,image/png,image/jpg'
                  ]
              ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ArtisanPhotos::class,
        ]);
    }
}
