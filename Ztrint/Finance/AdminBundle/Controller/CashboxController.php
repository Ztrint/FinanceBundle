<?php

namespace Ztrint\Finance\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Ztrint\Finance\AdminBundle\Entity\Cashbox;
use Ztrint\Finance\AdminBundle\Form\CashboxType;

/**
 * Cashbox controller.
 *
 */
class CashboxController extends Controller {

  public function indexAction() {
    $em = $this->getDoctrine()->getManager();

    $cashboxes = $em->getRepository('ZtrintFinanceAdminBundle:Cashbox')->findBy([], ['cashgroup' => 'ASC']);

    return $this->render('ZtrintFinanceAdminBundle:Cashbox:index.html.twig', array(
                'cashboxes' => $cashboxes,
    ));
  }

  public function newAction(Request $request) {
    $cashbox = new Cashbox();
    $form = $this->createForm('Ztrint\Finance\AdminBundle\Form\CashboxType', $cashbox);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
      $em = $this->getDoctrine()->getManager();
      $em->persist($cashbox);
      $em->flush();

      return $this->redirectToRoute('zf_admin_cashbox_index');
    }

    return $this->render('ZtrintFinanceAdminBundle:Cashbox:new.html.twig', array(
                'cashbox' => $cashbox,
                'form' => $form->createView(),
    ));
  }

  public function showAction(Cashbox $cashbox) {
    $deleteForm = $this->createDeleteForm($cashbox);

    return $this->render('ZtrintFinanceAdminBundle:Cashbox:show.html.twig', array(
                'cashbox' => $cashbox,
                'delete_form' => $deleteForm->createView(),
    ));
  }

  public function editAction(Request $request, Cashbox $cashbox) {
    $deleteForm = $this->createDeleteForm($cashbox);
    $editForm = $this->createForm('Ztrint\Finance\AdminBundle\Form\CashboxType', $cashbox);
    $editForm->handleRequest($request);

    if ($editForm->isSubmitted() && $editForm->isValid()) {
      $em = $this->getDoctrine()->getManager();
      $em->persist($cashbox);
      $em->flush();

      return $this->redirectToRoute('zf_admin_cashbox_index');
    }

    return $this->render('ZtrintFinanceAdminBundle:Cashbox:edit.html.twig', array(
                'cashbox' => $cashbox,
                'edit_form' => $editForm->createView(),
                'delete_form' => $deleteForm->createView(),
    ));
  }

  public function deleteAction(Request $request, Cashbox $cashbox) {
    $form = $this->createDeleteForm($cashbox);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
      $em = $this->getDoctrine()->getManager();
      $em->remove($cashbox);
      $em->flush();
    }

    return $this->redirectToRoute('zf_admin_cashbox_index');
  }

  /**
   * @param Cashbox $cashbox The Cashbox entity
   * @return \Symfony\Component\Form\Form The form
   */
  private function createDeleteForm(Cashbox $cashbox) {
    return $this->createFormBuilder()
                    ->setAction($this->generateUrl('zf_admin_cashbox_delete', array('id' => $cashbox->getId())))
                    ->setMethod('DELETE')
                    ->getForm()
    ;
  }

}
