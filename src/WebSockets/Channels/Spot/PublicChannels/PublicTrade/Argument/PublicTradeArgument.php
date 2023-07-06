<?php
namespace Carpenstar\ByBitAPI\WebSockets\Channels\Spot\PublicChannels\PublicTrade\Argument;

use Carpenstar\ByBitAPI\WebSockets\Enums\WebSocketOperationsEnum;
use Carpenstar\ByBitAPI\WebSockets\Enums\WebSocketTopicNameEnum;
use Carpenstar\ByBitAPI\WebSockets\Objects\WebSockets\WebSocketArgument;

class PublicTradeArgument extends WebSocketArgument
{

    public function getTopic(): array
    {
        $topics = [];
        foreach ($this->symbols as $symbol) {
            $topics[] = WebSocketTopicNameEnum::PUBLIC_TRADE.".{$symbol}";
        }

        return $topics;
    }

    public function getOperation(): string
    {
        return WebSocketOperationsEnum::SUBSCRIBE;
    }
}