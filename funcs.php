<?php
function curl($url, $data = null) {
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
  if($data) {
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
  }
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  $ex = curl_exec($ch);
  curl_close($ch);
  return $ex;
}

function random() {
  $chars = "aBcDeFgHiJkLmNoPqRsTuVwYyZ";
  $length = strlen($chars);
  $name = "";
  for($i = 1; $i <= 7; $i++) {
    $random = $chars[mt_rand(0, 10 - 1)];
    $name .= $random;
  }
  return $name;
}

$allowedExt = ["jpg", "jpeg", "png", "gif"];
?>