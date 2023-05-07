<?php
namespace Carpenstar\ByBitAPI\WebSockets\Channels\Derivatives\PublicChannels\Tickers;

use Carpenstar\ByBitAPI\WebSockets\Channels\Derivatives\PublicChannels\Tickers\Entities\TickersEntity;
use Carpenstar\ByBitAPI\WebSockets\Objects\WebSockets\WebSocketsDerivativesPublicChannel;

class TickersChannel extends WebSocketsDerivativesPublicChannel
{

    protected function init(array $data): void
    {

    }

    public function getResponseDTOClass(): string
    {
        return TickersEntity::class;
    }
}