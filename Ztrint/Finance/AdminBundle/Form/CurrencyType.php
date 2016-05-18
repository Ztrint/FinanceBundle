<?php

namespace Ztrint\Finance\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CurrencyType extends AbstractType {

  /**
   * @param FormBuilderInterface $builder
   * @param array $options
   */
  public function buildForm(FormBuilderInterface $builder, array $options) {
    $builder
            ->add('id', null, ['label' => 'ID'])
            ->add('valuebuy', null, ['label' => 'Compra'])
            ->add('valuesell', null, ['label' => 'Venta 1'])
            ->add('valuesell2', null, ['label' => 'Venta 2'])
    ;
  }

  /**
   * @param OptionsResolver $resolver
   */
  public function configureOptions(OptionsResolver $resolver) {
    $resolver->setDefaults(array(
        'data_class' => 'Ztrint\Finance\AdminBundle\Entity\Currency'
    ));
  }

}
