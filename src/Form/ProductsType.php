<?php

namespace App\Form;

use App\Entity\Products;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\ChoiceList\ChoiceList;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;

use App\Entity\Categories;

class ProductsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('code', null, ['required'=> true,'attr' => ['class' => 'form-control']])
            ->add('name', null, ['required'=> true,'attr' => ['class' => 'form-control']])
            ->add('description', null, ['required'=> true,'attr' => ['class' => 'form-control']])
            ->add('brand', null, ['required'=> true,'attr' => ['class' => 'form-control']])
            ->add('category', EntityType::class,[
                'class' => Categories::class,
                'choice_value' => ChoiceList::value($this, 'id'),
                'choice_label' => 'name',
                'attr' => ['class' => 'form-control']
            ])
            ->add('price', null, ['required'=> true,'attr' => ['class' => 'form-control']])
            ->add('Guardar', SubmitType::class, ['attr' => ['class' => 'mt-3 btn btn-success']])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Products::class,
        ]);
    }
}
