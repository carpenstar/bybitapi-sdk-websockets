<?php
namespace Carpenstar\ByBitAPI\WebSockets\Channels\Spot\PublicChannels\PublicTrade\Argument;

use Carpenstar\ByBitAPI\WebSockets\Enums\WebSocketOperationsEnum;
use Carpenstar\ByBitAPI\WebSockets\Enums\WebSocketTopicNameEnum;
use Carpenstar\ByBitAPI\WebSockets\Objects\WebSockets\WebSocketArgument;

class PublicTradeArgument extends WebSocketArgument
{

    public function getTopic(): array
    {
        return [WebSocketTopicNameEnum::PUBLIC_TRADE.".{$this->getSymbol()}"];
    }

    public function getOperation(): string
    {
        return WebSocketOperationsEnum::SUBSCRIBE;
    }
}