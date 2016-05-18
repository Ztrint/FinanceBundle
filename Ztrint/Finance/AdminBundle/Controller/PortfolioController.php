<?php

namespace Ztrint\Finance\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Ztrint\Finance\AdminBundle\Entity\Portfolio;
use Ztrint\Finance\AdminBundle\Form\PortfolioType;

/**
 * Portfolio controller.
 *
 */
class PortfolioController extends Controller
{
    /**
     * Lists all Portfolio entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $portfolios = $em->getRepository('ZtrintFinanceAdminBundle:Portfolio')->findAll();

        return $this->render('ZtrintFinanceAdminBundle:Portfolio:index.html.twig', array(
            'portfolios' => $portfolios,
        ));
    }

    /**
     * Creates a new Portfolio entity.
     *
     */
    public function newAction(Request $request)
    {
        $portfolio = new Portfolio();
        $form = $this->createForm('Ztrint\Finance\AdminBundle\Form\PortfolioType', $portfolio);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($portfolio);
            $em->flush();

            return $this->redirectToRoute('zf_admin_portfolio_show', array('id' => $portfolio->getId()));
        }

        return $this->render('ZtrintFinanceAdminBundle:Portfolio:new.html.twig', array(
            'portfolio' => $portfolio,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Portfolio entity.
     *
     */
    public function showAction(Portfolio $portfolio)
    {
        $deleteForm = $this->createDeleteForm($portfolio);

        return $this->render('ZtrintFinanceAdminBundle:Portfolio:show.html.twig', array(
            'portfolio' => $portfolio,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Portfolio entity.
     *
     */
    public function editAction(Request $request, Portfolio $portfolio)
    {
        $deleteForm = $this->createDeleteForm($portfolio);
        $editForm = $this->createForm('Ztrint\Finance\AdminBundle\Form\PortfolioType', $portfolio);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($portfolio);
            $em->flush();

            return $this->redirectToRoute('zf_admin_portfolio_edit', array('id' => $portfolio->getId()));
        }

        return $this->render('ZtrintFinanceAdminBundle:Portfolio:edit.html.twig', array(
            'portfolio' => $portfolio,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Portfolio entity.
     *
     */
    public function deleteAction(Request $request, Portfolio $portfolio)
    {
        $form = $this->createDeleteForm($portfolio);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($portfolio);
            $em->flush();
        }

        return $this->redirectToRoute('zf_admin_portfolio_index');
    }

    /**
     * Creates a form to delete a Portfolio entity.
     *
     * @param Portfolio $portfolio The Portfolio entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Portfolio $portfolio)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('zf_admin_portfolio_delete', array('id' => $portfolio->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
