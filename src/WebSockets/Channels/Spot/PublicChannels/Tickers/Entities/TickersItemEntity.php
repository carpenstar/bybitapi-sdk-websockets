<?php
namespace Carpenstar\ByBitAPI\WebSockets\Channels\Spot\PublicChannels\Tickers\Entities;

use Carpenstar\ByBitAPI\Core\Helpers\DateTimeHelper;
use Carpenstar\ByBitAPI\Core\Objects\ResponseEntity;

/**
 * https://bybit-exchange.github.io/docs/derivatives/ws-public/ticker
 */
class TickersItemEntity extends ResponseEntity
{
    /**
     * Trading pair
     * @var string $symbol
     */
    private string $symbol;

    /**
     * Timestamp (trading time in the match box)
     * @var null|\DateTime $timestamp
     */
    private ?\DateTime $timestamp;

    /**
     * Open price
     * @var float $openPrice
     */
    private float $openPrice;

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
     * Close price
     * @var float $closePrice
     */
    private float $closePrice;

    /**
     * Trading volume
     * @var float $tradingVolume
     */
    private float $tradingVolume;

    /**
     * Trading quote volume
     * @var float $tradinguoteVolume
     */
    private float $tradinqQuoteVolume;

    /**
     * Change
     * @var float $change
     */
    private float $change;

    /**
     * USD index price. It can be empty
     * @var null|string $usdIndexPrice
     */
    private ?string $usdIndexPrice;

    public function __construct(array $data)
    {
        $this
            ->setSymbol($data['s'] ?? null)
            ->setTimestamp($data['t'] ?? null)
            ->setOpenPrice($data['o'] ?? null)
            ->setHighPrice($data['h'] ?? null)
            ->setLowPrice($data['l'] ?? null)
            ->setClosePrice($data['c'] ?? null)
            ->setTradingVolume($data['v'] ?? null)
            ->setTradingQuoteVolume($data['qv'] ?? null)
            ->setChange($data['m'] ?? null)
            ->setUsdIndexPrice($data['xp'] ?? null);
    }

    /**
     * @param string|null $symbol
     * @return self
     */
    private function setSymbol(?string $symbol): self
    {
        $this->symbol = $symbol;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getSymbol(): ?string
    {
        return $this->symbol;
    }

    /**
     * @param float|null $openPrice
     * @return self
     */
    private function setOpenPrice(?float $openPrice): self
    {
        $this->openPrice = $openPrice;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getOpenPrice(): ?float
    {
        return $this->openPrice;
    }

    /**
     * @param float|null $highPrice
     * @return self
     */
    private function setHighPrice(?float $highPrice): self
    {
        $this->highPrice = $highPrice;
        return $this;
    }

    /**
     * @return float|null
     */
    public function getHighPrice(): ?float
    {
        return $this->highPrice;
    }

    /**
     * @param float|null $lowPrice
     * @return self
     */
    private function setLowPrice(?float $lowPrice): self
    {
        $this->lowPrice = $lowPrice;
        return $this;
    }

    /**
     * @return float|null
     */
    public function getLowPrice(): ?float
    {
        return $this->lowPrice;
    }

    /**
     * @param float|null $closePrice
     * @return self
     */
    private function setClosePrice(?float $closePrice): self
    {
        $this->closePrice = $closePrice;
        return $this;
    }

    /**
     * @return float|null
     */
    public function getClosePrice(): ?float
    {
        return $this->closePrice;
    }

    /**
     * @param float|null $tradingVolume
     * @return self
     */
    private function setTradingVolume(?float $tradingVolume): self
    {
        $this->tradingVolume = $tradingVolume;
        return $this;
    }

    /**
     * @return float|null
     */
    public function getTradingVolume(): ?float
    {
        return $this->tradingVolume;
    }

    /**
     * @param float|null $tradingQuoteVolume
     * @return self
     */
    private function setTradingQuoteVolume(?float $tradingQuoteVolume): self
    {
        $this->tradinqQuoteVolume = $tradingQuoteVolume;
        return $this;
    }

    /**
     * @return float|null
     */
    public function getTradingQuoteVolume(): ?float
    {
        return $this->tradinqQuoteVolume;
    }

    /**
     * @param float|null $change
     * @return self
     */
    private function setChange(?float $change): self
    {
        $this->change = $change;
        return $this;
    }

    /**
     * @return float|null
     */
    public function getChange(): ?float
    {
        return $this->change;
    }

    /**
     * @param string|null $usdIndexPrice
     * @return self
     */
    private function setUsdIndexPrice(?string $usdIndexPrice): self
    {
        $this->usdIndexPrice = $usdIndexPrice;
        return $this;
    }

    /**
     * @return float|null
     */
    public function getUsdIndexPrice(): ?string
    {
        return $this->usdIndexPrice;
    }

    /**
     * @param string|null $nextFundingTime
     * @return self
     */
    private function setTimestamp(?string $timestamp): self
    {
        if (!empty($timestamp)) {
            $this->timestamp =  DateTimeHelper::makeFromTimestamp($timestamp);
        }
        return $this;
    }

    /**
     * @return \DateTime|null
     */
    public function getTimestamp(): ?\DateTime
    {
        return $this->timestamp;
    }
}