<?php
// z.B. mal drei Bücher
$asin='3826614828,013147149X,0672327090';

function Amazon_DoRequest(
$parameter = '')
{
$host = "webservices.amazon.de";
$port = 80;
$soap_url = "/onca/xml?Service=AWSECommerceService";
$soap_url .= "&SubscriptionId=XXXXXXXXXX";
$soap_url .= $parameter;
$content = http_get($host,$port, $soap_url);
return XML2Array(utf8_decode($content));
} 

print_r(Amazon_DoRequest());

?>