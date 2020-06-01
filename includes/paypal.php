<?

require 'paypal/autoload.php';

define('URL_SITIO', 'http://localhost/pmawebcamp');

$apiContext = new \PayPal\Rest\ApiContext(
    new \PayPal\Auth\OAuthTokenCredential(
        'AfRwmiO5aeYDWe0rV0AH-LIlC0YXot0N_JpJvi_kwpsaTRLh-BPbVXvVE1LKOIxzBimq9hzuSpMAA6cf', //ClienteID
        'EPUNdW8VPO1aFayQkGspy1XBQjYda-pxxUq7xcopsTCITsyFeH5wCj0kOgIm8VD1jYZ3i7fpGp1ZsbfO' //Secretx
    )
);