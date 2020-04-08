<?php
$vars = explode("/", $_GET['dirs']);
$filename = "echo $vars[0].png";
function randomHex() {
   $chars = 'ABCDEF0123456789';
   $color = '#';
   for ( $i = 0; $i < 6; $i++ ) {
      $color .= $chars[rand(0, strlen($chars) - 1)];
   }
   return $color;
}
?> 
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

        <title>Alienwarez Image Server</title>

        <meta property="og:site_name" content="Alienwarez">
        <meta property="og:url" content="https://jozef.cf/img/<?php echo $vars[0]; ?>.png">
        <meta property="og:title" content="<?php echo date("F d Y H:i:s.", filemtime("img/$vars[0].png")); ?>">
        <meta property="og:description" content="">
        <meta property="og:type" content="article">
        <meta name="theme-color" content=<?php echo randomHex(); ?>>
        <meta content='/border.php?name=<?php echo $vars[0]; ?>' property='og:image'>
        <meta name="author" content="Alienwarez#0711">
        <meta name="twitter:card" content="summary_large_image">

    </head>
    <body>
        
                
        <img src="/border.php?name=<?php echo $vars[0]; ?>">
		Thank you to Maineiac#0001 for helping this work
</body>
</html>