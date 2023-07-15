<?php
include_once('./stripe/init.php');

$publishableKey="pk_test_Your_Stripe_Publishable_Key";

$secretKey="sk_test_Your_Stripe_Secret_Key";

\Stripe\Stripe::setApiKey($secretKey);
?>
