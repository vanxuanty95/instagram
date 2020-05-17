<?php
require('vendor/autoload.php');

use JonnyW\PhantomJs\Client;
$generationApi = "http://instagram.nakamadressup.com/index.php?controller=profile&action=profile&username=__username&description=__description";

function getImage($username, $description)
{
    $client = Client::getInstance();
    $client->getEngine()->setPath('vendor/jakoch/phantomjs/bin/phantomjs');
    $client->isLazy();

    $width  = 3072;
    $height = 3072;
    $top    = 0;
    $left   = 0;
    $request = $client->getMessageFactory()->createCaptureRequest('http://instagram.nakamadressup.com/index.php?controller=profile&action=profile&username=' . $username . '&description=' . $description, 'GET');
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

function getImageFromGoogleApi($username, $description)
{
    $target = str_replace(["__username", "__description"],[$username, $description], $generationApi);
    $googlePagespeedData = file_get_contents("https://www.googleapis.com/pagespeedonline/v5/runPagespeed?url=$target&screenshot=true");

    //decode json data
    $googlePagespeedData = json_decode($googlePagespeedData, true);

    //screenshot data
    $screenshot = $googlePagespeedData['screenshot']['data'];
    $screenshot = str_replace(array('_', '-'), array('/', '+'), $screenshot);

    //display screenshot image
    return "<img src=\"data:image/jpeg;base64," . $screenshot . "\" />";
}
