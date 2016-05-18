<?php

namespace Ztrint\Finance\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Ztrint\Finance\AdminBundle\Entity\Duty;
use Ztrint\Finance\AdminBundle\Form\DutyType;

/**
 * Duty controller.
 *
 */
class DutyController extends Controller {

  /**
   * Lists all Duty entities.
   *
   */
  public function indexAction() {
    $em = $this->getDoctrine()->getManager();

    $duties = $em->getRepository('ZtrintFinanceAdminBundle:Duty')->findAll();

    return $this->render('ZtrintFinanceAdminBundle:Duty:index.html.twig', array(
                'duties' => $duties,
    ));
  }

  /**
   * Creates a new Duty entity.
   *
   */
  public function newAction(Request $request) {
    $duty = new Duty();
    $form = $this->createForm('Ztrint\Finance\AdminBundle\Form\DutyType', $duty);
    $form->handleRequest($request);

    $em = $this->getDoctrine()->getManager();

    if ($form->isSubmitted() && $form->isValid()) {
      $em->persist($duty);
      $em->flush();

      return $this->redirectToRoute('zf_admin_duty_index');
    }

    return $this->render('ZtrintFinanceAdminBundle:Duty:new.html.twig', array(
                'duty' => $duty,
                'form' => $form->createView(),
                'concepts' => $em->getRepository('ZtrintFinanceAdminBundle:Duty')->createQueryBuilder('d')->select('d.concept')->distinct()->getQuery()->getResult(),
    ));
  }

  /**
   * Finds and displays a Duty entity.
   *
   */
  public function showAction(Duty $duty) {
    $deleteForm = $this->createDeleteForm($duty);

    return $this->render('ZtrintFinanceAdminBundle:Duty:show.html.twig', array(
                'duty' => $duty,
                'delete_form' => $deleteForm->createView(),
    ));
  }

  /**
   * Displays a form to edit an existing Duty entity.
   *
   */
  public function editAction(Request $request, Duty $duty) {
    $deleteForm = $this->createDeleteForm($duty);
    $editForm = $this->createForm('Ztrint\Finance\AdminBundle\Form\DutyType', $duty);
    $editForm->handleRequest($request);

    if ($editForm->isSubmitted() && $editForm->isValid()) {
      $em = $this->getDoctrine()->getManager();
      $em->persist($duty);
      $em->flush();

      return $this->redirectToRoute('zf_admin_duty_index');
    }

    return $this->render('ZtrintFinanceAdminBundle:Duty:edit.html.twig', array(
                'duty' => $duty,
                'edit_form' => $editForm->createView(),
                'delete_form' => $deleteForm->createView(),
    ));
  }

  /**
   * Deletes a Duty entity.
   *
   */
  public function deleteAction(Request $request, Duty $duty) {
    $form = $this->createDeleteForm($duty);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
      $em = $this->getDoctrine()->getManager();
      $em->remove($duty);
      $em->flush();
    }

    return $this->redirectToRoute('zf_admin_duty_index');
  }

  /**
   * Creates a form to delete a Duty entity.
   *
   * @param Duty $duty The Duty entity
   *
   * @return \Symfony\Component\Form\Form The form
   */
  private function createDeleteForm(Duty $duty) {
    return $this->createFormBuilder()
                    ->setAction($this->generateUrl('zf_admin_duty_delete', array('id' => $duty->getId())))
                    ->setMethod('DELETE')
                    ->getForm()
    ;
  }

}
