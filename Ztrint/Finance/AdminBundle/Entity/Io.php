<?php

namespace Ztrint\Finance\AdminBundle\Entity;

class Io {

  /** @var integer */
  private $id;

  /** @var \DateTime */
  private $at;

  /** @var string */
  private $concept;

  /** @var string */
  private $amount;

  /** @var string */
  private $price;

  /** @var \Ztrint\Finance\AdminBundle\Entity\Cashbox  */
  private $source;

  /**  @var \Ztrint\Finance\AdminBundle\Entity\Cashbox */
  private $dest;

  /** @return integer */
  public function getId() {
    return $this->id;
  }

  /**
   * @param \DateTime $at
   * @return Io
   */
  public function setAt($at) {
    $this->at = $at;
    return $this;
  }

  /** @return \DateTime */
  public function getAt() {
    return $this->at;
  }

  /**
   * @param string $concept
   * @return Io
   */
  public function setConcept($concept) {
    $this->concept = $concept;
    return $this;
  }

  /** @return string */
  public function getConcept() {
    return $this->concept;
  }

  /**
   * @param string $amount
   * @return Io
   */
  public function setAmount($amount) {
    $this->amount = $amount;

    return $this;
  }

  /** @return string */
  public function getAmount() {
    return $this->amount;
  }

  /**
   * @param string $price
   * @return Io
   */
  public function setPrice($price) {
    $this->price = $price;
    return $this;
  }

  /** @return string  */
  public function getPrice() {
    return $this->price;
  }

  /**
   * @param \Ztrint\Finance\AdminBundle\Entity\Cashbox $source
   * @return Io
   */
  public function setSource(\Ztrint\Finance\AdminBundle\Entity\Cashbox $source = null) {
    $this->source = $source;

    return $this;
  }

  /** @return \Ztrint\Finance\AdminBundle\Entity\Cashbox */
  public function getSource() {
    return $this->source;
  }

  /**
   * @param \Ztrint\Finance\AdminBundle\Entity\Cashbox $dest
   * @return Io
   */
  public function setDest(\Ztrint\Finance\AdminBundle\Entity\Cashbox $dest = null) {
    $this->dest = $dest;
    return $this;
  }

  /** @return \Ztrint\Finance\AdminBundle\Entity\Cashbox */
  public function getDest() {
    return $this->dest;
  }

}
