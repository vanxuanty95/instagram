<?php
require('vendor/autoload.php');

use JonnyW\PhantomJs\Client;

function getImage($username, $description)
{
    $client = Client::getInstance();
    $client->getEngine()->setPath('vendor/jakoch/phantomjs/bin/phantomjs');
    $client->isLazy();

    $width  = 3072;
    $height = 3072;
    $top    = 0;
    $left   = 0;
    $request = $client->getMessageFactory()->createCaptureRequest('http://instagram.nakamadressup.com/index.php?controller=profile&action=profile&username='.$username.'&description='.$description, 'GET');
    $request->setOutputFile('./save/file.jpg');
    $request->setViewportSize($width, $height);
    $request->setCaptureDimensions($width, $height, $top, $left);
    $request->setTimeout(10000);

    $response = $client->getMessageFactory()->createResponse();

    // Send the request
    $client->send($request, $response);
    var_dump($request);
    var_dump($response);
    echo $response->getStatus();
}
