<?php
namespace Carpenstar\ByBitAPI\WebSockets\Channels\Spot\PublicChannels\Tickers\Entities;

use Carpenstar\ByBitAPI\Core\Builders\ResponseBuilder;
use Carpenstar\ByBitAPI\Core\Helpers\DateTimeHelper;
use Carpenstar\ByBitAPI\Core\Interfaces\ICollectionInterface;
use Carpenstar\ByBitAPI\Core\Objects\Collection\EntityCollection;
use Carpenstar\ByBitAPI\Core\Objects\ResponseEntity;

/**
 * https://bybit-exchange.github.io/docs/derivatives/ws-public/ticker
 * Get latest information of the symbol
 * Future has snapshot and delta types. If a key does not exist in the field, it means the value is not changed.
 * Option has snapshot data only.
 *
 * Topic: tickers.{symbol}
 *
 * Push frequency: 100ms
 */
class TickersEntity extends ResponseEntity
{
    private ?string $topic;

    private ?string $type;

    private \DateTime $timestamp;

    private ?ICollectionInterface $data;

    public function __construct(array $data)
    {
        $this->data = new EntityCollection();
        $this
            ->setTopic($data['topic'])
            ->setType($data['type'])
            ->setData($data['data'])
            ->setTimestamp($data['ts']);
    }

    /**
     * @param string|null $topic
     * @return self
     */
    private function setTopic(?string $topic): self
    {
        $this->topic = $topic;
        return $this;
    }

    /**
     * @return string
     */
    public function getTopic(): ?string
    {
        return $this->topic;
    }

    /**
     * @param string|null $type
     * @return self
     */
    private function setType(?string $type): self
    {
        $this->type = $type;
        return $this;
    }
    /**
     * @return string
     */
    public function getType(): ?string
    {
        return $this->type;
    }

    /**
     * @param string $timestamp
     * @return self
     */
    private function setTimestamp(string $timestamp): self
    {
        $this->timestamp = DateTimeHelper::makeFromTimestamp($timestamp);
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getTimestamp(): \DateTime
    {
        return $this->timestamp;
    }

    private function setData(array $data): self
    {
        if (!empty($data)) {
            $this->data->push(ResponseBuilder::make(TickersItemEntity::class, $data));
        }
        return $this;
    }

    public function getData(): ICollectionInterface
    {
        return $this->data;
    }
}