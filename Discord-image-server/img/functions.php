<?php

function displayAlert($text, $type) {
return '<div class="alert text-center alert-'.$type.'" role="alert">
        <p>'.$text.'</p>
      </div>';
}

function isImage($file)
{
  $image_formats = ['image/png', 'image/jpeg', 'image/gif', 'image/svg+xml'];
  if (!in_array($file, $image_formats))
   return false;

   return true;
}

function generateRandomName($type, $length) {
    $name = substr(str_shuffle(str_repeat($x = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length / strlen($x)))), 1, 1);
     if (!file_exists(__DIR__.'/'.$name.'.'.$type)) {
        return $name.'.'.$type;
    } else {
        return generateRandomName2($type, $length);
    }
}

function generateRandomName2($type, $length) {
    $name = substr(str_shuffle(str_repeat($x = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length / strlen($x)))), 1, 2);
     if (!file_exists(__DIR__.'/'.$name.'.'.$type)) {
        return $name.'.'.$type;
    } else {
        return generateRandomName3($type, $length);
    }
}

function generateRandomName3($type, $length) {
    $name = substr(str_shuffle(str_repeat($x = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length / strlen($x)))), 1, 3);
     if (!file_exists(__DIR__.'/'.$name.'.'.$type)) {
        return $name.'.'.$type;
    } else {
        return generateRandomName4($type, $length);
    }
}

function generateRandomName4($type, $length) {
    $name = substr(str_shuffle(str_repeat($x = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length / strlen($x)))), 1, 4);
     if (!file_exists(__DIR__.'/'.$name.'.'.$type)) {
        return $name.'.'.$type;
    } else {
        return generateRandomName5($type, $length);
    }
}

function generateRandomName5($type, $length) {
    $name = substr(str_shuffle(str_repeat($x = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length / strlen($x)))), 1, 5);
     if (!file_exists(__DIR__.'/'.$name.'.'.$type)) {
        return $name.'.'.$type;
    } else {
        return generateRandomName6($type, $length);
    }
}

function generateRandomName6($type, $length) {
    $name = substr(str_shuffle(str_repeat($x = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length / strlen($x)))), 1, 6);
     if (!file_exists(__DIR__.'/'.$name.'.'.$type)) {
        return $name.'.'.$type;
    } else {
        return generateRandomName7($type, $length);
    }
}

function generateRandomName7($type, $length) {
    $name = substr(str_shuffle(str_repeat($x = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length / strlen($x)))), 1, 7);
     if (!file_exists(__DIR__.'/'.$name.'.'.$type)) {
        return $name.'.'.$type;
    } else {
        return generateRandomName8($type, $length);
    }
}

function generateRandomName8($type, $length) {
    $name = substr(str_shuffle(str_repeat($x = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length / strlen($x)))), 1, 8);
     if (!file_exists(__DIR__.'/'.$name.'.'.$type)) {
        return $name.'.'.$type;
    } else {
        return generateRandomName9($type, $length);
    }
}

function generateRandomName9($type, $length) {
    $name = substr(str_shuffle(str_repeat($x = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length / strlen($x)))), 1, 9);
     if (!file_exists(__DIR__.'/'.$name.'.'.$type)) {
        return $name.'.'.$type;
    } else {
        return generateRandomName10($type, $length);
    }
}


function generateRandomName10($type, $length) {
    $name = substr(str_shuffle(str_repeat($x = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length / strlen($x)))), 1, 10);
     if (!file_exists(__DIR__.'/'.$name.'.'.$type)) {
        return $name.'.'.$type;
    } else {
        return generateRandomName10($type, $length);
    }
}

function get_file_target($config_overides, $file_name, $name) {
  $config = include 'config.php';
  $config = array_merge($config, $config_overides);

  $parts = explode('.', $file_name);
  $target = null;
  $first_run = true;
  $files_exist_counter = 0;

  while($first_run || file_exists($target)){
    $first_run = false;

    if ($config['enable_random_name']) {
      $target = getcwd().'/img/'.generateRandomName(end($parts), $config['random_name_length']);
    } else {
        if($files_exist_counter++ < 1){
          $target = getcwd().'/img/'.$name.'.'.end($parts); 
        }else{
          $target = getcwd().'/img/'.$name.'_'.$files_exist_counter.'.'.end($parts);
        }
    }
  }
  return $target;
}

function get_latest_sharex_version() {
  $opts = [
      'http' => [
              'method' => 'GET',
              'header' => [
                      'User-Agent: PHP',
              ],
      ],
  ];

  $context = stream_context_create($opts);
  $content = json_decode(file_get_contents('https://api.github.com/repos/ShareX/ShareX/releases/latest', false, $context));
  return str_replace('v', '', $content->tag_name);
}

function bytes_to_string($bytes) {
  $si_prefix = ['B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'];
  $base = 1024;

  $class = min((int) log($bytes, $base), count($si_prefix) - 1);

  return sprintf('%1.2f', $bytes / pow($base, $class)).' '.$si_prefix[$class];
}

function get_total_free_space_string() {
  return bytes_to_string(disk_free_space('/'));
}

function get_total_space_string() {
  return bytes_to_string(disk_total_space('/'));
}

function auth_user($kill_page_if_fail=true){
  $config = include 'config.php';
  
  if(
      !empty($config['allowed_ips']) && 
      !in_array(get_ip(), $config['allowed_ips'])
    ){
      if($kill_page_if_fail){
        die('You are not authed to continue this action, this ip needs to be whitelisted in the config: \'' . get_ip() . '\'');
      }else{
        return false;
      }
  }
  return true;
}

function get_ip(){
  if (isset($_SERVER["HTTP_CF_CONNECTING_IP"])) {
    return $_SERVER["HTTP_CF_CONNECTING_IP"];
  }else{
    if(isset($_SERVER["REMOTE_ADDR"])) {
      return $_SERVER['REMOTE_ADDR'];
    }
    return "0.0.0.0";
  }
}
