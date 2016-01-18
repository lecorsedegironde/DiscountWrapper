<?php
/**
 * Creator: @lecorsedegironde
 *
 * Date: 17/01/2016
 * Time: 15:24
 */

namespace CDiscount;



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
     * @var true if the product os available for sale, false if not
     */
    private $_isAvailable;

    /**
     * @var string, URL to the product page on the cDiscount website
     */
    private $_productUrl;

    /**
     * @var Price, contain the price of the order and other details about it
     */
    private $_price;

    /**
     * @var Seller, informations about the seller
     */
    private $_seller;

    /**
     * @var Shipping array, these are shippings methods available for the offer
     */
    private $_shippings;

    /**
     * @var Size array, these are the product price per size, available only if there is multiple sizes for one
     * product, i.e., variant
     */
    private $_sizes;


    /**
     * Offer constructor.
     * @param $offer, the offer array
     */
    public function __construct($offer)
    {
        $this->_id = $offer["Id"];

        $this->_condition = $offer["Condition"];

        $this->_isAvailable = $offer["IsAvailable"];

        $this->_productUrl = $offer["ProductURL"];

        $this->_price = new Price($offer["SalePrice"], $offer["PriceDetails"]);

        $this->_seller = new Seller($offer["Seller"]);

        if ($offer['Shippings'] != null) {
            $this->_shippings = array();

            foreach($offer['Shippings'] as $shipping) {
                $ship = new Shipping($shipping);
                array_push($this->_shippings, $ship);
            }
        } else {
            $this->_shippings = null;
        }


        if ($offer['Sizes'] != null) {
            $this->_sizes = array();

            foreach($offer['Sizes'] as $size) {
                $siz = new Size($size);
                array_push($this->_sizes, $siz);
            }
        } else {
            $this->_sizes = null;
        }

    }

}