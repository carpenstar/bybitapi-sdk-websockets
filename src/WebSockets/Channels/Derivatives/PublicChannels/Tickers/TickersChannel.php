<?php
namespace Carpenstar\ByBitAPI\WebSockets\Channels\Derivatives\PublicChannels\Tickers;

use Carpenstar\ByBitAPI\WebSockets\Objects\WebSocketsDerivativesPublicChannel;

class TickersChannel extends WebSocketsDerivativesPublicChannel
{

    protected function init(array $data): void
    {

    }

    public function getResponseDTOClass(): string
    {
        return TickersDTO::class;
    }
}