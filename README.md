# Homescreen widget crypto ticker

Small PHP script to output a high resolution image for embedding on a smartphone homescreen, using the coinmarketcap public API.

Useful when used by [URL Image Widget](https://play.google.com/store/apps/details?id=com.weite_welt.urlimagewidget&hl=en) on Android devices.

## Options

Options are specified as GET parameters to the URI. eg `/homescreen.php?convert=AUD&ticker3=ripple`

**Specify cryptos:** `ticker1`, `ticker2`, `ticker3`

Specify up to three currencies to display. For example, ticker1=bitcoin, ticker2=ripple, ticker3=ethereum.
If 'none' is specified for ticker3 and/or ticker2, the widget will output a smaller image.

**Specify fiat currency conversion:** `convert` (optional)

Specify an extra currency to display. If nothing is specified, USD is used exclusively.

## Screenshot Example

![Image of widget](https://aliask.github.com/crypto-homescreen-widget/crypto-widget-screenshot-thumb.jpg)

Example showing 2 cryptos (ticker3=none) and converting to AUD (convert=AUD)
