<?php

namespace Ztrint\Finance\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DutyType extends AbstractType {

  /**
   * @param FormBuilderInterface $builder
   * @param array $options
   */
  public function buildForm(FormBuilderInterface $builder, array $options) {
    $builder
            ->add('at', null, [
                'label' => 'El',
                'widget' => 'single_text',
                'format' => 'dd/MM/yy',
            ])
            ->add('currency', null, ['label' => 'Divisa'])
            ->add('amount', null, ['label' => 'Importe'])
            ->add('price', null, ['label' => 'Cotización'])
            ->add('tax', null, ['label' => 'Impuestos (%)'])
            ->add('concept', null, [
                'label' => 'Concepto',
                'attr' => ['list' => 'concepts']
            ])
    ;
  }

  /**
   * @param OptionsResolver $resolver
   */
  public function configureOptions(OptionsResolver $resolver) {
    $resolver->setDefaults(array(
        'data_class' => 'Ztrint\Finance\AdminBundle\Entity\Duty'
    ));
  }

}
