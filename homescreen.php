<?php

putenv('GDFONTPATH=' . realpath('.'));

$ticker1 = 'bitcoin';
$ticker2 = 'ethereum';
$ticker3 = 'power-ledger';

$convert = 'none';

if(isset($_GET['ticker1']))
  $ticker1 = preg_replace('/[^\w.-]/', '', $_GET['ticker1']);

if(isset($_GET['ticker2']))
  $ticker2 = preg_replace('/[^\w.-]/', '', $_GET['ticker2']);

if(isset($_GET['ticker3']))
  $ticker3 = preg_replace('/[^\w.-]/', '', $_GET['ticker3']);

if($ticker3 === 'none')
  if($ticker2 === 'none')
    $numTickers = 1;
  else
    $numTickers = 2;
else
  $numTickers = 3;

if($ticker2 === 'none' && $ticker3 !== 'none') {
  $ticker2 = $ticker3;
  $ticker3 = 'none';
}

$height = $numTickers*120;
$width = 550;

if(isset($_GET['convert']))
  $convert = strtolower(preg_replace('/[^\w.-]/', '', $_GET['convert']));

// BASE IMAGE

$im = imagecreatetruecolor($width, $height);
imageAlphaBlending($im, true);
imageSaveAlpha($im, true);

$black = imagecolorallocate($im, 0, 0, 0);
$white = imagecolorallocate($im, 255, 255, 255);
$shaded = imagecolorallocatealpha($im, 0, 0, 0, 64);
$transparent = imagecolorallocatealpha($im, 0, 0, 0, 127);

imagefill($im, 0, 0, $shaded);

// TICKER 1

$url = 'https://api.coinmarketcap.com/v1/ticker/' . $ticker1;

if($convert !== 'none')
  $url .= '/?convert=' . $convert;

$json = file_get_contents($url);
$obj = json_decode($json);

if($obj) {

  $usd = number_format($obj[0]->price_usd, 2);
  $symbol = $obj[0]->symbol;
  $price = "$" . $usd;
  if($convert !== 'none')
    $price = "USD " . $price;

  $btcChange = $obj[0]->percent_change_24h . "%";

  if($convert !== 'none') {
    $key = 'price_' . $convert;
    $aud = number_format($obj[0]->$key, 2);
    $converted = strtoupper($convert) . " $" . $aud;
  }

  if(file_exists($ticker1 . '.png')) {
    $btc = imagecreatefrompng($ticker1 . '.png');
    imageAlphaBlending($btc, true);
    imageSaveAlpha($btc, true);
    imagecopyresampled($im, $btc, 10, 10, 0, 0, 100, 100, 100, 100);
  } else {
    imagettftext($im, 30.0, 0.0, 20, 75, $white, 'Roboto-Regular', $symbol);
  }

  imagettftext($im, 20.0, 0.0, 125, 70, $white, 'Roboto-Regular', $btcChange);

  if($convert !== 'none') {
    imagettftext($im, 30.0, 0.0, 220, 50, $white, 'Roboto-Regular', $price);
    imagettftext($im, 30.0, 0.0, 220, 100, $white, 'Roboto-Regular', $converted);
  } else {
    imagettftext($im, 40.0, 0.0, 220, 80, $white, 'Roboto-Regular', $price);
  }
}

// TICKER 2

if($ticker2 !== 'none') {
  $url = 'https://api.coinmarketcap.com/v1/ticker/' . $ticker2;

  if($convert !== 'none')
    $url .= '/?convert=' . $convert;

  $json = file_get_contents($url);
  $obj = json_decode($json);

  if($obj) {

    $usd = number_format($obj[0]->price_usd, 2);
    $symbol = $obj[0]->symbol;
    $price = "$" . $usd;
    if($convert !== 'none')
      $price = "USD " . $price;

    $ethChange = $obj[0]->percent_change_24h . "%";

    if($convert !== 'none') {
      $key = 'price_' . $convert;
      $aud = number_format($obj[0]->$key, 2);
      $converted = strtoupper($convert) . " $" . $aud;
    }

    if(file_exists($ticker2 . '.png')) {
      $eth = imagecreatefrompng($ticker2 . '.png');
      imageAlphaBlending($eth, true);
      imageSaveAlpha($eth, true);
      imagecopyresampled($im, $eth, 10, 130, 0, 0, 100, 100, 100, 100);
    } else {
      imagettftext($im, 30.0, 0.0, 20, 195, $white, 'Roboto-Regular', $symbol);
    }

    imagettftext($im, 20.0, 0.0, 125, 190, $white, 'Roboto-Regular', $ethChange);

    if($convert !== 'none') {
      imagettftext($im, 30.0, 0.0, 220, 170, $white, 'Roboto-Regular', $price);
      imagettftext($im, 30.0, 0.0, 220, 220, $white, 'Roboto-Regular', $converted);
    } else {
      imagettftext($im, 40.0, 0.0, 220, 200, $white, 'Roboto-Regular', $price);
    }
  }

}

// TICKER 3

if($ticker3 !== 'none') {
  $url = 'https://api.coinmarketcap.com/v1/ticker/' . $ticker3;

  if($convert !== 'none')
    $url .= '/?convert=' . $convert;

  $json = file_get_contents($url);
  $obj = json_decode($json);

  if($obj) {
    $usd = number_format($obj[0]->price_usd, 2);
    $symbol = $obj[0]->symbol;
    $price = "$" . $usd;
    if($convert !== 'none')
      $price = "USD " . $price;

    $powrChange = $obj[0]->percent_change_24h . "%";

    if($convert !== 'none') {
      $key = 'price_' . $convert;
      $aud = number_format($obj[0]->$key, 2);
      $converted = strtoupper($convert) . " $" . $aud;
    }

    if(file_exists($ticker3 . '.png')) {
      $powr = imagecreatefrompng($ticker3 . '.png');
      imageAlphaBlending($powr, true);
      imageSaveAlpha($powr, true);
      imagecopyresampled($im, $powr, 10, 250, 0, 0, 100, 100, 100, 100);
    } else {
      imagettftext($im, 30.0, 0.0, 20, 315, $white, 'Roboto-Regular', $symbol);
    }

    imagettftext($im, 20.0, 0.0, 125, 310, $white, 'Roboto-Regular', $powrChange);

    if($convert !== 'none') {
      imagettftext($im, 30.0, 0.0, 220, 290, $white, 'Roboto-Regular', $price);
      imagettftext($im, 30.0, 0.0, 220, 340, $white, 'Roboto-Regular', $converted);
    } else {
      imagettftext($im, 40.0, 0.0, 220, 320, $white, 'Roboto-Regular', $price);
    }

  }

}

date_default_timezone_set('Australia/Melbourne');
imagettftext($im, 12.0, 0.0, 470, $height-10, $white, 'Roboto-Regular', '@ ' . date('g:ia'));

// OUTPUT

header("Content-type: image/png");
imagepng($im);

imagedestroy($im);

?>