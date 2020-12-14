<?php

namespace Discord;

abstract class InteractionResponseType {
  const PONG = 1;
  const ACKNOWLEDGE = 2;
  const CHANNEL_MESSAGE = 3;
  const CHANNEL_MESSAGE_WITH_SOURCE = 4;
  const ACKNOWLEDGE_WITH_SOURCE = 5;
}

