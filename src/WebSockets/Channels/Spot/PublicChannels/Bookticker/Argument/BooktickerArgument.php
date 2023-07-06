<?php
namespace Carpenstar\ByBitAPI\WebSockets\Channels\Spot\PublicChannels\Bookticker\Argument;

use Carpenstar\ByBitAPI\WebSockets\Enums\WebSocketOperationsEnum;
use Carpenstar\ByBitAPI\WebSockets\Enums\WebSocketTopicNameEnum;
use Carpenstar\ByBitAPI\WebSockets\Objects\WebSockets\WebSocketArgument;

class BooktickerArgument extends WebSocketArgument
{

    /**
     * @return string
     */
    public function getOperation(): string
    {
        return WebSocketOperationsEnum::SUBSCRIBE;
    }

    /**
     * @return string[]
     */
    public function getTopic(): array
    {
        $topics = [];
        foreach ($this->symbols as $symbol) {
            $topics[] = WebSocketTopicNameEnum::BOOKTICKER . ".{$symbol}";
        }

        return $topics;
    }
}