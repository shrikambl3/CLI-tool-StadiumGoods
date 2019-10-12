<?php
/*
 * Author: Shrikant K
 * Date Completed: 10/11/2019
 *
 * Some sample test urls
 * Success
 *  url - https://www.stadiumgoods.com/nike
 * Error
 *  Die with 404- https://www.stadiumgoods.com/test
 *  Not on product page - https://www.stadiumgoods.com/customer/account/login/
 */

require_once('simple_html_dom.php');

function scraping_url($url)
{
    // Getting header
    $headerUrl = get_headers($url, 1)[0];
    if (strpos($headerUrl, '404') !== false) {
        die('PLP url has 404 not found error');
    }

    // create HTML DOM
    $html = file_get_html($url);

    // $productList = array(array("“Product Name”","Price"));
    $productList = array();

    //Check if URL is of Product page
    if (empty($html->find('div.product-info'))) {
        die('Please verify PLP url once for product page');
    }

    foreach ($html->find('div.product-info') as $info) {
        $productDetails = array();
        foreach ($info->find('div.product-name') as $name) {
            //html_entity_decode decodes inverted commas value
            $productDetails['name'] = html_entity_decode(preg_replace('/\s+/', ' ', $name->plaintext));
        }
        foreach ($info->find('div.price-box') as $price) {
            //pattern replacement of comma to remove confusion in csv output
            $productDetails['price'] = preg_replace("/,/", "", trim($price->plaintext));
        }
        $productList[] = $productDetails;
    }

    // clean up memory
    $html->clear();
    unset($html);

    return $productList;
}


// -----------------------------------------------------------------------------

//Die if no URL is provided as an argument
if (!isset($argv[1])) {
    die("Please enter PLP url as a first argument");

}

//Use Scraping to get required values
$productList = scraping_url(trim($argv[1]));

foreach ($productList as $productDetails) {
    //Desired Output
    echo implode(",", $productDetails) . PHP_EOL;
}
