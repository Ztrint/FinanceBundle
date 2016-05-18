<?php

/**
 * @author Nicolas Castro <ncastro@ztrint.com>
 */

namespace Ztrint\Finance\AdminBundle\Service;

use Symfony\Component\DependencyInjection\ContainerInterface;

class Config {

  /** @var ContainerInterface */
  protected $vars;

  public function __construct() {
    
  }

  public function setConfig($vars) {
    $this->vars = $vars;
  }

  public function getWidgets() {
    return $this->vars['widgets'];
  }

}
