<?php 

function slug($text){ 

  // replace non letter or digits by -
  $text = preg_replace('~[^pLd]+~u', '-', $text);

  // trim
  $text = trim($text, '-');

  // transliterate
  $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

  // lowercase
  $text = strtolower($text);

  // remove unwanted characters
  $text = preg_replace('~[^-w]+~', '', $text);

  if (empty($text))
  {
    return 'n-a';
  }

  return $text;
}

