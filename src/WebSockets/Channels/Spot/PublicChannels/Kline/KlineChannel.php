<?php
namespace Carpenstar\ByBitAPI\WebSockets\Channels\Spot\PublicChannels\Kline;

use Carpenstar\ByBitAPI\WebSockets\Channels\Spot\PublicChannels\Kline\Entities\KlineAbstract;
use Carpenstar\ByBitAPI\WebSockets\Objects\WebSockets\WebSocketsSpotPublicChannel;

/**
 * https://bybit-exchange.github.io/docs/spot/ws-public/kline
 *
 * Topic: kline.{interval}.{symbol} e.g., kline.30m.BTCUSDT
 *
 * Subscribe the kline stream
 */
class KlineChannel extends WebSocketsSpotPublicChannel
{

    /**
     * @return string
     */
    public function getResponseClassname(): string
    {
        return KlineAbstract::class;
    }
}