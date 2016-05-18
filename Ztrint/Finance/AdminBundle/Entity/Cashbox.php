<?php

namespace Ztrint\Finance\AdminBundle\Entity;

use \Doctrine\Common\Collections\ArrayCollection;

class Cashbox {

  /** @var integer */
  private $id;

  /** @var string */
  private $name;

  /** @var string */
  private $type;

  /** @var string */
  private $currency;

  /** @var string */
  private $cashgroup;

  /** @var \Doctrine\Common\Collections\ArrayCollection */
  private $incomes;

  /** @var \Doctrine\Common\Collections\ArrayCollection */
  private $outcomes;

  public function __construct() {
    $this->incomes = new ArrayCollection();
    $this->outcomes = new ArrayCollection();
  }

  public function __toString() {
    return $this->currency->getId() . ' - ' . $this->cashgroup->getId() . ' - ' . $this->name;
  }

  /** @return integer */
  public function getId() {
    return $this->id;
  }

  /**
   * @param string $name
   * @return Cashbox
   */
  public function setName($name) {
    $this->name = $name;
    return $this;
  }

  /** @return string  */
  public function getName() {
    return $this->name;
  }

  /**
   * @param string $v
   * @return Cashbox
   */
  public function setType($v) {
    $this->type = $v;
    return $this;
  }

  /** @return string  */
  public function getType() {
    return $this->type;
  }

  /**
   * @param string $currency
   * @return Cashbox
   */
  public function setCurrency($currency) {
    $this->currency = $currency;
    return $this;
  }

  /** @return string */
  public function getCurrency() {
    return $this->currency;
  }

  /**
   * @param string $v
   * @return Cashbox
   */
  public function setCashgroup($v) {
    $this->cashgroup = $v;
    return $this;
  }

  /** @return string */
  public function getCashgroup() {
    return $this->cashgroup;
  }

  /**
   * @return Cashbox
   */
  function setIncomes(ArrayCollection $incomes) {
    $this->incomes = $incomes;
    return $this;
  }

  /** @return \Doctrine\Common\Collections\ArrayCollection */
  function getIncomes() {
    return $this->incomes;
  }

  /** @return Cashbox */
  function setOutcomes(ArrayCollection $outcomes) {
    $this->outcomes = $outcomes;
    return $this;
  }

  /** @return \Doctrine\Common\Collections\ArrayCollection */
  function getOutcomes() {
    return $this->outcomes;
  }

  protected function totalizeIos($ios) {
    $tot = 0;
    foreach ($ios as $e) {
      $tot+=$e->getAmount();
    }
    return $tot;
  }

  protected function totalizeIosValued($ios) {
    $tot = 0;
    foreach ($ios as $e) {
      $tot += $e->getAmount() / $e->getPrice();
    }
    return $tot;
  }

  function totalizeIncomes() {
    return $this->totalizeIos($this->incomes);
  }

  function totalizeOutcomes() {
    return $this->totalizeIos($this->outcomes);
  }

  function totalizeIncomesValued() {
    return $this->totalizeIosValued($this->incomes);
  }

  function totalizeOutcomesValued() {
    return $this->totalizeIosValued($this->outcomes);
  }

  function getIosPriceAvg() {
    $sum = 0;
    foreach ($this->incomes as $e) {
      $sum += $e->getPrice();
    }
    $c = $this->incomes->count();
    if ($c !== 0) {
      return $sum / $c;
    } else {
      return null;
    }
  }

  function getIosPriceWeighted() {
    $sum = 0;
    $sumprod = 0;
    foreach ($this->incomes as $e) {
      $sumprod += $e->getPrice() * $e->getAmount();
      $sum += $e->getAmount();
    }
    if ($sum !== 0) {
      return $sumprod / $sum;
    } else {
      return null;
    }
  }

  function getIosPriceMin() {
    $min = 9999;
    foreach ($this->incomes as $e) {
      if ($e->getPrice() < $min) {
        $min = $e->getPrice();
      }
    }
    return $min;
  }

  function getIosPriceMax() {
    $max = 0;
    foreach ($this->incomes as $e) {
      if ($e->getPrice() > $max) {
        $max = $e->getPrice();
      }
    }
    return $max;
  }

}
