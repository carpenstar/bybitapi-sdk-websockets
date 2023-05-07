<?php
namespace Carpenstar\ByBitAPI\WebSockets\Channels\Derivatives\PublicChannels\OrderBook;

use Carpenstar\ByBitAPI\Core\Fabrics\ResponseFabric;
use Carpenstar\ByBitAPI\Core\Interfaces\ICollectionInterface;
use Carpenstar\ByBitAPI\Core\Objects\Collection\EntityCollection;
use Carpenstar\ByBitAPI\Core\Objects\ResponseEntity;
use Carpenstar\ByBitAPI\WebSockets\Channels\Spot\PublicChannels\OrderBook\OrderBookPriceDTO;

class OrderBookDTO extends ResponseEntity
{

    /**
     * Topic name
     * @var string $topic
     */
    private string $topic;

    /**
     * Message type. snapshot,delta
     * @var string $type
     */
    private string $type;

    /**
     * @var string
     */
    private string $symbol;

    /**
     * @var \DateTime $timestamp
     */
    private \DateTime $timestamp;

    /**
     * @var ICollectionInterface $bid
     */
    private ICollectionInterface $bid;

    /**
     * @var ICollectionInterface $ask
     */
    private ICollectionInterface $ask;

    /**
     * Update id, is always in sequence. Occasionally, you'll receive "u"=1,
     * which is a snapshot data due to the restart of the service.
     * So please overwrite the locally saved orderbook
     * @var null|int $updateId
     */
    private ?int $updateId;

    /**
     * @var null|int $crossSequence
     */
    private ?int $crossSequence;

    public function __construct(array $data)
    {
        $this
            ->setTopic($data['topic'])
            ->setType($data['type'])
            ->setSymbol($data['data']['s'])
            ->setBid($data['data']['b'])
            ->setAsk($data['data']['a'])
            ->setUpdateId($data['data']['u'])
            ->setCrossSequence($data['data']['seq']);
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
     * @return ICollectionInterface
     */
    public function getAsk(): ICollectionInterface
    {
        return $this->ask;
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
     * @param array $asks
     * @return OrderBookDTO
     * @throws \Exception
     */
    private function setAsk(array $asks): self
    {
        $askCollection = new EntityCollection();

        if (!empty($asks)) {
            array_map(function ($askItem) use ($askCollection) {
                $askCollection->push(ResponseFabric::make(OrderBookPriceDTO::class, $askItem));
            }, $asks);
        }

        $this->ask = $askCollection;
        return $this;
    }

    /**
     * @param array $bids
     * @return OrderBookDTO
     * @throws \Exception
     */
    private function setBid(array $bids): self
    {
        $bidCollection = new EntityCollection();

        if (!empty($bids)) {
            array_map(function ($bidItem) use ($bidCollection) {
                $bidCollection->push(ResponseFabric::make(OrderBookPriceDTO::class, $bidItem));
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

    /**
     * @param int|null $updateId
     * @return self
     */
    private function setUpdateId(?int $updateId): self
    {
        $this->updateId = $updateId;
        return $this;
    }

    /**
     * @return int
     */
    public function getUpdateId(): int
    {
        return $this->updateId;
    }

    /**
     * @param int|null $crossSequence
     * @return self
     */
    private function setCrossSequence(?int $crossSequence): self
    {
        $this->crossSequence = $crossSequence;
        return $this;
    }

    /**
     * @return int
     */
    public function getCrossSequence(): int
    {
        return $this->crossSequence;
    }
}