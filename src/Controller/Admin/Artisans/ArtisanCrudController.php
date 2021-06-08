<?php

namespace App\Controller\Admin\Artisans;

use App\Entity\Artisan;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Context\AdminContext;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Router\CrudUrlGenerator;

class ArtisanCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Artisan::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            AssociationField::new('user', 'Utilisateur'),
            TextField::new('vitrineName', 'Nom de la vitrine'),
            AssociationField::new('category', 'Catégorie'),
            TextField::new('kbis', 'KBIS'),
            BooleanField::new('isVerified', 'Vérifié'),
            BooleanField::new('atHome', 'Exerce à domicile'),
            BooleanField::new('canMove', 'Se déplace'),
            IntegerField::new('activityPerimeter', 'Périmètre de déplacement (km)'),
        ];
    }

    public function configureActions(Actions $actions): Actions
    {

        $validArtisan = Action::new('validArtisan',
            'Valider le profil',
            'fas fa-check')
            ->linkToCrudAction('validArtisan')
            ->displayIf(function ($entity) {
                return !$entity->getIsVerified();
            });


        return $actions
            ->add(Crud::PAGE_INDEX, $validArtisan)
            ->disable(Action::NEW)
            ->update(Crud::PAGE_INDEX, Action::DELETE, function (Action $action) {
                return $action->setLabel('Supprimer');
            })
            ->update(Crud::PAGE_INDEX, Action::EDIT, function (Action $action) {
                return $action->setLabel('Modifier');
            });
    }

    public function validArtisan(AdminContext $context){

        $id = $context->getRequest()->query->get('entityId');
        $artisan = $this->getDoctrine()->getRepository(Artisan::class)->find($id);
        $user = $this->getDoctrine()->getRepository(User::class)->find($artisan->getUser()->getId());

        $artisan->setIsVerified(true);
        $user->setIsPro(true);
        $this->persistEntity($this->get('doctrine')->getManagerForClass($context->getEntity()->getFqcn()), $artisan);
        $this->persistEntity($this->get('doctrine')->getManagerForClass($context->getEntity()->getFqcn()), $user);

        $this->addFlash('success', 'Le profil pro a bien été validé. Sa vitrine sera désormais accessible publiquement.');

        return $this->redirect($this->get(CrudUrlGenerator::class)->build()->setAction(Action::INDEX)->generateUrl());

    }

}
