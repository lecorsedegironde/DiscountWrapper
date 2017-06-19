<?php
/**
 * Creator: @lecorsedegironde
 *
 * Date: 17/01/2016
 * Time: 15:24
 */

namespace CDiscount;

require("Price.php");
require("Seller.php");
require("Shipping.php");
require("Size.php");

class Offer
{
    /**
     * @var string, cDiscount offer identifier
     */
    private $_id;

    /**
     * @var string, the condition for the object, new or used
     */
    private $_condition;

    /**
     * @var boolean, true if the product os available for sale, false if not
     */
    private $_available;

    /**
     * @var string, URL to the product page on the cDiscount website
     */
    private $_productUrl;

    /**
     * @var Price, contain the price of the order and other details about it
     */
    private $_price;

    /**
     * @var Seller, information about the seller
     */
    private $_seller;

    /**
     * @var Shipping array, these are shipping methods available for the offer
     */
    private $_shipping;

    /**
     * @var Size array, these are the product price per size, available only if there is multiple sizes for one
     * product, i.e., variant
     */
    private $_sizes;


    /**
     * Offer constructor.
     * @param $offer , the offer array
     */
    public function __construct($offer)
    {
        $this->_id = $offer["Id"];

        $this->_condition = $offer["Condition"];

        $this->_available = $offer["IsAvailable"];

        $this->_productUrl = $offer["ProductURL"];

        $this->_price = new Price($offer["SalePrice"], $offer["PriceDetails"]);

        $this->_seller = new Seller($offer["Seller"]);

        if ($offer["Shippings"] != null) {
            $this->_shipping = array();

            foreach ($offer["Shippings"] as $shipping) {
                $ship = new Shipping($shipping);
                array_push($this->_shipping, $ship);
            }
        } else {
            $this->_shipping = null;
        }


        if ($offer["Sizes"] != null) {
            $this->_sizes = array();

            foreach ($offer["Sizes"] as $size) {
                $siz = new Size($size);
                array_push($this->_sizes, $siz);
            }
        } else {
            $this->_sizes = null;
        }

    }

    /**
     * @return string, the id of the offer
     */
    public function getId()
    {
        return $this->_id;
    }

    /**
     * @return string, the condition of the offer
     */
    public function getCondition()
    {
        return $this->_condition;
    }

    /**
     * @return boolean, true if the offer is available, false if not
     */
    public function isAvailable()
    {
        return $this->_available;
    }

    /**
     * @return string, the product page url
     */
    public function getProductUrl()
    {
        return $this->_productUrl;
    }

    /**
     * @return Price, price and details about the offer
     */
    public function getPrice()
    {
        return $this->_price;
    }

    /**
     * @return Seller, the seller of the offer
     */
    public function getSeller()
    {
        return $this->_seller;
    }

    /**
     * @return Shipping array if there are shipping info|null if not
     */
    public function getShipping()
    {
        return $this->_shipping;
    }

    /**
     * @return Size array if there are different sizes|null if not
     */
    public function getSizes()
    {
        return $this->_sizes;
    }
}