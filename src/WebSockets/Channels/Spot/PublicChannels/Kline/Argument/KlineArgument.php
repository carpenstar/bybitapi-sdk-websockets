<?php
namespace Carpenstar\ByBitAPI\WebSockets\Channels\Spot\PublicChannels\Kline\Argument;

use Carpenstar\ByBitAPI\Core\Enums\IntervalEnum;
use Carpenstar\ByBitAPI\WebSockets\Enums\WebSocketOperationsEnum;
use Carpenstar\ByBitAPI\WebSockets\Enums\WebSocketTopicNameEnum;
use Carpenstar\ByBitAPI\WebSockets\Objects\WebSockets\WebSocketArgument;

class KlineArgument extends WebSocketArgument
{
    private string $interval;

    private array $symbols;

    public function __construct(string $symbol, string $interval, ?string $reqId = null)
    {
        parent::__construct($symbol, $reqId);

        if (str_contains(",", $symbol)) {
            $symbolList = explode(",", $symbol);
            foreach ($symbolList as $symbolItem) {
               $this->symbols[] = $symbolItem;
            }
        } else {
            $this->symbols[] = $symbol;
        }

        $this->setInterval($interval);
    }

    /**
     * @return array
     */
    public function getTopic(): array
    {
        $topics = [];
        foreach ($this->symbols as $symbol) {
            $topics[] = [WebSocketTopicNameEnum::KLINE . ".{$this->getInterval()}.{$symbol}"];
        }

        return $topics;
    }

    /**
     * @return string
     */
    public function getOperation(): string
    {
        return WebSocketOperationsEnum::SUBSCRIBE;
    }

    /**
     * @param string $interval
     * @return self
     * @throws \Exception
     */
    private function setInterval(string $interval): self
    {
        if (!in_array($interval, IntervalEnum::INTERVALS_LIST)) {
            throw new \Exception("Invalid interval {$interval} specified. See the list of available intervals in the file: " . IntervalEnum::class);
        }

        $this->interval = $interval;
        return $this;
    }

    /**
     * @return string
     */
    private function getInterval(): string
    {
        return $this->interval;
    }
}