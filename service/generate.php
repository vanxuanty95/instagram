<?php
require 'vendor/autoload.php';

use mikehaertl\wkhtmlto\Image;

function generateImage($url)
{

    // You can pass a filename, a HTML string, an URL or an options array to the constructor
    var_dump($url);
    $image = new Image($url);
    $image->saveAs('/save/page.png');

    // ... or send to client for inline display
    if (!$image->send()) {
        $error = $image->getError();
        // ... handle error here
        var_dump($error);
    }

    // ... or send to client as file download
    if (!$image->send('page.png')) {
        $error = $image->getError();
        // ... handle error here
        var_dump($error);
    }
}
