<?php

namespace Ztrint\Finance\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HomeController extends Controller {

  public function indexAction() {

    $wgtsvcs = $this->get('ztrint_finance_admin.config')->getWidgets();

    $widgets = [];
    foreach ($wgtsvcs as $k => $service) {
      $widgets [$k] = $this->get($service);
    }

    $em = $this->getDoctrine()->getManager();
    return $this->render('ZtrintFinanceAdminBundle:Home:index.html.twig', [
                'yourrates' => $em->getRepository('ZtrintFinanceAdminBundle:Currency')->findAll(),
                'widgets' => $widgets,
    ]);
  }

}
