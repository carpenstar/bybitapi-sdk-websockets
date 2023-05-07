<?php
namespace Carpenstar\ByBitAPI\WebSockets\Channels\Spot\PublicChannels\OrderBook\Entities;

use Carpenstar\ByBitAPI\Core\Builders\ResponseBuilder;
use Carpenstar\ByBitAPI\Core\Helpers\DateTimeHelper;
use Carpenstar\ByBitAPI\Core\Interfaces\ICollectionInterface;
use Carpenstar\ByBitAPI\Core\Objects\Collection\EntityCollection;
use Carpenstar\ByBitAPI\Core\Objects\ResponseEntity;

class OrderBookEntity extends ResponseEntity
{
    /**
     * Topic name
     * @var string $topic
     */
    private string $topic;

    /**
     * Data type. snapshot
     * @var string $type
     */
    private string $type;

    /**
     * Trading pair
     * @var string $symbol
     */
    private string $symbol;

    /**
     * The timestamp that message is sent out
     * @var \DateTime $requestTimestamp
     */
    private \DateTime $requestTimestamp;

    /**
     * The timestamp that system generates the data.
     * @var \DateTime $responseTimestamp
     */
    private \DateTime $responseTimestamp;

    /**
     * @var ICollectionInterface $ask
     */
    private ICollectionInterface $ask;

    /**
     * @var ICollectionInterface $bid
     */
    private ICollectionInterface $bid;

    public function __construct(array $data)
    {
        $this
            ->setSymbol($data['data']['s'] ?? null)
            ->setTopic($data['topic'] ?? null)
            ->setType($data['type'] ?? null)
            ->setBid($data['data']['b'] ?? null)
            ->setAsk($data['data']['a'] ?? null)
            ->setRequestTimestamp($data['ts'] ?? null)
            ->setResponseTimestamp($data['data']['t'] ?? null);
    }

    /**
     * @param string $topic
     * @return self
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
     * @return self
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
     * @param string $symbol
     * @return self
     */
    private function setSymbol(string $symbol): self
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
     * @param string $timestamp
     * @return self
     */
    private function setRequestTimestamp(string $timestamp): self
    {
        $this->requestTimestamp = DateTimeHelper::makeFromTimestamp($timestamp);
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
     * @param string $timestamp
     * @return self
     */
    private function setResponseTimestamp(string $timestamp): self
    {
        $this->responseTimestamp = DateTimeHelper::makeFromTimestamp($timestamp);
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
     * @param $asks
     * @return self
     * @throws \Exception
     */
    private function setAsk($asks): self
    {
        $askCollection = new EntityCollection();

        if (!empty($asks)) {
            array_map(function ($askItem) use ($askCollection) {
                $askCollection->push(ResponseBuilder::make(OrderBookPriceDTO::class, $askItem));
            }, $asks);
        }

        $this->ask = $askCollection;
        return $this;
    }

    /**
     * @return ICollectionInterface
     */
    public function getAsk(): ICollectionInterface
    {
        return $this->ask;
    }

    /**
     * @param array $bids
     * @return OrderBookEntity
     * @throws \Exception
     */
    private function setBid(array $bids): self
    {
        $bidCollection = new EntityCollection();

        if (!empty($bids)) {
            array_map(function ($bidItem) use ($bidCollection) {
                $bidCollection->push(ResponseBuilder::make(OrderBookPriceDTO::class, $bidItem));
            }, $bids);
        }

        $this->bid = $bidCollection;
        return $this;
    }

    /**
     * @return ICollectionInterface
     */
    public function getBid(): ICollectionInterface
    {
        return $this->bid;
    }
}