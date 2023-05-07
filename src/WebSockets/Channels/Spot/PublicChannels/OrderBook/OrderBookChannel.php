<?php
namespace Carpenstar\ByBitAPI\WebSockets\Channels\Spot\PublicChannels\OrderBook;

use Carpenstar\ByBitAPI\WebSockets\Objects\WebSocketsSpotPublicChannel;

/**
 * https://bybit-exchange.github.io/docs/spot/ws-public/orderbook
 *
 * Topic: orderbook.40.{symbol}
 *
 * Market depth data for a trading pair:
 *
 * Snapshot depth: 40 each for asks and bids.
 * Events trigger order book version change:
 * order enters order book
 * order leaves order book
 * order quantity changes
 * order filled
 * Pushes snapshot data only
 * Push frequency: 100ms
 */
class OrderBookChannel extends WebSocketsSpotPublicChannel
{

    /**
     * @return string
     */
    public function getResponseDTOClass(): string
    {
        return OrderBookDTO::class;
    }

}