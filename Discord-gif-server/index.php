<?php
$vars = explode("/", $_GET['dirs']);
$filename = "echo $vars[0].mp4";
function randomHex() {
   $chars = 'ABCDEF0123456789';
   $color = '#';
   for ( $i = 0; $i < 6; $i++ ) {
      $color .= $chars[rand(0, strlen($chars) - 1)];
   }
   return $color;
}
$colourtheme = randomHex();
?> 
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

        <title>Alienwarez Video Server</title>

        <meta property="og:site_name" content="Alienwarez Video">
        <meta property="og:url" content="https://jozef.cf/img/<?php echo $vars[0]; ?>.gif">
        <meta property="og:title" content="<?php echo date("F d Y H:i:s", filemtime("img/$vars[0].gif")); ?>">
        <meta property="og:description" content="">
        <meta property="og:type" content="article">
        <meta name="theme-color" content=<?php echo $colourtheme; ?>>
        <meta content='/img/<?php echo $vars[0] ?>.gif' property='og:image'>
        <meta name="author" content="Alienwarez#0711">
        <meta name="twitter:card" content="summary_large_image">

    </head>
    <body>
        
                
        <img src="/img/<?php echo $vars[0] ?>.gif">
</body>
</html>