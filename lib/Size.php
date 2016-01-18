<?php
/**
 * Creator: @lecorsedegironde
 *
 * Date: 18/01/2016
 * Time: 20:24
 */

namespace CDiscount;


class Size
{
    /**
     * @var string, the id of the size
     */
    private $_id;

    /**
     * @var string, the name of the size, e.g., 32/30, 34/30, ...
     */
    private $_name;

    /**
     * @var number, the sale price in euros
     */
    private $_salePrice;

    /**
     * @var boolean, says if the size is available
     */
    private $_available;

    /**
     * Size constructor.
     * @param $size , the size array
     */
    public function __construct($size)
    {
        $this->_id = $size["Id"];

        $this->_name = $size["Name"];

        $this->_salePrice = $size["SalePrice"];

        $this->_available = $size["IsAvailable"];
    }

    /**
     * @return string, the id of the size
     */
    public function getId()
    {
        return $this->_id;
    }

    /**
     * @return string, the name of the size
     */
    public function getName()
    {
        return $this->_name;
    }

    /**
     * @return number, the price of the size
     */
    public function getSalePrice()
    {
        return $this->_salePrice;
    }

    /**
     * @return boolean, true if the size is available, false if the size isn't available
     */
    public function isAvailable()
    {
        return $this->_available;
    }
}