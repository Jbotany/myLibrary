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
            ->add('title')
            ->add('toBuy')
            ->add('possessed')
            ->add('isRead')
            ->add('publishingYear')
            ->add('format')
            ->add('ISBN')
            ->add('price')
            ->add('summary')
            ->add('storagePlace')
            ->add('translator')
            ->add('author')
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
