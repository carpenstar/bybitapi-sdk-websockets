<?php
namespace Carpenstar\ByBitAPI\WebSockets\Channels\Derivatives\PublicChannels\Tickers;

use Carpenstar\ByBitAPI\WebSockets\Channels\Derivatives\PublicChannels\Tickers\Entities\TickersAbstract;
use Carpenstar\ByBitAPI\WebSockets\Objects\WebSockets\WebSocketsDerivativesPublicChannel;

class TickersChannel extends WebSocketsDerivativesPublicChannel
{

    protected function init(array $data): void
    {

    }

    public function getResponseClassname(): string
    {
        return TickersAbstract::class;
    }
}