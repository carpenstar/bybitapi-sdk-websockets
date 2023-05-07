<?php
namespace Carpenstar\ByBitAPI\WebSockets\Channels\Spot\PublicChannels\OrderBook\Argument;

use Carpenstar\ByBitAPI\WebSockets\Enums\WebSocketOperationsEnum;
use Carpenstar\ByBitAPI\WebSockets\Enums\WebSocketTopicNameEnum;
use Carpenstar\ByBitAPI\WebSockets\Objects\WebSockets\WebSocketArgument;

class OrderBookArgument extends WebSocketArgument
{

    /**
     * @return array|string
     */
    public function getTopic(): array
    {
        return [WebSocketTopicNameEnum::ORDERBOOK.".40.{$this->getSymbol()}"];
    }

    /**
     * @return string
     */
    public function getOperation(): string
    {
        return WebSocketOperationsEnum::SUBSCRIBE;
    }
}