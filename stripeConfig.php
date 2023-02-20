<?php
include_once('./stripe/init.php');

$publishableKey="pk_test_51MH1kMSHriqitrpZ9wzffFCtudBTZqeAWtNlloNOUSdgGVhYV4HzBVPbmKsX4lOGGt2J2eSfbpP9IZTyoFWfYUxv0056vxnuZt";

$secretKey="sk_test_51MH1kMSHriqitrpZHbyROzSGPYhFa9ZU0kgjZ7COByMl1YDPrDfcdh7HaXgpetYw2PQOWWcMpTfhKPJr2jlnrbMk00Z6NGsJ30";

\Stripe\Stripe::setApiKey($secretKey);
?>