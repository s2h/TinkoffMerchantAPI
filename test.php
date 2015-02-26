<?php
spl_autoload('TinkoffMerchantAPI');
$api = new TinkoffMerchantAPI('TestB', 'ni78Hh9Ah', 'https://rest-api-test.tcsbank.ru/rest/');

echo $api->resend();