<?php
/**
 * Creator @lecorsedegironde
 *
 * Date: 18/01/2016
 * Time: 20:07
 */

namespace CDiscount;


use DateTime;

class Shipping
{
    /**
     * @var string, the name of the shipping option
     */
    private $_name;

    /**
     * @var number, the price of the shipping option
     */
    private $_price;

    /**
     * @var string, the delay, displayed in french, within the product is shipped
     */
    private $_displayDelay;

    /**
     * @var DateTime, the minimal delivery date
     */
    private $_minDeliveryDate;

    /**
     * @var DateTime, the maximal delivery date
     */
    private $_maxDeliveryDate;

    /**
     * Shipping constructor.
     * @param $shipping, the shipping array
     */
    public function __construct($shipping)
    {
        $this->_name = $shipping['Name'];
        $this->_price = $shipping['Price'];

        $this->_displayDelay = $shipping['DelayToDisplay'];

        $this->_minDeliveryDate = new DateTime($shipping['MinDeliveryDate']);
        $this->_maxDeliveryDate = new DateTime($shipping['MaxDeliveryDate']);
    }

    /**
     * @return string, name of the shipping option
     */
    public function getName()
    {
        return $this->_name;
    }

    /**
     * @return number, price of the shipping option
     */
    public function getPrice()
    {
        return $this->_price;
    }

    /**
     * @return string, the delay displayed before the shipping (french)
     */
    public function getDisplayDelay()
    {
        return $this->_displayDelay;
    }

    /**
     * @return DateTime, the minimum delivery date
     */
    public function getMinDeliveryDate()
    {
        return $this->_minDeliveryDate;
    }

    /**
     * @return DateTime, the maximum delivery date
     */
    public function getMaxDeliveryDate()
    {
        return $this->_maxDeliveryDate;
    }

}