# DiscountWrapper
A simple PHP wrapper for the cDiscount Open API

By @DopaSensei modified and extended by @lecorsedegironde

**By now, this version is not suitable for a simple use as it is not finished and not reviewed** 

What is simply working with classes : 
- Product and all his derivatives : 
    - Offer
    - Price
    - Seller
    - Shipping
    - Size
   
For these you will have to deal with PHP Array : 
- Search
- Get a product
- Cart management
    
If you want to use it for now you will have to : **Note this will only works with an API query that returns an array with the field "Products" in it**
- include libWrapper/DiscountWrapper.php
- include lib/Product.php or other class you will be using
- instantiate new DiscountWrapper class with your API key : `$dW = new DiscountWrapper($API_Key);`
- make your getProduct or search query : `$search = $dW->search($productName);`
- create an array for the return products : `$product = array();`
- got the returns product in an array : 
    `foreach ($search["Products"] as $p) {
        array_push($product, new Product($p));
    }`