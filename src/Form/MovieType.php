<?php

namespace App\Form;

use App\Entity\Movie;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MovieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title')
            ->add('poster')
            ->add('overview')
            ->add('releaseDate', DateType::class, ["widget"=>"single_text"])
            ->add('updatedAt')
            ->add('genre')
            ->add('user')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Movie::class,
            'csrf_protection'=>false
        ]);
    }

    // eliminen el prefix per defecte que s'afig als controls dels formularis
    // perquè no generem formularis, així podem usar handleRequest
    public function getBlockPrefix(): string
    {
        return '';
    }

    // eliminem el nom del formulari perquè no s'utilize a l'hora d'obtenir les claus de les dades enviades.
    public function getName(): string
    {
        return '';
    }
}
