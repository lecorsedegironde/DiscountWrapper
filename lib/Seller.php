<?php
/**
 * Creator: @lecorsedegironde
 *
 * Date: 17/01/2016
 * Time: 15:38
 */

namespace CDiscount;


class Seller
{

    /**
     * @var string, the id of the cDiscount seller
     */
    private $_id;

    /**
     * @var string, the name of the cDiscount seller
     */
    private $_name;

    /**
     * Seller constructor.
     * @param $seller , the seller array
     */
    public function __construct($seller)
    {
        $this->_id = $seller["Id"];
        $this->_name = $seller["Name"];
    }

    /**
     * @return string, the Id of the cDiscount seller
     */
    public function getId()
    {
        return $this->_id;
    }

    /**
     * @return string, the name of the cDiscount seller
     */
    public function getName()
    {
        return $this->_name;
    }
}