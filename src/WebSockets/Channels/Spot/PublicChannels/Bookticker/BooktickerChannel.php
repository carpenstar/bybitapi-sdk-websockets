<?php
namespace Carpenstar\ByBitAPI\WebSockets\Channels\Spot\PublicChannels\Bookticker;

use Carpenstar\ByBitAPI\WebSockets\Objects\WebSocketsSpotPublicChannel;

/**
 * https://bybit-exchange.github.io/docs/spot/ws-public/bookticker
 *
 * Topic: bookticker.{symbol}
 *
 * Best bid price and best ask price
 * Push frequency: 100ms
 *
 */
class BooktickerChannel extends WebSocketsSpotPublicChannel
{

    public function getResponseDTOClass(): string
    {
        return BooktickerDTO::class;
    }

    protected function init(array $data): void
    {
        // TODO: Implement init() method.
    }
}