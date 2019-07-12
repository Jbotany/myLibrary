<?php

namespace App\Form;

use App\Entity\Book;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BookType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('ISBN')
            ->add('title')
            ->add('toBuy')
            ->add('owned')
            ->add('isRead')
            ->add('publishingYear')
            ->add('format')
            ->add('price')
            ->add('summary')
            ->add('storagePlace')
            ->add('translator')
            //->add('authors')
            ->add('publisher')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Book::class,
        ]);
    }
}
