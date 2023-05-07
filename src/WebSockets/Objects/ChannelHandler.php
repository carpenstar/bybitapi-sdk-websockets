<?php
namespace Carpenstar\ByBitAPI\WebSockets\Objects;

use Carpenstar\ByBitAPI\WebSockets\Interfaces\IChannelHandlerInterface;

abstract class ChannelHandler implements IChannelHandlerInterface
{
    abstract function handle($data): void;
}