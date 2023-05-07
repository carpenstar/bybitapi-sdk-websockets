<?php
namespace Carpenstar\ByBitAPI\WebSockets\Channels\Derivatives\PublicChannels\OrderBook;

use Carpenstar\ByBitAPI\WebSockets\Objects\WebSocketsDerivativesPublicChannel;

class OrderBookChannel extends WebSocketsDerivativesPublicChannel
{
    protected function init(array $data): void
    {
        // TODO: Implement init() method.
    }

    public function getResponseDTOClass(): string
    {
        return OrderBookDTO::class;
    }
}