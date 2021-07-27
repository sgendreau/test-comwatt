<?php

namespace App\Form;

use App\Entity\Pays;
use App\Entity\Produit;
use App\Entity\RefTypeGenre;
use App\Entity\RefTypeProduit;
use App\Form\EventSubscriber\CheckFormEventSubscriber;
use App\Repository\PaysRepository;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductFormType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre',
                TextType::class,
                [
                    'label'    => 'Titre',
                    'required' => true,
                    'attr'     => [
                        'placeholder' => 'Harry Potter à l\'école des sorciers',
                    ],
                ])
            ->add('titreOriginal',
                TextType::class,
                [
                    'label'    => 'Titre original',
                    'required' => false,
                    'attr'     => [
                        'placeholder' => 'Harry Potter and the Philosopher\'s stone',
                    ],
                ])
            ->add('anneeEdition',
                NumberType::class,
                [
                    'label'    => 'Année d\'édition',
                    'required' => true,
                    'attr'     => [
                        'placeholder' => '1997'
                    ]
                ])
            ->add('description',
                TextareaType::class,
                [
                    'label'    => 'Description',
                    'required' => false,
                    'attr'     => [
                        'rows' => 5
                    ]
                ])
            ->add('prix',
                NumberType::class,
                [
                    'label'    => 'Prix (en €)',
                    'required' => true,
                ])
            ->add('note',
                NumberType::class,
                [
                    'label'    => 'Note',
                    'required' => true,
                    'attr'     => [
                        'min' => 0,
                        'max' => 10
                    ]
                ])
            ->add('nationalite',
                EntityType::class,
                [
                    'class' => Pays::class,
                    'query_builder' => function(EntityRepository $paysRepository) {
                        return $paysRepository->createQueryBuilder('p')
                                ->orderBy('p.nomFr', 'ASC');
                    },
                    'choice_label' => 'nomFr',
                    'choice_value' => 'uuid',
                    'choice_attr' => [
                        'required' => true
                    ]
                ])
            ->add('genres',
                EntityType::class,
                [
                    'class'         => RefTypeGenre::class,
                    'query_builder' => function(EntityRepository $genreRepository) {
                        return $genreRepository->createQueryBuilder('g')
                            ->orderBy('g.libelle', 'ASC');
                    },
                    'choice_label' => 'libelle',
                    'required'     => true,
                    'multiple'     => true
                ])
            ->add('typeProduit',
                EntityType::class,
                [
                    'class'         => RefTypeProduit::class,
                    'query_builder' => function(EntityRepository $typeProduitRepository) {
                        return $typeProduitRepository->createQueryBuilder('tp')
                            ->orderBy('tp.libelle', 'ASC');
                    },
                    'choice_label' => 'libelle',
                    'choice_attr' => [
                        'required' => true
                    ]
                ])
        ;
        $builder->addEventSubscriber(new CheckFormEventSubscriber());
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Produit::class,
        ]);
    }
}
