<?php

namespace Ztrint\Finance\AdminBundle\Entity;

/**
 * Duty
 */
class Duty
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var \DateTime
     */
    private $at;

    /**
     * @var string
     */
    private $amount;

    /**
     * @var string
     */
    private $price;

    /**
     * @var string
     */
    private $tax;

    /**
     * @var string
     */
    private $concept;

    /**
     * @var \Ztrint\Finance\AdminBundle\Entity\Currency
     */
    private $currency;


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set at
     *
     * @param \DateTime $at
     *
     * @return Duty
     */
    public function setAt($at)
    {
        $this->at = $at;

        return $this;
    }

    /**
     * Get at
     *
     * @return \DateTime
     */
    public function getAt()
    {
        return $this->at;
    }

    /**
     * Set amount
     *
     * @param string $amount
     *
     * @return Duty
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * Get amount
     *
     * @return string
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * Set price
     *
     * @param string $price
     *
     * @return Duty
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return string
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set tax
     *
     * @param string $tax
     *
     * @return Duty
     */
    public function setTax($tax)
    {
        $this->tax = $tax;

        return $this;
    }

    /**
     * Get tax
     *
     * @return string
     */
    public function getTax()
    {
        return $this->tax;
    }

    /**
     * Set concept
     *
     * @param string $concept
     *
     * @return Duty
     */
    public function setConcept($concept)
    {
        $this->concept = $concept;

        return $this;
    }

    /**
     * Get concept
     *
     * @return string
     */
    public function getConcept()
    {
        return $this->concept;
    }

    /**
     * Set currency
     *
     * @param \Ztrint\Finance\AdminBundle\Entity\Currency $currency
     *
     * @return Duty
     */
    public function setCurrency(\Ztrint\Finance\AdminBundle\Entity\Currency $currency = null)
    {
        $this->currency = $currency;

        return $this;
    }

    /**
     * Get currency
     *
     * @return \Ztrint\Finance\AdminBundle\Entity\Currency
     */
    public function getCurrency()
    {
        return $this->currency;
    }
}
