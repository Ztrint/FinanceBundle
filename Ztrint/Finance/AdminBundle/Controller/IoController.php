<?php

namespace Ztrint\Finance\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Ztrint\Finance\AdminBundle\Entity\Io;
use Ztrint\Finance\AdminBundle\Form\IoType;

/**
 * Io controller.
 *
 */
class IoController extends Controller {

  /**
   * Lists all Io entities.
   *
   */
  public function indexAction() {
    $em = $this->getDoctrine()->getManager();

    $ios = $em->getRepository('ZtrintFinanceAdminBundle:Io')->findBy([], ['at' => 'DESC']);

    return $this->render('ZtrintFinanceAdminBundle:Io:index.html.twig', array(
                'ios' => $ios,
    ));
  }

  public function newAction(Request $request) {
    $io = new Io();
    //$io->setAt(\DateTime::createFromFormat('d/m/Y', '01/01/2015'));
    $io->setAt(new \DateTime());
    $form = $this->createForm('Ztrint\Finance\AdminBundle\Form\IoType', $io);
    $form->handleRequest($request);

    $em = $this->getDoctrine()->getManager();

    if ($form->isSubmitted() && $form->isValid()) {
      $em->persist($io);
      $em->flush();

      return $this->redirectToRoute('zf_admin_io_index');
    }

    return $this->render('ZtrintFinanceAdminBundle:Io:new.html.twig', array(
                'io' => $io,
                'form' => $form->createView(),
                'concepts' => $em->getRepository('ZtrintFinanceAdminBundle:Io')->createQueryBuilder('c')->select('c.concept')->distinct()->getQuery()->getResult(),
    ));
  }

  public function showAction(Io $io) {
    $deleteForm = $this->createDeleteForm($io);

    return $this->render('ZtrintFinanceAdminBundle:Io:show.html.twig', array(
                'io' => $io,
                'delete_form' => $deleteForm->createView(),
    ));
  }

  public function editAction(Request $request, Io $io) {
    $deleteForm = $this->createDeleteForm($io);
    $editForm = $this->createForm('Ztrint\Finance\AdminBundle\Form\IoType', $io);
    $editForm->handleRequest($request);

    if ($editForm->isSubmitted() && $editForm->isValid()) {
      $em = $this->getDoctrine()->getManager();
      $em->persist($io);
      $em->flush();

      return $this->redirectToRoute('zf_admin_io_index');
    }

    return $this->render('ZtrintFinanceAdminBundle:Io:edit.html.twig', array(
                'io' => $io,
                'edit_form' => $editForm->createView(),
                'delete_form' => $deleteForm->createView(),
    ));
  }

  /**
   * Deletes a Io entity.
   *
   */
  public function deleteAction(Request $request, Io $io) {
    $form = $this->createDeleteForm($io);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
      $em = $this->getDoctrine()->getManager();
      $em->remove($io);
      $em->flush();
    }

    return $this->redirectToRoute('zf_admin_io_index');
  }

  /**
   * Creates a form to delete a Io entity.
   *
   * @param Io $io The Io entity
   *
   * @return \Symfony\Component\Form\Form The form
   */
  private function createDeleteForm(Io $io) {
    return $this->createFormBuilder()
                    ->setAction($this->generateUrl('zf_admin_io_delete', array('id' => $io->getId())))
                    ->setMethod('DELETE')
                    ->getForm()
    ;
  }

}
