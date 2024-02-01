<?php

namespace App\Form;

use App\Entity\RepasMenu;
use App\Entity\Reservation;
use App\Entity\Utilisateur;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReservationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('utilisateur', EntityType::class, [
                'class' => Utilisateur::class,
                'choice_label' => function (Utilisateur $utilisateur){
                    return $utilisateur->getNom().' '.$utilisateur->getPrenom();
                },
            ])
            ->add('repasMenu', EntityType::class, [
                'class' => RepasMenu::class,
                'choice_label' => function (RepasMenu $repasMenu){
                    return /*$repasMenu->getJourMenu()getDateJour()->format('l d/m/Y').' '. */$repasMenu->getTypeRepas()->getType().' '.$repasMenu->getDescription();
                }
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Reservation::class,
        ]);
    }
}
