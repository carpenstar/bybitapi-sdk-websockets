<?php
namespace Carpenstar\ByBitAPI\WebSockets\Channels\Derivatives\PublicChannels\OrderBook;

use Carpenstar\ByBitAPI\WebSockets\Channels\Derivatives\PublicChannels\OrderBook\Entities\OrderBookEntity;
use Carpenstar\ByBitAPI\WebSockets\Objects\WebSockets\WebSocketsDerivativesPublicChannel;

class OrderBookChannel extends WebSocketsDerivativesPublicChannel
{
    protected function init(array $data): void
    {
        // TODO: Implement init() method.
    }

    public function getResponseDTOClass(): string
    {
        return OrderBookEntity::class;
    }
}