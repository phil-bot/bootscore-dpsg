<?php

// URL-Kuerzung

function short_url($url, $length = 100) {
  $url = parse_url(trim($url));
  $furl = array_filter(explode('/', $url['path']));
  if(count($furl) > 1) $u = '../';
  $url['path'] = $u.array_pop($furl);
  $ausgabe = $url['scheme'].'://'.$url['host'].'/'.$url['path'];
  print substr($ausgabe, 0, $length);
}

// Datumsformatierungs-Klasse

class dpsgDateFmt
{

  // Original PHP code by Chirp Internet: www.chirpinternet.eu
  // Please acknowledge use of this code by including this header.

  protected $datefmt;

  public function __construct(string $locale = NULL, string $timezone = NULL)
  {
    $this->datefmt = datefmt_create(
      $locale ?? locale_get_default(),
      \IntlDateFormatter::NONE,
      \IntlDateFormatter::NONE,
      $timezone ?? date_default_timezone_get(),
      \IntlDateFormatter::GREGORIAN,
    );
  }
  public function format(int $timestamp, string $pattern) : string
  {
    datefmt_set_pattern($this->datefmt, $pattern);
    return datefmt_format($this->datefmt, $timestamp);
  }
}