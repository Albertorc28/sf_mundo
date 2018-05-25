<?php

namespace App\Form;

use App\Entity\Presidente;
use App\Entity\Pais;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class PresidenteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre')
            ->add('fechanac', DateType::class, array(
              'label' => 'Nacimiento',
              'format' => 'dd MM yyyy',
              'years' => range(date('1930'), date('Y')),
              'required' => true
           ))
            ->add('pais',EntityType::class,array(
              'class' => pais::class,
              'choice_label' => function ($pais) {
                  return $pais->getNombre();
           }))
            ->add('save', SubmitType::class, array('attr' => array('class' => 'btn btn-success')))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Presidente::class,
        ]);
    }
}
