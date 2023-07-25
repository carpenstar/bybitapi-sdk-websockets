<?php
namespace Carpenstar\ByBitAPI\WebSockets\Channels\Spot\PublicChannels\Bookticker;

use Carpenstar\ByBitAPI\WebSockets\Channels\Spot\PublicChannels\Bookticker\Entities\BooktickerAbstract;
use Carpenstar\ByBitAPI\WebSockets\Objects\WebSockets\WebSocketsSpotPublicChannel;

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

    public function getResponseClassname(): string
    {
        return BooktickerAbstract::class;
    }

    protected function init(array $data): void
    {
        // TODO: Implement init() method.
    }
}