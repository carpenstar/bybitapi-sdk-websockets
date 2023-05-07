<?php

namespace Carpenstar\ByBitAPI\WebSockets\Objects;

use Carpenstar\ByBitAPI\WebSockets\Interfaces\IWebSocketsDerivativesChannel;

abstract class WebSocketsDerivativesPublicChannel extends WebSocketsPublicChannel implements IWebSocketsDerivativesChannel
{
    protected static $wssRoute = "wss://stream.bybit.com/" . self::CHANNEL_TYPE . "/public/v3";
}