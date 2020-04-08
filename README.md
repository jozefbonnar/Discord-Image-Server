# Discord-Image-Server
A image server that works with discord and uploads through sharex
An example in discord https://jozef.cf/8fZtDlM75N

How to set this up:
1) Either download this repositary as a zip or clone it into your webspace, after unzip it.
2) Go into index.php in the root directory and change the site_name to what ever you want, remember to keep "Thenameofyoursite" (line 19)
3) Change the url of the title to https://example.com/img/ (line 20)
4) Change the author of the site (line 26)
5) We are now going to setup the sharex part in the folder IMG you will find a config.php open it up and change the securekey to what ever you want
6) Change the output url to your site like https://example.com/
7) Change the request url to your site like https://example.com/upload.php
8) Add your ip address to the config like ['127.0.0.1', 'your ip', '::1', '0.0.0.0'],
9) You can change the page_title in the config.php but it wont change anything you will have to do it in the index.php in the root folder
10) Open up the sharex upload file with notepad and change the site to https:\/\/example.com\/upload.php
11) Change the key to your key that you set in config.php
12) Run the sharex file upload file with sharex and all you have to do is set your destination on sharex.



Known Issues
1) When you have the link for the screenshot you have to remove .png on the end for it to work


Credit for sharex file uploader https://github.com/JoeGandy/ShareX-Custom-Upload
