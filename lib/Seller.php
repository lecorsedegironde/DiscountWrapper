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

    private $_id;
    private $_name;

    /**
     * Seller constructor.
     * @param $seller
     */
    public function __construct($seller)
    {
        $this->_id = $seller["Id"];
        $this->_name = $seller["Name"];
    }

    /**
     * @return mixed, the Id of the cDiscount seller
     */
    public function getId()
    {
        return $this->_id;
    }

    /**
     * @return mixed, the name of the cDiscount seller
     */
    public function getName()
    {
        return $this->_name;
    }
}