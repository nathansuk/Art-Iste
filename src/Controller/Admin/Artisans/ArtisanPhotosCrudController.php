<?php

namespace App\Controller\Admin\Artisans;

use App\Entity\ArtisanPhotos;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Context\AdminContext;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Router\CrudUrlGenerator;
use Symfony\Component\HttpFoundation\RedirectResponse;

class ArtisanPhotosCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return ArtisanPhotos::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            AssociationField::new('artisan', 'Vitrine :'),
            BooleanField::new('valid', 'Valide ?'),
            TextareaField::new('imageName')

        ];
    }

    public function configureActions(Actions $actions): Actions
    {
        $validPhoto = Action::new('validPhoto',
            'Valider la photo',
            'fas fa-check-square')
            ->linkToCrudAction('validPhoto')
            ->displayIf(function ($entity) {
                return !$entity->getValid();
            });

        $seePhoto = Action::new('seePhoto',
            'Voir la photo',
            'fas fa-eye')
            ->linkToCrudAction('seePhoto');


        return $actions
            ->add(Crud::PAGE_INDEX, $validPhoto)
            ->add(Crud::PAGE_INDEX, $seePhoto)
            ->disable(Action::NEW)
            ->update(Crud::PAGE_INDEX, Action::DELETE, function (Action $action) {
                return $action->setLabel('Supprimer');
            })
            ->update(Crud::PAGE_INDEX, Action::EDIT, function (Action $action) {
                return $action->setLabel('Modifier');
            });
    }

    public function validPhoto(AdminContext $context): RedirectResponse
    {

        $id = $context->getRequest()->query->get('entityId');
        $photo = $this->getDoctrine()->getRepository(ArtisanPhotos::class)->find($id);

        $photo->setValid(true);
        $this->persistEntity($this->get('doctrine')->getManagerForClass($context->getEntity()->getFqcn()), $photo);
        $this->addFlash('success', 'La récompense a été envoyée !');

        return $this->redirect($this->get(CrudUrlGenerator::class)->build()->setAction(Action::INDEX)->generateUrl());

    }

    public function seePhoto(AdminContext $context){
        $id = $context->getRequest()->query->get('entityId');
        $photo = $this->getDoctrine()->getRepository(ArtisanPhotos::class)->find($id);
        return new RedirectResponse('/assets/upload/book_photo/'. $photo->getImageName());
    }

}
