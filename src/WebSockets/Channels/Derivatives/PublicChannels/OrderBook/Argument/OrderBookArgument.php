<?php
namespace Carpenstar\ByBitAPI\WebSockets\Channels\Derivatives\PublicChannels\OrderBook\Argument;

use Carpenstar\ByBitAPI\Core\Enums\EnumIntervals;
use Carpenstar\ByBitAPI\WebSockets\Enums\WebSocketOperationsEnum;
use Carpenstar\ByBitAPI\WebSockets\Enums\WebSocketTopicNameEnum;
use Carpenstar\ByBitAPI\WebSockets\Objects\WebSockets\WebSocketArgument;

class OrderBookArgument extends WebSocketArgument
{
    private int $depth;

    public function __construct(string $symbol, int $depth, ?string $reqId = null)
    {
        parent::__construct($symbol, $reqId);

        $this->setDepth($depth);
    }

    public function getTopic(): array
    {
        return [WebSocketTopicNameEnum::ORDERBOOK.".{$this->getDepth()}.{$this->getSymbol()}"];
    }

    public function getOperation(): string
    {
        return WebSocketOperationsEnum::SUBSCRIBE;
    }

    /**
     * @param string $depth
     * @return self
     * @throws \Exception
     */
    private function setDepth(string $depth): self
    {
        if (!in_array($depth, EnumIntervals::INTERVALS_LIST)) {
            throw new \Exception("Invalid interval {$depth} specified. See the list of available intervals in the file: " . EnumIntervals::class);
        }

        $this->depth = $depth;
        return $this;
    }

    /**
     * @return string
     */
    private function getDepth(): string
    {
        return $this->depth;
    }
}