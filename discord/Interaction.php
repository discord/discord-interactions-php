<?php

namespace Discord;

require_once __DIR__ . '/vendor/autoload.php';

use Elliptic\EdDSA;

class Interaction {
  public static function verifyKey($rawBody, $signature, $timestamp, $client_public_key) {
    $ec = new EdDSA('ed25519');
    $key = $ec->keyFromPublic($client_public_key, 'hex');

    $message = array_merge(unpack('C*', $timestamp), unpack('C*', $rawBody));
    return $key->verify($message, $signature) == TRUE;
  }
}
