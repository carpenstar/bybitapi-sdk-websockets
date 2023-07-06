<?php
namespace Carpenstar\ByBitAPI\WebSockets\Channels\Spot\PublicChannels\OrderBook\Argument;

use Carpenstar\ByBitAPI\WebSockets\Enums\WebSocketOperationsEnum;
use Carpenstar\ByBitAPI\WebSockets\Enums\WebSocketTopicNameEnum;
use Carpenstar\ByBitAPI\WebSockets\Objects\WebSockets\WebSocketArgument;

class OrderBookArgument extends WebSocketArgument
{

    private int $depth;

    /**
     * @return array
     * @throws \Exception
     */
    public function getTopic(): array
    {
        if (!isset($this->depth)) {
            throw new \Exception("You must set depth parameter!");
        }

        $topics = [];
        foreach ($this->symbols as $symbol) {
            $topics[] = WebSocketTopicNameEnum::ORDERBOOK . ".{$this->getDepth()}." . $symbol;
        }

        return $topics;
    }

    /**
     * @param int $depth
     * @return $this
     */
    public function setDepth(int $depth): self
    {
        $this->depth = $depth;
        return $this;
    }

    /**
     * @return int
     */
    public function getDepth(): int
    {
        return $this->depth;
    }


    /**
     * @return string
     */
    public function getOperation(): string
    {
        return WebSocketOperationsEnum::SUBSCRIBE;
    }
}