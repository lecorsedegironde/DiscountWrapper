<?php
/**
 * Creator: @lecorsedegironde
 *
 * Date: 17/01/2016
 * Time: 15:42
 */

namespace CDiscount;


use DateTime;

class Price
{
    /**
     * @var number, the price displayed by the offer
     */
    private $_salePrice;

    /**
     * @var number, the reference price if there IS a discount, might be 0, might also be 0 even if there is a discount
     */
    private $_referencePrice;

    /**
     * @var boolean, true if there is a saving, false if not
     */
    private $_saving;

    /**
     * @var string, the type of saving, e.g., amount, percentage
     */
    private $_savingType;

    /**
     * @var mixed, the value saved
     */
    private $_savingValue;

    /**
     * @var boolean, true if there is a discount, false id not
     */
    private $_discount;

    /**
     * @var string, the type of the discount, e.g. Flash sales,...
     */
    private $_discountType;

    /**
     * @var DateTime, the start date of the discount format : Y-m-d:H:m:s
     */
    private $_discountStartDate;

    /**
     * @var DateTime, the end date of the discount
     */
    private $_discountEndDate;

    /**
     * Price constructor.
     * @param $salePrice, the price of the product
     * @param $priceDetails, the array of price details
     */
    public function __construct($salePrice, $priceDetails)
    {
        $this->_salePrice = $salePrice;

        $this->_referencePrice = $priceDetails["ReferencePrice"];

        if ($priceDetails["Discount"] != null) {

            $this->_discount = true;
            $this->_discountType = $priceDetails["Discount"]["Type"];

            //Date
            $this->_discountStartDate = new DateTime($priceDetails["Discount"]["StartDate"]);
            $this->_discountEndDate = new DateTime($priceDetails["Discount"]["EndDate"]);

        } else {
            $this->_discount = false;

            $this->_discountType = null;
            $this->_discountStartDate = null;
            $this->_discountEndDate = null;
        }

        if ($priceDetails["Saving"] != null) {
            $this->_saving = true;

            $this->_savingType = $priceDetails["Saving"]["Type"];

            $this->_savingValue = $priceDetails["Saving"]["Value"];
        } else {
            $this->_saving = false;

            $this->_savingType = null;
            $this->_savingValue = null;
        }
    }

    /**
     * @return number, the sale price
     */
    public function getSalePrice()
    {
        return $this->_salePrice;
    }

    /**
     * @return number, the reference price, might be 0
     */
    public function getReferencePrice()
    {
        return $this->_referencePrice;
    }

    /**
     * @return boolean, true if there is a discount, false if not
     */
    public function isDiscount()
    {
        return $this->_discount;
    }

    /**
     * @return string, the type of the discount|null if there isn't a discount
     */
    public function getDiscountType()
    {
        return $this->_discountType;
    }

    /**
     * @return DateTime, the start date of the discount, format Y-m-d:H:m:s|null if there isn't a saving
     */
    public function getDiscountStartDate()
    {
        return $this->_discountStartDate;
    }

    /**
     * @return DateTime, the end date of the discount, format Y-m-d:H:m:s|null if there isn't a saving
     */
    public function getDiscountEndDate()
    {
        return $this->_discountEndDate;
    }

    /**
     * @return boolean, if there is a saving, false if not
     */
    public function isSaving()
    {
        return $this->_saving;
    }

    /**
     * @return string, the type of the saving|null if there isn't a saving
     */
    public function getSavingType()
    {
        return $this->_savingType;
    }

    /**
     * @return mixed, the value of the saving|null if there isn't a saving
     */
    public function getSavingValue()
    {
        return $this->_savingValue;
    }
}