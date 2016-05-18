<?php

namespace Ztrint\Finance\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Ztrint\Finance\AdminBundle\Entity\Cashgroup;
use Ztrint\Finance\AdminBundle\Form\CashgroupType;

/**
 * Cashgroup controller.
 *
 */
class CashgroupController extends Controller {

  /**
   * Lists all Cashgroup entities.
   *
   */
  public function indexAction() {
    $em = $this->getDoctrine()->getManager();

    $cashgroups = $em->getRepository('ZtrintFinanceAdminBundle:Cashgroup')->findAll();

    return $this->render('ZtrintFinanceAdminBundle:Cashgroup:index.html.twig', array(
                'cashgroups' => $cashgroups,
    ));
  }

  /**
   * Creates a new Cashgroup entity.
   *
   */
  public function newAction(Request $request) {
    $cashgroup = new Cashgroup();
    $form = $this->createForm('Ztrint\Finance\AdminBundle\Form\CashgroupType', $cashgroup);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
      $em = $this->getDoctrine()->getManager();
      $em->persist($cashgroup);
      $em->flush();

      return $this->redirectToRoute('zf_admin_cashgroup_show', array('id' => $cashgroup->getId()));
    }

    return $this->render('ZtrintFinanceAdminBundle:Cashgroup:new.html.twig', array(
                'cashgroup' => $cashgroup,
                'form' => $form->createView(),
    ));
  }

  /**
   * Finds and displays a Cashgroup entity.
   *
   */
  public function showAction(Cashgroup $cashgroup) {
    $deleteForm = $this->createDeleteForm($cashgroup);

    $em = $this->getDoctrine()->getManager();
    $currencies = $em->getRepository('ZtrintFinanceAdminBundle:Currency')->findAll();

    return $this->render('ZtrintFinanceAdminBundle:Cashgroup:show.html.twig', array(
                'cashgroup' => $cashgroup,
                'currencies' => $currencies,
                'delete_form' => $deleteForm->createView(),
    ));
  }

  /**
   * Displays a form to edit an existing Cashgroup entity.
   *
   */
  public function editAction(Request $request, Cashgroup $cashgroup) {
    $deleteForm = $this->createDeleteForm($cashgroup);
    $editForm = $this->createForm('Ztrint\Finance\AdminBundle\Form\CashgroupType', $cashgroup);
    $editForm->handleRequest($request);

    if ($editForm->isSubmitted() && $editForm->isValid()) {
      $em = $this->getDoctrine()->getManager();
      $em->persist($cashgroup);
      $em->flush();

      return $this->redirectToRoute('zf_admin_cashgroup_edit', array('id' => $cashgroup->getId()));
    }

    return $this->render('ZtrintFinanceAdminBundle:Cashgroup:edit.html.twig', array(
                'cashgroup' => $cashgroup,
                'edit_form' => $editForm->createView(),
                'delete_form' => $deleteForm->createView(),
    ));
  }

  /**
   * Deletes a Cashgroup entity.
   *
   */
  public function deleteAction(Request $request, Cashgroup $cashgroup) {
    $form = $this->createDeleteForm($cashgroup);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
      $em = $this->getDoctrine()->getManager();
      $em->remove($cashgroup);
      $em->flush();
    }

    return $this->redirectToRoute('zf_admin_cashgroup_index');
  }

  /**
   * Creates a form to delete a Cashgroup entity.
   *
   * @param Cashgroup $cashgroup The Cashgroup entity
   *
   * @return \Symfony\Component\Form\Form The form
   */
  private function createDeleteForm(Cashgroup $cashgroup) {
    return $this->createFormBuilder()
                    ->setAction($this->generateUrl('zf_admin_cashgroup_delete', array('id' => $cashgroup->getId())))
                    ->setMethod('DELETE')
                    ->getForm()
    ;
  }

}
