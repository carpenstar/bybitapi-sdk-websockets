<?php
namespace Carpenstar\ByBitAPI\WebSockets\Channels\Derivatives\PublicChannels\OrderBook\Entities;

use Carpenstar\ByBitAPI\Core\Objects\ResponseEntity;

class OrderBookPriceEntity extends ResponseEntity
{
    /**
     * @var float $price
     */
    private float $price;

    /**
     * @var float $size
     */
    private float $size;

    public function __construct(array $data)
    {
        $this
            ->setPrice($data[0])
            ->setSize($data[1]);
    }

    /**
     * @param float $price
     * @return self
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
     * @param float $size
     * @return self
     */
    private function setSize(float $size): self
    {
        $this->size = $size;
        return $this;
    }

    /**
     * @return float
     */
    public function getSize(): float
    {
        return $this->size;
    }
}