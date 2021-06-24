<?php

namespace App\Form;

use App\Entity\UserSettings;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserSettingsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('imageName', FileType::class, [
            'label' => 'Modifier votre photo de profil',
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
            'data_class' => UserSettings::class,
        ]);
    }
}
