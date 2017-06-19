<?php
/**
 * Creator: @lecorsedegironde
 *
 * DiscountWrapper main class
 */
namespace CDiscount;

require ("Product.php");

class DiscountWrapper
{
    //Private API Key supplied by CDiscount
    private $_key;

    /**
     * DiscountWrapper constructor
     * @param $key , CDiscount API Key
     */
    public function __construct($key)
    {
        $this->_key = $key;
    }

    /**
     * Get and decode JSON file sent by the API through cURL.
     * Doesn't use SSL
     *
     * @param $paramArray array, filled by the API needed parameters
     * @param $apiUrl string, the API URL
     * @return mixed the JSON returned by the API
     */
    private function getCurlFile($paramArray, $apiUrl)
    {
        $encodedJSON = json_encode($paramArray);
        $ch = curl_init($apiUrl);

        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $encodedJSON);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($encodedJSON)
        ));

        $res = curl_exec($ch);
        curl_close($ch);

        $answer = json_decode($res, true);
        return $answer;
    }

    //Search products by name.$
    /**
     * Search into CDiscount product database by a keyword
     * @param $keyword string, the keyword
     * @return array containing products objects
     */
    //TODO Add missing hardcoded fields
    public function search($keyword)
    {
        $params = array(
            "ApiKey" => $this->_key,
            "SearchRequest" => array(
                "Keyword" => $keyword,
                "SortBy" => "relevance",
                "Pagination" => array(
                    "ItemsPerPage" => 10,
                    "PageNumber" => 0
                ),
                "Filters" => array(
                    "Price" => array(
                        "Min" => 0,
                        "Max" => 400
                    ),
                    "Navigation" => "all",
                    "IncludeMarketPlace" => true,
                    "Condition" => "new"
                )
            ),
        );

        $relatedURL = "https://api.cdiscount.com/OpenApi/json/Search";

        $answer = json_decode(json_encode($this->getCurlFile($params, $relatedURL)), true);
        $products = array();

        foreach ($answer["Products"] as $p) {
            array_push($products, new Product($p));
        }

        return $products;
    }

    //Use getProduct function with cDiscount private ID
    function getProductWithID($productID)
    {

        $params = array(
            "ApiKey" => $this->_key,
            "ProductRequest" => array(
                "ProductIdList" => $productID,
                "Scope" => array(
                    "Offers" => true,
                    "AssociatedProducts" => false,
                    "Images" => true,
                    "Ean" => true
                )
            ),
        );

        $relatedURL = "https://api.cdiscount.com/OpenApi/json/GetProduct";

        $answer = json_decode(json_encode($this->getCurlFile($params, $relatedURL)), true);
        $product = array();
        array_push($product, new Product(reset($answer["Products"])));

        return $product;
    }

    //Use getProduct function with product EAN
    function getProductWithEAN($productEAN)
    {

        $params = array(
            "ApiKey" => $this->_key,
            "ProductRequest" => array(
                "EANList" => $productEAN,
                "Scope" => array(
                    "Offers" => true,
                    "AssociatedProducts" => false,
                    "Images" => true,
                    "Ean" => true
                )
            ),
        );

        $relatedURL = "https://api.cdiscount.com/OpenApi/json/GetProduct";

        return json_decode(json_encode($this->getCurlFile($params, $relatedURL)), true);
    }

    //Creates an empty cart. Return the cart-created ID for future item add.
    function newCart()
    {

        $params = array(
            "ApiKey" => $this->_key,
            "PushToCartRequest" => array(
                "OfferId" => "fincpangfirrnoir",
                "ProductId" => "fincpangfirrnoir",
                "Quantity" => 0,
                "SellerId" => "0"
            )
        );

        $relatedURL = "https://api.cdiscount.com/OpenApi/json/PushToCart";
        $cartData = json_decode(json_encode($this->getCurlFile($params, $relatedURL)), true);

        return $cartData['CartGUID'];
    }

    //Returns cart details
    function cartDetails($cartGUID)
    {
        $params = array(
            "ApiKey" => $this->_key,
            "CartRequest" => array(
                "CartGUID" => $cartGUID
            )
        );

        $relatedURL = "https://api.cdiscount.com/OpenApi/json/GetCart";
        return json_decode(json_encode($this->getCurlFile($params, $relatedURL)), true);
    }

    //Add a defined quantity of a defined offer about a defined product to a defined cart
    function addItemToCart($cartGUID, $offerID, $productID, $productQty)
    {

        $relatedProduct = $this->getProductWithID($productID);
        $sellerID = $relatedProduct['Products'][0]['BestOffer']['Seller']['Id'];

        $params = array(
            "ApiKey" => $this->_key,
            "PushToCartRequest" => array(
                "CartGUID" => $cartGUID,
                "OfferId" => $offerID,
                "ProductId" => $productID,
                "Quantity" => $productQty,
                "SellerId" => $sellerID
            )
        );

        $relatedURL = "https://api.cdiscount.com/OpenApi/json/PushToCart";
        $cartData = json_decode(json_encode($this->getCurlFile($params, $relatedURL)), true);
        return $cartData['ErrorType'];
    }
}