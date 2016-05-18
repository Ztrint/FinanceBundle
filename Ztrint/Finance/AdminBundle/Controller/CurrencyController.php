<?php

namespace Ztrint\Finance\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Ztrint\Finance\AdminBundle\Entity\Currency;
use Ztrint\Finance\AdminBundle\Form\CurrencyType;

/**
 * Currency controller.
 *
 */
class CurrencyController extends Controller {

  /**
   * Lists all Currency entities.
   *
   */
  public function indexAction() {
    $em = $this->getDoctrine()->getManager();

    $currencies = $em->getRepository('ZtrintFinanceAdminBundle:Currency')->findAll();

    return $this->render('ZtrintFinanceAdminBundle:Currency:index.html.twig', array(
                'currencies' => $currencies,
    ));
  }

  public function newAction(Request $request) {
    $currency = new Currency();
    $form = $this->createForm('Ztrint\Finance\AdminBundle\Form\CurrencyType', $currency);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
      $em = $this->getDoctrine()->getManager();
      $em->persist($currency);
      $em->flush();

      return $this->redirectToRoute('zf_admin_currency_show', array('id' => $currency->getId()));
    }

    return $this->render('ZtrintFinanceAdminBundle:Currency:new.html.twig', array(
                'currency' => $currency,
                'form' => $form->createView(),
    ));
  }

  public function showAction(Currency $currency) {
    $deleteForm = $this->createDeleteForm($currency);

    return $this->render('ZtrintFinanceAdminBundle:Currency:show.html.twig', array(
                'currency' => $currency,
                'delete_form' => $deleteForm->createView(),
    ));
  }

  public function editAction(Request $request, Currency $currency) {
    $deleteForm = $this->createDeleteForm($currency);
    $editForm = $this->createForm('Ztrint\Finance\AdminBundle\Form\CurrencyType', $currency);
    $editForm->handleRequest($request);

    if ($editForm->isSubmitted() && $editForm->isValid()) {
      $em = $this->getDoctrine()->getManager();
      $em->persist($currency);
      $em->flush();

      return $this->redirectToRoute('zf_admin_currency_show', array('id' => $currency->getId()));
    }

    return $this->render('ZtrintFinanceAdminBundle:Currency:edit.html.twig', array(
                'currency' => $currency,
                'edit_form' => $editForm->createView(),
                'delete_form' => $deleteForm->createView(),
    ));
  }

  /**
   * Deletes a Currency entity.
   *
   */
  public function deleteAction(Request $request, Currency $currency) {
    $form = $this->createDeleteForm($currency);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
      $em = $this->getDoctrine()->getManager();
      $em->remove($currency);
      $em->flush();
    }

    return $this->redirectToRoute('zf_admin_currency_index');
  }

  /**
   * Creates a form to delete a Currency entity.
   *
   * @param Currency $currency The Currency entity
   *
   * @return \Symfony\Component\Form\Form The form
   */
  private function createDeleteForm(Currency $currency) {
    return $this->createFormBuilder()
                    ->setAction($this->generateUrl('zf_admin_currency_delete', array('id' => $currency->getId())))
                    ->setMethod('DELETE')
                    ->getForm()
    ;
  }

}
