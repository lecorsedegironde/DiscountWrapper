<?php

/**
 * Creator: @DopaSensei
 *
 * Creation Date: 07/12/2015
 * Creation Time: 23:13
 *
 * Last Update Date: 08/12/2015
 * Last Update Time: 00:23
 */
class DiscountWrapper
{
    //Private API Key supplied by CDiscount
    private $_key;

    public function __construct($key){
        $this->_key = $key;
    }

    //Get and decode the JSON file sent by the API through cURL. It doesn't uses SSL though.
    private function getCurlFile($paramArray, $apiUrl){
        $encodedJSON = json_encode($paramArray);
        $ch = curl_init($apiUrl);

        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $encodedJSON);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: '.strlen($encodedJSON)
        ));

        $res=curl_exec($ch);
        curl_close($ch);

        $answer = json_decode($res,true);
        return $answer;
    }

    //Search products by name.
    public function search($productName){
        $params = array(
            "ApiKey" => $this->_key,
            "SearchRequest" => array(
                "Keyword" => $productName,
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

        return json_decode(json_encode($this->getCurlFile($params,$relatedURL)),true);
    }

    //Use getProduct function with cDiscount private ID
    function getProductWithID($productID){

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

        return json_decode(json_encode($this->getCurlFile($params,$relatedURL)),true);
    }

    //Use getProduct function with product EAN
    function getProductWithEAN($productEAN){

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

        return json_decode(json_encode($this->getCurlFile($params,$relatedURL)),true);
    }

    //Creates an empty cart. Return the cart-created ID for future item add.
    function newCart(){

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
        $cartData = json_decode(json_encode($this->getCurlFile($params,$relatedURL)),true);

        return $cartData['CartGUID'];
    }

    //Returns cart details
    function cartDetails($cartGUID){
        $params = array(
            "ApiKey" => $this->_key,
            "CartRequest" => array(
                "CartGUID" => $cartGUID
            )
        );

        $relatedURL = "https://api.cdiscount.com/OpenApi/json/GetCart";
        return json_decode(json_encode($this->getCurlFile($params,$relatedURL)),true);
    }

    function addItemToCart(){

    }

}