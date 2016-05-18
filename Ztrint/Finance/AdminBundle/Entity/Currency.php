<?php

namespace Ztrint\Finance\AdminBundle\Entity;

use \Doctrine\Common\Collections\ArrayCollection;

/**
 * Currency
 */
class Currency {

  /** @var string  */
  private $id;

  /** @var string */
  private $valuebuy;

  /** @var string  */
  private $valuesell;

  /** @var string  */
  private $valuesell2;

  /** @var \Doctrine\Common\Collections\ArrayCollection */
  private $boxes;

  public function __construct() {
    $this->boxes = new ArrayCollection();
  }

  public function __toString() {
    return $this->id;
  }

  /** @return string */
  public function getId() {
    return $this->id;
  }

  public function setId($v) {
    $this->id = $v;
    return $this;
  }

  /**
   * @param string $valuebuy
   * @return Currency
   */
  public function setValuebuy($valuebuy) {
    $this->valuebuy = $valuebuy;
    return $this;
  }

  /**
   * @return string
   */
  public function getValuebuy() {
    return $this->valuebuy;
  }

  /** @return string */
  public function getValuesell() {
    return $this->valuesell;
  }

  /**
   * @param string $valuesell
   * @return Currency
   */
  public function setValuesell($valuesell) {
    $this->valuesell = $valuesell;
    return $this;
  }

  /**
   * @param string $valuesell2
   * @return Currency
   */
  public function setValuesell2($valuesell2) {
    $this->valuesell2 = $valuesell2;
    return $this;
  }

  /** @return string */
  public function getValuesell2() {
    return $this->valuesell2;
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

  /*
   * 
   * Computed
   * 
   */

  function totalizeIncomes() {
    $t = 0;
    foreach ($this->getBoxes() as $e) {
      if ($e->getType() == 'c') {
        $t+=$e->totalizeIncomes();
      }
    }
    return $t;
  }

  function totalizeOutcomes() {
    $t = 0;
    foreach ($this->getBoxes() as $e) {
      if ($e->getType() == 'c') {
        $t+=$e->totalizeOutcomes();
      }
    }
    return $t;
  }

  function totalizeIncomesValued() {
    $t = 0;
    foreach ($this->getBoxes() as $e) {
      if ($e->getType() == 'c') {
        $t+=$e->totalizeIncomesValued();
      }
    }
    return $t;
  }

  function totalizeOutcomesValued() {
    $t = 0;
    foreach ($this->getBoxes() as $e) {
      if ($e->getType() == 'c') {
        $t+=$e->totalizeOutcomesValued();
      }
    }
    return $t;
  }

  function getIosPriceWeighted() {
    $sum = 0;
    $sumprod = 0;
    foreach ($this->getBoxes() as $b) {
      foreach ($b->getIncomes() as $e) {
        $sumprod += $e->getPrice() * $e->getAmount();
        $sum += $e->getAmount();
      }
    }
    if ($sum !== 0) {
      return $sumprod / $sum;
    } else {
      return null;
    }
  }

}
