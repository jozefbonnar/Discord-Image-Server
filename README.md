# Discord-Image-Server
A image server that works with discord and uploads through sharex
An example in discord image https://jozef.cf/9aUQVkEADF
An example of gif discord image https://v.jozef.cf/qFLaQTwWHJ

How to set this up:
1) Either download this repositary as a zip or clone it into your webspace, after unzip it.
2) Go into index.php in the root directory and change the site_name to what ever you want, remember to keep "Thenameofyoursite" (line 19)
3) Change the url of the title to https://example.com/img/ (line 20)
4) Change the author of the site (line 26)
5) We are now going to setup the sharex part in the folder IMG you will find a config.php open it up and change the securekey to what ever you want
6) Change the output url to your site like https://example.com/
7) Change the request url to your site like https://example.com/upload.php
8) You can change the page_title in the config.php but it wont change anything you will have to do it in the index.php in the root folder
9) Run the sharex file upload file with sharex and all you have to do is set your destination on sharex.
10) Change the key in sharex to the one you have set in the config.php

If you want to install the gif you could either set this up in another sub domain or a another directory its pretty much the same but make your hotkey force set to the new gif uploader here https://jozef.cf/h7bIscxkUZ


Known Issues
1) When you have the link for the screenshot you have to remove .png on the end for it to work
2) Only works with PNG images unless you change the border.php
3) If you have like an error saying Directory or like change permissions 777 that could be the reason but another reason is that the php.ini is set to like a max 2mb upload, i have uploaded my php.ini for a reference

Credit for sharex file uploader https://github.com/JoeGandy/ShareX-Custom-Upload
Credit for Maineiac for helping for the .htaccess and knowledge on how to do this
