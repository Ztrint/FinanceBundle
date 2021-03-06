<?php

namespace Ztrint\Finance\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class CashboxType extends AbstractType {

  /**
   * @param FormBuilderInterface $builder
   * @param array $options
   */
  public function buildForm(FormBuilderInterface $builder, array $options) {
    $builder
            ->add('currency', null, ['label' => 'Divisa'])
            ->add('cashgroup', null, ['label' => 'Grupo'])
            ->add('type', ChoiceType::class, [
                'label' => 'Tipo',
                'choices' => [
                    'Entrada' => 'i',
                    'Crédito' => 'c',
                    'Débito' => 'd',
                ]
            ])
            ->add('name', null, ['label' => 'Nombre'])
    ;
  }

  /**
   * @param OptionsResolver $resolver
   */
  public function configureOptions(OptionsResolver $resolver) {
    $resolver->setDefaults(array(
        'data_class' => 'Ztrint\Finance\AdminBundle\Entity\Cashbox'
    ));
  }

}
