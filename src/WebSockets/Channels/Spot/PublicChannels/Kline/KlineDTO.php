<?php
namespace Carpenstar\ByBitAPI\WebSockets\Channels\Spot\PublicChannels\Kline;

use Carpenstar\ByBitAPI\Core\Helpers\DateTimeHelper;
use Carpenstar\ByBitAPI\Core\Objects\ResponseEntity;

class KlineDTO extends ResponseEntity
{
    /**
     * Topic name
     * @var string $topic
     */
    private string $topic;

    /**
     * The timestamp that message is sent out
     * @var \DateTime $requestTimestamp
     */
    private \DateTime $requestTimestamp;

    /**
     * Data type. snapshot
     * @var string $type
     */
    private string $type;

    /**
     * The start timestamp of the bar
     * @var \DateTime $barTimestamp
     */
    private \DateTime $barTimestamp;

    /**
     * Trading pair
     * @var string $symbol
     */
    private string $symbol;

    /**
     * Close price
     * @var float $closePrice
     */
    private float $closePrice;

    /**
     * High price
     * @var float $highPrice
     */
    private float $highPrice;

    /**
     * Low price
     * @var float $lowPrice
     */
    private float $lowPrice;

    /**
     * Open price
     * @var float $openPrice
     */
    private float $openPrice;

    /**
     * Trading volume
     * @var float $tradingVolume
     */
    private float $tradingVolume;

    public function __construct(array $data)
    {
        $this
            ->setTopic($data['topic'])
            ->setRequestTimestamp($data['ts'])
            ->setType($data['type'])
            ->setBarTimestamp($data['data']['t'])
            ->setSymbol($data['data']['s'])
            ->setClosePrice($data['data']['c'])
            ->setHighPrice($data['data']['h'])
            ->setLowPrice($data['data']['l'])
            ->setOpenPrice($data['data']['o'])
            ->setTradingVolume($data['data']['v']);
    }

    /**
     * @param string $topic
     * @return KlineDTO
     */
    private function setTopic(string $topic): self
    {
        $this->topic = $topic;
        return $this;
    }

    /**
     * @param string $requestTimestamp
     * @return KlineDTO
     */
    private function setRequestTimestamp(string $requestTimestamp): self
    {
        $this->requestTimestamp = DateTimeHelper::makeFromTimestamp($requestTimestamp);
        return $this;
    }

    /**
     * @param string $type
     * @return KlineDTO
     */
    private function setType(string $type): self
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @param string $barTimestamp
     * @return KlineDTO
     */
    private function setBarTimestamp(string $barTimestamp): self
    {
        $this->barTimestamp = DateTimeHelper::makeFromTimestamp($barTimestamp);
        return $this;
    }

    /**
     * @param string $symbol
     * @return KlineDTO
     */
    private function setSymbol(string $symbol): self
    {
        $this->symbol = $symbol;
        return $this;
    }

    /**
     * @param float $closePrice
     * @return KlineDTO
     */
    private function setClosePrice(float $closePrice): self
    {
        $this->closePrice = $closePrice;
        return $this;
    }

    /**
     * @param float $highPrice
     * @return KlineDTO
     */
    private function setHighPrice(float $highPrice): self
    {
        $this->highPrice = $highPrice;
        return $this;
    }

    /**
     * @param float $lowPrice
     * @return KlineDTO
     */
    private function setLowPrice(float $lowPrice): self
    {
        $this->lowPrice = $lowPrice;
        return $this;
    }

    /**
     * @param float $openPrice
     * @return KlineDTO
     */
    private function setOpenPrice(float $openPrice): self
    {
        $this->openPrice = $openPrice;
        return $this;
    }

    /**
     * @param float $tradingVolume
     * @return KlineDTO
     */
    private function setTradingVolume(float $tradingVolume): self
    {
        $this->tradingVolume = $tradingVolume;
        return $this;
    }

    /**
     * @return string
     */
    public function getTopic(): string
    {
        return $this->topic;
    }

    /**
     * @return \DateTime
     */
    public function getRequestTimestamp(): \DateTime
    {
        return $this->requestTimestamp;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @return \DateTime
     */
    public function getBarTimestamp(): \DateTime
    {
        return $this->barTimestamp;
    }

    /**
     * @return string
     */
    public function getSymbol(): string
    {
        return $this->symbol;
    }

    /**
     * @return float
     */
    public function getClosePrice(): float
    {
        return $this->closePrice;
    }

    /**
     * @return float
     */
    public function getHighPrice(): float
    {
        return $this->highPrice;
    }

    /**
     * @return float
     */
    public function getLowPrice(): float
    {
        return $this->lowPrice;
    }

    /**
     * @return float
     */
    public function getOpenPrice(): float
    {
        return $this->openPrice;
    }

    /**
     * @return float
     */
    public function getTradingVolume(): float
    {
        return $this->tradingVolume;
    }
}