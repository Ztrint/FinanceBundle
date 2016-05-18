<?php

namespace Ztrint\Finance\AdminBundle\Entity;

use \Doctrine\Common\Collections\ArrayCollection;

class Cashgroup {

  /** @var integer */
  private $id;

  /** @var string */
  private $name;

  /** @var \Doctrine\Common\Collections\ArrayCollection */
  private $boxes;

  public function __construct() {
    $this->boxes = new ArrayCollection();
  }

  /** @return string */
  public function getId() {
    return $this->id;
  }

  /**
   * @param string $v
   * @return Cashgroup
   */
  public function setId($v) {
    $this->id = $v;
    return $this;
  }

  /**
   * @param string $name
   * @return Cashgroup
   */
  public function setName($name) {
    $this->name = $name;
    return $this;
  }

  /** @return string  */
  public function getName() {
    return $this->name;
  }

  public function __toString() {
    return $this->id . ' - ' . $this->name;
  }

  /** @return Cashgroup */
  function setBoxes(ArrayCollection $v) {
    $this->boxes = $v;
    return $this;
  }

  /** @return \Doctrine\Common\Collections\ArrayCollection */
  function getBoxes() {
    return $this->boxes;
  }

  function getBoxesByCurrency($cur) {
    $boxes = [];
    foreach ($this->boxes as $e) {
      if ($e->getCurrency() == $cur) {
        array_push($boxes, $e);
      }
    }
    return $boxes;
  }

  function totalizeIncomes() {
    $boxes = $this->getBoxes();
    $tot = 0;
    foreach ($boxes as $e) {
      if ($e->getType() == 'c') {
        $tot+=$e->totalizeIncomes();
      }
    }
    return $tot;
  }

  function totalizeOutcomes() {
    $boxes = $this->getBoxes();
    $tot = 0;
    foreach ($boxes as $e) {
      if ($e->getType() == 'c') {
        $tot+=$e->totalizeOutcomes();
      }
    }
    return $tot;
  }

  function totalizeIncomesValuedToSell1() {
    $boxes = $this->getBoxes();
    $tot = 0;
    foreach ($boxes as $e) {
      if ($e->getType() == 'c') {
        $tot+=$e->totalizeIncomesValued() * $e->getCurrency()->getValueSell();
      }
    }
    return $tot;
  }

  function totalizeOutcomesValuedToSell1() {
    $boxes = $this->getBoxes();
    $tot = 0;
    foreach ($boxes as $e) {
      if ($e->getType() == 'c') {
        $tot+=$e->totalizeOutcomesValued() * $e->getCurrency()->getValueSell();
      }
    }
    return $tot;
  }

  function totalizeIncomesValuedToSell2() {
    $boxes = $this->getBoxes();
    $tot = 0;
    foreach ($boxes as $e) {
      if ($e->getType() == 'c') {
        $tot+=$e->totalizeIncomesValued() * $e->getCurrency()->getValueSell2();
      }
    }
    return $tot;
  }

  function totalizeOutcomesValuedToSell2() {
    $boxes = $this->getBoxes();
    $tot = 0;
    foreach ($boxes as $e) {
      if ($e->getType() == 'c') {
        $tot+=$e->totalizeOutcomesValued() * $e->getCurrency()->getValueSell2();
      }
    }
    return $tot;
  }

  function totalizeIncomesValuedByCurrency($cur) {
    $boxes = $this->getBoxesByCurrency($cur);
    $tot = 0;
    foreach ($boxes as $e) {
      if ($e->getType() == 'c') {
        $tot+=$e->totalizeIncomesValued();
      }
    }
    return $tot;
  }

  function totalizeOutcomesValuedByCurrency($cur) {
    $boxes = $this->getBoxesByCurrency($cur);
    $tot = 0;
    foreach ($boxes as $e) {
      if ($e->getType() == 'c') {
        $tot+=$e->totalizeOutcomesValued();
      }
    }
    return $tot;
  }

}
