<?php

// Datumsformatierungs-Klasse

class dpsgDateFmt {

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