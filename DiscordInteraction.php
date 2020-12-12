<?php

require_once __DIR__ . '/vendor/autoload.php';

use Elliptic\EdDSA;

abstract class InteractionType {
  const PING = 1;
  const APPLICATION_COMMAND = 2;
}

abstract class InteractionResponseType {
  const PONG = 1;
  const ACKNOWLEDGE = 2;
  const CHANNEL_MESSAGE = 3;
  const CHANNEL_MESSAGE_WITH_SOURCE = 4;
  const ACKNOWLEDGE_WITH_SOURCE = 5;
}

abstract class InteractionResponseFlags {
  const EPHEMERAL = 1 << 6;
}

class Interaction {
  public static function verifyKey($rawBody, $signature, $timestamp, $client_public_key) {
    $ec = new EdDSA('ed25519');

    $key = $ec->keyFromPublic($client_public_key, 'hex');

    $message = array_merge(unpack('C*', $timestamp), unpack('C*', $rawBody));

    return $key->verify($message, $signature) == TRUE;
  }
}
