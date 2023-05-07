<?php
namespace Carpenstar\ByBitAPI\WebSockets\Channels\Spot\PublicChannels\Bookticker;

use Carpenstar\ByBitAPI\Core\Helpers\DateTimeHelper;
use Carpenstar\ByBitAPI\Core\Objects\ResponseEntity;

class BooktickerDTO extends ResponseEntity
{
    /**
     * Topic name
     * @var string
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
     * Trading pair
     * @var string
     */
    private string $symbol;

    /**
     * Best bid price
     * @var float $bestBidPrice
     */
    private float $bestBidPrice;

    /**
     * Bid quantity
     * @var float $bidQuantity
     */
    private float $bidQuantity;

    /**
     * Best ask price
     * @var float $bestAskPrice
     */
    private float $bestAskPrice;

    /**
     * Ask quantity
     * @var float $askQuantity
     */
    private float $askQuantity;

    /**
     * @var \DateTime $responseTimestamp
     */
    private \DateTime $responseTimestamp;

    public function __construct(array $data)
    {
        $this
            ->setTopic($data['topic'])
            ->setRequestTimestamp($data['ts'])
            ->setType($data['type'])
            ->setSymbol($data['data']['s'])
            ->setBestAskPrice($data['data']['bp'])
            ->setAskQuantity($data['data']['aq'])
            ->setBestBidPrice($data['data']['bq'])
            ->setBidQuantity($data['data']['bq'])
            ->setResponseTimestamp($data['data']['t']);
    }

    /**
     * @param string $responseTimestamp
     * @return BooktickerDTO
     */
    public function setResponseTimestamp(string $responseTimestamp): self
    {
        $this->responseTimestamp = DateTimeHelper::makeFromTimestamp($responseTimestamp);
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getResponseTimestamp(): \DateTime
    {
        return $this->responseTimestamp;
    }

    /**
     * @param float $bestBidPrice
     * @return BooktickerDTO
     */
    private function setBestBidPrice(float $bestBidPrice): self
    {
        $this->bestBidPrice = $bestBidPrice;
        return $this;
    }

    /**
     * @return float
     */
    public function getBestBidPrice(): float
    {
        return $this->bestBidPrice;
    }

    /**
     * @param float $bidQuantity
     * @return BooktickerDTO
     */
    private function setBidQuantity(float $bidQuantity): self
    {
        $this->bidQuantity = $bidQuantity;
        return $this;
    }

    /**
     * @return float
     */
    public function getBidQuantity(): float
    {
        return $this->bidQuantity;
    }

    /**
     * @param float $bestAskPrice
     * @return BooktickerDTO
     */
    private function setBestAskPrice(float $bestAskPrice): self
    {
        $this->bestAskPrice = $bestAskPrice;
        return $this;
    }

    /**
     * @return float
     */
    public function getBestAskPrice(): float
    {
        return $this->bestAskPrice;
    }

    /**
     * @param float $askQuantity
     * @return BooktickerDTO
     */
    public function setAskQuantity(float $askQuantity): self
    {
        $this->askQuantity = $askQuantity;
        return $this;
    }

    /**
     * @return float
     */
    public function getAskQuantity(): float
    {
        return $this->askQuantity;
    }

    /**
     * @param string $symbol
     * @return BooktickerDTO
     */
    public function setSymbol(string $symbol): self
    {
        $this->symbol = $symbol;
        return $this;
    }

    /**
     * @return string
     */
    public function getSymbol(): string
    {
        return $this->symbol;
    }

    /**
     * @param string $topic
     * @return BooktickerDTO
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
     * @param string $requestTimestamp
     * @return BooktickerDTO
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
     * @param string $type
     * @return BooktickerDTO
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
}