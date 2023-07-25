<?php
namespace Carpenstar\ByBitAPI\WebSockets\Channels\Spot\PublicChannels\PublicTrade\Entities;

use Carpenstar\ByBitAPI\Core\Helpers\DateTimeHelper;
use Carpenstar\ByBitAPI\Core\Objects\AbstractResponse;

class PublicTradeAbstract extends AbstractResponse
{
    /**
     * Topic name
     * @var string $topic
     */
    private string $topic;

    /**
     * The timestamp (ms) that message is sent out
     * @var \DateTime $requestTimestamp
     */
    private \DateTime $requestTimestamp;

    /**
     * Data type. snapshot
     * @var string $type
     */
    private string $type;

    /**
     * Trade ID
     * @var string $tradeId
     */
    private string $tradeId;

    /**
     * Timestamp (trading time in the match box)
     * @var \DateTime $tradingTime
     */
    private \DateTime $tradingTime;

    /**
     * Price
     * @var float $price
     */
    private float $price;

    /**
     * Quantity
     * @var float $quantity
     */
    private float $quantity;

    /**
     * True indicates buy side is taker, false indicates sell side is taker
     * @var bool $isTaker
     */
    private bool $isTaker;

    /**
     * Trade type. 0：Spot trade. 1：Paradigm block trade
     * @var int $tradeType
     */
    private int $tradeType;

    public function __construct(array $data)
    {
        $this
            ->setTopic($data['topic'] ?? null)
            ->setRequestTimestamp($data['ts'] ?? null)
            ->setType($data['type'] ?? null)
            ->setTradeId($data['data']['v'] ?? null)
            ->setTradingTime($data['data']['t'] ?? null)
            ->setPrice($data['data']['p'] ?? null)
            ->setQuantity($data['data']['q'] ?? null)
            ->setTradeType($data['data']['m'] ?? null)
            ->setIsTaker($data['data']['type'] ?? null);
    }

    /**
     * @param string $topic
     * @return PublicTradeAbstract
     */
    private function setTopic(string $topic): self
    {
        $this->topic = $topic;
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
     * @param string $type
     * @return PublicTradeAbstract
     */
    private function setType(string $type): self
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param float $price
     * @return PublicTradeAbstract
     */
    private function setPrice(float $price): self
    {
        $this->price = $price;
        return $this;
    }

    /**
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * @param float $quantity
     * @return PublicTradeAbstract
     */
    private function setQuantity(float $quantity): self
    {
        $this->quantity = $quantity;
        return $this;
    }

    /**
     * @return float
     */
    public function getQuantity(): float
    {
        return $this->quantity;
    }

    /**
     * @param string $tradeId
     * @return PublicTradeAbstract
     */
    private function setTradeId(string $tradeId): self
    {
        $this->tradeId = $tradeId;
        return $this;
    }

    /**
     * @return string
     */
    public function getTradeId(): string
    {
        return $this->tradeId;
    }

    /**
     * @param int $tradeType
     * @return PublicTradeAbstract
     */
    private function setTradeType(int $tradeType): self
    {
        $this->tradeType = $tradeType;
        return $this;
    }

    /**
     * @return int
     */
    public function getTradeType(): int
    {
        return $this->tradeType;
    }

    /**
     * @param string $tradingTime
     * @return PublicTradeAbstract
     */
    private function setTradingTime(string $tradingTime): self
    {
        $this->tradingTime = DateTimeHelper::makeFromTimestamp($tradingTime);
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getTradingTime(): \DateTime
    {
        return $this->tradingTime;
    }

    /**
     * @param string $requestTimestamp
     * @return PublicTradeAbstract
     */
    private function setRequestTimestamp(string $requestTimestamp): self
    {
        $this->requestTimestamp = DateTimeHelper::makeFromTimestamp($requestTimestamp);
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getRequestTimestamp(): \DateTime
    {
        return $this->requestTimestamp;
    }

    /**
     * @param bool $isTaker
     * @return PublicTradeAbstract
     */
    private function setIsTaker(bool $isTaker): self
    {
        $this->isTaker = $isTaker;
        return $this;
    }

    /**
     * @return bool
     */
    public function getIsTaker(): bool
    {
        return $this->isTaker;
    }
}