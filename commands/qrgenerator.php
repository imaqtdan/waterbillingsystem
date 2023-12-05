<?php

require "../vendor/autoload.php";

use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
use Endroid\QrCode\Color\Color;
use Endroid\QrCode\Logo\Logo;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelHigh;

// Get the consumer ID from the URL parameter
$consumerId = $_GET['consumer_id'];

// Ensure that the consumer ID is not empty
if (empty($consumerId)) {
    // Handle the case where the consumer ID is missing or invalid
    die('Consumer ID is missing or invalid.');
}

$text = $consumerId;

$qr_code = QrCode::create($text)
    ->setSize(600)
    ->setMargin(40)
    ->setForegroundColor(new Color(255, 128, 0))
    ->setBackgroundColor(new Color(153, 204, 255))
    ->setErrorCorrectionLevel(new ErrorCorrectionLevelHigh);

$writer = new PngWriter;

$result = $writer->write($qr_code);

// Output the QR code image to the browser
//header("Content-Type: " . $result->getMimeType());
//echo $result->getString();

// Save the image to a file (optional)
$result->saveToFile("qr-code.png");
