<?php
namespace Carpenstar\ByBitAPI\WebSockets\Channels\Spot\PublicChannels\Tickers\Argument;

use Carpenstar\ByBitAPI\WebSockets\Enums\WebSocketOperationsEnum;
use Carpenstar\ByBitAPI\WebSockets\Enums\WebSocketTopicNameEnum;
use Carpenstar\ByBitAPI\WebSockets\Objects\WebSockets\WebSocketArgument;

class TickersArgument extends WebSocketArgument
{

    public function getTopic(): array
    {
        return [WebSocketTopicNameEnum::TICKERS.".{$this->getSymbol()}"];
    }

    public function getOperation(): string
    {
        return WebSocketOperationsEnum::SUBSCRIBE;
    }
}