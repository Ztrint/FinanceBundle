<?php

namespace Ztrint\Finance\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PortfolioType extends AbstractType {

  /**
   * @param FormBuilderInterface $builder
   * @param array $options
   */
  public function buildForm(FormBuilderInterface $builder, array $options) {
    $builder
            ->add('start', null, ['label' => 'Inicio'])
            ->add('end', null, ['label' => 'Vencimiento'])
            ->add('currency', null, ['label' => 'Divisa'])
            ->add('deposit', null, ['label' => 'Depósito'])
            ->add('anr', null, ['label' => 'TNA'])
            ->add('cert', null, ['label' => 'Certificado'])
    ;
  }

  /**
   * @param OptionsResolver $resolver
   */
  public function configureOptions(OptionsResolver $resolver) {
    $resolver->setDefaults(array(
        'data_class' => 'Ztrint\Finance\AdminBundle\Entity\Portfolio'
    ));
  }

}
