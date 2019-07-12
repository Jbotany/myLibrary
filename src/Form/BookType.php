<?php

namespace App\Form;

use App\Entity\Author;
use App\Entity\Book;
use App\Entity\Format;
use App\Entity\Publisher;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BookType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('ISBN')
            ->add('title')
            ->add('summary')
            ->add('authors', EntityType::class,[
                'class' => Author::class,
                'choice_label' => 'fullname',
                'expanded' => true,
                'multiple' => true,
            ])
            ->add('publishingYear')
            ->add('isRead', ChoiceType::class, [
                'choices' => [
                    'Oui' => true,
                    'Non' => false,
                ],
                'expanded' => true,
                'multiple' => false,
            ])
            ->add('format', EntityType::class, [
                'class' => Format::class,
                'choice_label' => 'format'
            ])
            ->add('publisher', EntityType::class, [
                'class' => Publisher::class,
                'choice_label' => 'name'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Book::class,
        ]);
    }
}
