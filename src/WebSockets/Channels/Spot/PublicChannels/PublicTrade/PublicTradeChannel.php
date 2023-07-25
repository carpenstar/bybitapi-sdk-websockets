<?php
namespace Carpenstar\ByBitAPI\WebSockets\Channels\Spot\PublicChannels\PublicTrade;

use Carpenstar\ByBitAPI\WebSockets\Channels\Spot\PublicChannels\PublicTrade\Entities\PublicTradeAbstract;
use Carpenstar\ByBitAPI\WebSockets\Objects\WebSockets\WebSocketsSpotPublicChannel;

/**
 * https://bybit-exchange.github.io/docs/spot/ws-public/public-trade
 *
 * Topic: trade.{symbol}
 *
 * This topic pushes raw trade information; each trade has a unique buyer and seller.
 * Variable "v" acts as a tradeId. This variable is shared across different symbols; however, each ID is unique.
 * For example, suppose in the last 5 seconds 3 trades happened in ETHUSDT, BTCUSDT, and BHTBTC.
 * Their tradeId (which is "v") will be consecutive: 112, 113, 114.
 */
class PublicTradeChannel extends WebSocketsSpotPublicChannel
{

    /**
     * @return string
     */
    public function getResponseClassname(): string
    {
        return PublicTradeAbstract::class;
    }

}