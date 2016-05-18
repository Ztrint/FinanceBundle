<?php

namespace Ztrint\Finance\AdminBundle\Entity;

/**
 * Portfolio
 */
class Portfolio {

  /** @var integer */
  private $id;

  /** @var \DateTime */
  private $start;

  /** @var \DateTime */
  private $end;

  /** @var string */
  private $currency;

  /** @var string */
  private $deposit;

  /** @var string */
  private $anr;

  /** @var string */
  private $cert;

  /** @return integer */
  public function getId() {
    return $this->id;
  }

  /**
   * @param \DateTime $start
   * @return Portfolio
   */
  public function setStart($start) {
    $this->start = $start;
    return $this;
  }

  /** @return \DateTime */
  public function getStart() {
    return $this->start;
  }

  /**
   * @param \DateTime $end
   * @return Portfolio
   */
  public function setEnd($end) {
    $this->end = $end;
    return $this;
  }

  /** @return \DateTime */
  public function getEnd() {
    return $this->end;
  }

  /**
   * @param string $currency
   * @return Portfolio
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
   * @param string $deposit
   * @return Portfolio
   */
  public function setDeposit($deposit) {
    $this->deposit = $deposit;
    return $this;
  }

  /** @return string */
  public function getDeposit() {
    return $this->deposit;
  }

  /**
   * @param string $anr
   * @return Portfolio
   */
  public function setAnr($anr) {
    $this->anr = $anr;
    return $this;
  }

  /** @return string */
  public function getAnr() {
    return $this->anr;
  }

  /**
   * @param string $cert
   * @return Portfolio
   */
  public function setCert($cert) {
    $this->cert = $cert;
    return $this;
  }

  /** @return string */
  public function getCert() {
    return $this->cert;
  }

}
