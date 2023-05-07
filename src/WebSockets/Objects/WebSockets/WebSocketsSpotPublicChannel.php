<?php
namespace Carpenstar\ByBitAPI\WebSockets\Objects\WebSockets;

use Carpenstar\ByBitAPI\WebSockets\Interfaces\IWebSocketsSpotChannel;

abstract class WebSocketsSpotPublicChannel extends WebSocketsPublicChannel implements IWebSocketsSpotChannel
{
    protected static $wssRoute = "wss://stream.bybit.com/" . self::CHANNEL_TYPE . "/public/v3";

}