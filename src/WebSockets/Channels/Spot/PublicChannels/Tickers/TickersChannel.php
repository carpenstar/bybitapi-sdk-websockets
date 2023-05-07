<?php
namespace Carpenstar\ByBitAPI\WebSockets\Channels\Spot\PublicChannels\Tickers;

use Carpenstar\ByBitAPI\WebSockets\Objects\WebSocketsSpotPublicChannel;

/**
 * https://bybit-exchange.github.io/docs/spot/ws-public/ticker
 *
 * Topic: tickers.{symbol}
 *
 * The 24-hr statistics of a trading pair.
 * Push frequency: real-time
 */
class TickersChannel extends WebSocketsSpotPublicChannel
{

    /**
     * @return string
     */
    public function getResponseDTOClass(): string
    {
        return TickersDTO::class;
    }
}