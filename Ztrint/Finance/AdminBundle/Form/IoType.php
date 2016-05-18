<?php

namespace Ztrint\Finance\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class IoType extends AbstractType {

  /**
   * @param FormBuilderInterface $builder
   * @param array $options
   */
  public function buildForm(FormBuilderInterface $builder, array $options) {
    $sortcashbox = function (EntityRepository $er) {
      return $er->createQueryBuilder('c')->orderBy('c.name', 'ASC');
    };
    $builder
            ->add('at', DateType::class, [
                'label' => 'El',
                'widget' => 'single_text',
                'format' => 'dd/MM/yy',
            ])
            ->add('source', EntityType::class, [
                'label' => 'Origen',
                'class' => 'ZtrintFinanceAdminBundle:Cashbox',
                'query_builder' => $sortcashbox,
            ])
            ->add('dest', null, [
                'label' => 'Destino',
                'class' => 'ZtrintFinanceAdminBundle:Cashbox',
                'query_builder' => $sortcashbox,
            ])
            ->add('concept', null, [
                'label' => 'Concepto',
                'attr' => ['list' => 'concepts']
            ])
            ->add('amount', null, ['label' => 'Importe'])
            ->add('price', null, ['label' => 'Cotización'])
    ;
  }

  /**
   * @param OptionsResolver $resolver
   */
  public function configureOptions(OptionsResolver $resolver) {
    $resolver->setDefaults(array(
        'data_class' => 'Ztrint\Finance\AdminBundle\Entity\Io'
    ));
  }

}
