<?php
namespace Carpenstar\ByBitAPI\WebSockets\Channels\Derivatives\PublicChannels\OrderBook;

use Carpenstar\ByBitAPI\WebSockets\Channels\Derivatives\PublicChannels\OrderBook\Entities\OrderBookAbstract;
use Carpenstar\ByBitAPI\WebSockets\Objects\WebSockets\WebSocketsDerivativesPublicChannel;

class OrderBookChannel extends WebSocketsDerivativesPublicChannel
{
    protected function init(array $data): void
    {
        // TODO: Implement init() method.
    }

    public function getResponseClassname(): string
    {
        return OrderBookAbstract::class;
    }
}