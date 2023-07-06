<?php
namespace Carpenstar\ByBitAPI\WebSockets\Channels\Spot\PublicChannels\Kline\Argument;

use Carpenstar\ByBitAPI\Core\Enums\EnumIntervals;
use Carpenstar\ByBitAPI\WebSockets\Enums\WebSocketOperationsEnum;
use Carpenstar\ByBitAPI\WebSockets\Enums\WebSocketTopicNameEnum;
use Carpenstar\ByBitAPI\WebSockets\Objects\WebSockets\WebSocketArgument;

class KlineArgument extends WebSocketArgument
{
    private string $interval;

    public function __construct(string $symbol, string $interval, ?string $reqId = null)
    {
        parent::__construct($symbol, $reqId);
        $this->setInterval($interval);
    }

    /**
     * @return array
     */
    public function getTopic(): array
    {
        $topics = [];
        foreach ($this->symbols as $symbol) {
            $topics[] = WebSocketTopicNameEnum::KLINE . ".{$this->getInterval()}.{$symbol}";
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
        if (!in_array($interval, EnumIntervals::INTERVALS_LIST)) {
            throw new \Exception("Invalid interval {$interval} specified. See the list of available intervals in the file: " . EnumIntervals::class);
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