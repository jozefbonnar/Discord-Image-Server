<?php
$colourthene = $_GET["colour"];
/** Set source image location. You can use URL here **/
$imageLocation = 'img/' . $_GET["name"] . '.png';
$size = $_GET["size"];

#If the value is empty is defaults to 10
if (empty($size)) {
    $size = '10';
}

/** Set border format **/
$borderWidth = $size;

// You can use color name, hex code, rgb() or rgba()
$borderColor = '#' . $_GET["colour"] . '';

// Padding between image and border. Set to 0 to give none
$borderPadding = 0;


/** Core program **/

// Create Imagick object for source image
$imageSource = new Imagick( $imageLocation );

// Get image width and height, and automatically set it wider than
// source image dimension to give space for border (and padding if set)
$imageWidth = $imageSource->getImageWidth() + ( 2 * ( $borderWidth + $borderPadding ) );
$imageHeight = $imageSource->getImageHeight() + ( 2 * ( $borderWidth + $borderPadding ) );

// Create Imagick object for final image with border
$image = new Imagick();

// Set image canvas
$image->newImage( $imageWidth, $imageHeight, new ImagickPixel( 'none' )
);

// Create ImagickDraw object to draw border
$border = new ImagickDraw();

// Set fill color to transparent
$border->setFillColor( 'none' );

// Set border format
$border->setStrokeColor( new ImagickPixel( $borderColor ) );
$border->setStrokeWidth( $borderWidth );
$border->setStrokeAntialias( false );

// Draw border
$border->rectangle(
    $borderWidth / 2 - 1,
    $borderWidth / 2 - 1,
    $imageWidth - ( ($borderWidth / 2) ),
    $imageHeight - ( ($borderWidth / 2) )
);

// Apply drawed border to final image
$image->drawImage( $border );

$image->setImageFormat('png');

// Put source image to final image
$image->compositeImage(
    $imageSource, Imagick::COMPOSITE_DEFAULT,
    $borderWidth + $borderPadding,
    $borderWidth + $borderPadding
);

// Prepare image and publish!
header("Content-type: image/png");
echo $image;
?> 