<?php

namespace App\Form;

use App\Entity\JourMenu;
use App\Entity\RepasMenu;
use App\Entity\TypeRepas;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RepasMenuType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('description')
            ->add('typeRepas', EntityType::class, [
                'class' => TypeRepas::class,
                'choice_label' => 'type',
            ])
            ->add('jourMenu', EntityType::class, [
                'class' => JourMenu::class,
                'choice_label' => function($jourMenu){
                    return $jourMenu->getDateJour()->format('l d/m/Y');
                }
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => RepasMenu::class,
        ]);
    }
}
