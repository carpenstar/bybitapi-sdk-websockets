<?php
namespace Carpenstar\ByBitAPI\WebSockets\Builders;

use Carpenstar\ByBitAPI\Core\Interfaces\IFabricInterface;
use Carpenstar\ByBitAPI\Core\Interfaces\IResponseInterface;
use Carpenstar\ByBitAPI\WebSockets\Interfaces\IWebSocketArgumentInterface;
use Carpenstar\ByBitAPI\WebSockets\Interfaces\IWebSocketsChannelInterface;
use Carpenstar\ByBitAPI\WebSockets\Objects\ChannelHandler;

class WebSocketsBuilder implements IFabricInterface
{

    public static function make(string $className, IWebSocketArgumentInterface $arguments = null,  ChannelHandler $channelHandler = null, int $mode = 0): IWebSocketsChannelInterface
    {
        if (!in_array(IWebSocketsChannelInterface::class, class_implements($className))) {
            throw new \Exception("This websocket {$className} must implement the interface " . IResponseInterface::class . "!");
        }

        return new $className($arguments, $channelHandler, $mode);
    }
}