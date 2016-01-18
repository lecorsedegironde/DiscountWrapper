<?php

namespace CDiscount;

/**
 * Creator : @lecorsedegironde
 *
 * Date: 17/01/2016
 * Time: 14:33
 */

class Product
{
    /**
     * @var string, cDiscount unique product identifier
     */
    private $_id;

    /**
     * @var string, cDiscount product name
     */
    private $_name;

    /**
     * @var string, cDiscount product description
     */
    private $_description;

    /**
     * @var string, cDiscount product EAN
     */
    private $_ean;

    /**
     * @var string, cDiscount product brand
     */
    private $_brand;

    /**
     * @var string, cDiscount product main image URL
     */
    private $_mainImageUrl;

    /**
     * @var number, cDiscount product rating, this is a value between 0 and 5
     */
    private $_rating;

    /**
     * @var number of offers available for this cDiscount product, null if is not available, i.e., out of stock
     */
    private $_offersCount;

    /**
     * @var Offer, return the best offer for this product
     */
    private $_bestOffer;

    /**
     * @var Image array, contains the product pictures
     */
    private $_images;

    /**
     * @var Offer array, all available offer for this product, maximum number of offers retrieved is 6,
     * only available if Scope.Offers set to true in the query
     */
    private $_offers;

    /**
     * @var Product array, contains associated products, only available if Scope.AssociatedProduct set to true
     * in the query
     */
    private $_associatedProducts;

    /**
     * Product constructor.
     * @param $product , the product array
     */
    public function __construct($product)
    {
        $this->_id = $product["Id"];

        $this->_name = $product["Name"];

        $this->_description = $product["Description"];

        $this->_ean = $product["Ean"];

        $this->_brand = $product["Brand"];

        $this->_mainImageUrl = $product["MainImageUrl"];

        $this->_rating = $product["Rating"];

        $this->_offersCount = $product["OffersCount"];

        $this->_bestOffer = new Offer($product["BestOffer"]);

        if ($product["Images"] != null) {
            $this->_images = array();
            foreach($product["Images"] as $image) {
                $img = new Image($image);
                array_push($this->_images, $img);
            }
        } else {
            $this->_images = null;
        }

        if ($product["Offers"] != null) {
            $this->_offers = array();
            foreach ($product["Offers"] as $offer) {
                $off = new Offer($offer);
                array_push($this->_offers, $off);
            }
        } else {
            $this->_offers = null;
        }

        if ($product["AssociatedProducts"] != null) {
            $this->_associatedProducts = array();
            foreach ($product["AssociatedProducts"] as $associatedProduct) {
                $prod = new Product($associatedProduct);
                array_push($this->_associatedProducts, $prod);
            }
        } else {
            $this->_associatedProducts = null;
        }
    }

    /**
     * @return string, cDiscount product Id
     */
    public function getId()
    {
        return $this->_id;
    }

    /**
     * @return string, cDiscount product name
     */
    public function getName()
    {
        return $this->_name;
    }

    /**
     * @return string, cDiscount product description
     */
    public function getDescription()
    {
        return $this->_description;
    }

    /**
     * @return string, cDiscount product EAN
     */
    public function getEan()
    {
        return $this->_ean;
    }

    /**
     * @return string, cDiscount product Brand
     */
    public function getBrand()
    {
        return $this->_brand;
    }

    /**
     * @return string, cDiscount product main image URL
     */
    public function getMainImageUrl()
    {
        return $this->_mainImageUrl;
    }

    /**
     * @return number, cDiscount product rating
     */
    public function getRating()
    {
        return $this->_rating;
    }

    /**
     * @return number of offers available for this cDiscount product|null
     */
    public function getOffersCount()
    {
        return $this->_offersCount;
    }

    /**
     * @return Offer, return the best offer for this product
     */
    public function getBestOffer()
    {
        return $this->_bestOffer;
    }

    /**
     * @return Image array, contains the product pictures|null if there are no images
     */
    public function getImages()
    {
        return $this->_images;
    }

    /**
     * @return Offer array, all available offer for this product, max 6|null if Scope.Offers set to false in the
     * query or if no offers
     */
    public function getOffers()
    {
        return $this->_offers;
    }

    /**
     * @return Product array, contains associated products|null if Scope.AssociatedProduct set to false in the
     * query or if no associated products
     */
    public function getAssociatedProducts()
    {
        return $this->_associatedProducts;
    }
}