<?php
namespace Carpenstar\ByBitAPI\WebSockets\Channels\Derivatives\PublicChannels\Tickers;

use Carpenstar\ByBitAPI\Core\Helpers\DateTimeHelper;
use Carpenstar\ByBitAPI\Core\Objects\ResponseEntity;

/**
 * https://bybit-exchange.github.io/docs/derivatives/ws-public/ticker
 */
class TickersDataItemDTO extends ResponseEntity
{
    /**
     * Symbol name
     * @var string $symbol
     */
    private ?string $symbol;

    /**
     * Tick direction
     * @var string $tickDirection
     */
    private ?string $tickDirection;

    /**
     * Percentage change of market price in the last 24 hours
     * @var string $price24hPcnt
     */
    private ?float $price24hPcnt;

    /**
     * Last price
     * @var float $lastPrice
     */
    private ?float $lastPrice;

    /**
     * Market price 24 hours ago
     * @var float $prevPrice24h
     */
    private ?float $prevPrice24h;

    /**
     * The highest price in the last 24 hours
     * @var float $highPrice24h
     */
    private ?float $highPrice24h;

    /**
     * The lowest price in the last 24 hours
     * @var float $lowPrice24h
     */
    private ?float $lowPrice24h;

    /**
     * Market price an hour ago
     * @var float $prevPrice1h
     */
    private ?float $prevPrice1h;

    /**
     * Mark price
     * @var float $markPrice
     */
    private ?float $markPrice;

    /**
     * Index price
     * @var float $indexPrice
     */
    private ?float $indexPrice;

    /**
     * Open interest size
     * @var float $openInterest
     */
    private ?float $openInterest;

    /**
     * openInterestValue
     * @var float $openInterestValue
     */
    private ?float $openInterestValue;

    /**
     * Turnover for 24h
     * @var float $turnover24h
     */
    private ?float $turnover24h;

    /**
     * Volume for 24h
     * @var float $volume24h
     */
    private ?float $volume24h;

    /**
     * Next funding timestamp (ms)
     * @var \DateTime $nextFundingTime
     */
    private ?\DateTime $nextFundingTime;

    /**
     * Funding rate
     * @var float $fundingRate
     */
    private ?float $fundingRate;

    /**
     * Best bid price
     * @var float $bid1Price
     */
    private ?float $bid1Price;

    /**
     * Best bid size
     * @var float $bid1Size
     */
    private ?float $bid1Size;

    /**
     * Best ask price
     * @var float $ask1Price
     */
    private ?float $ask1Price;

    /**
     * Best ask size
     * @var float $ask1Size
     */
    private ?float $ask1Size;

    public function __construct(array $data)
    {
        $this
            ->setSymbol($data['symbol'] ?? null)
            ->setTickDirection($data['tickDirection'] ?? null)
            ->setPrice24hPcnt($data['price24hPcnt'] ?? null)
            ->setLastPrice($data['lastPrice'] ?? null)
            ->setPrevPrice24h($data['prevPrice24h'] ?? null)
            ->setHighPrice24h($data['highPrice24h'] ?? null)
            ->setLowPrice24h($data['lowPrice24h'] ?? null)
            ->setPrevPrice1h($data['prevPrice1h'] ?? null)
            ->setMarkPrice($data['markPrice'] ?? null)
            ->setIndexPrice($data['indexPrice'] ?? null)
            ->setOpenInterest($data['openInterest'] ?? null)
            ->setOpenInterestValue($data['openInterestValue'] ?? null)
            ->setTurnover24h($data['turnover24h'] ?? null)
            ->setVolume24h($data['volume24h'] ?? null)
            ->setNextFundingTime($data['nextFundingTime'] ?? null)
            ->setFundingRate($data['fundingRate'] ?? null)
            ->setBid1Price($data['bid1Price'] ?? null)
            ->setBid1Size($data['bid1Size'] ?? null)
            ->setAsk1Price($data['ask1Price'] ?? null)
            ->setAsk1Size($data['ask1Size'] ?? null);
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
     * @param string|null $tickDirection
     * @return self
     */
    private function setTickDirection(?string $tickDirection): self
    {
        $this->tickDirection = $tickDirection;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getTickDirection(): ?string
    {
        return $this->tickDirection;
    }

    /**
     * @param float|null $price24hPcnt
     * @return self
     */
    private function setPrice24hPcnt(?float $price24hPcnt): self
    {
        $this->price24hPcnt = $price24hPcnt;
        return $this;
    }

    /**
     * @return float|null
     */
    public function getPrice24hPcnt(): ?float
    {
        return $this->price24hPcnt;
    }

    /**
     * @param float|null $lastPrice
     * @return self
     */
    private function setLastPrice(?float $lastPrice): self
    {
        $this->lastPrice = $lastPrice;
        return $this;
    }

    /**
     * @return float|null
     */
    public function getLastPrice(): ?float
    {
        return $this->lastPrice;
    }

    /**
     * @param float|null $prevPrice24h
     * @return self
     */
    private function setPrevPrice24h(?float $prevPrice24h): self
    {
        $this->prevPrice24h = $prevPrice24h;
        return $this;
    }

    /**
     * @return float|null
     */
    public function getPrevPrice24h(): ?float
    {
        return $this->prevPrice24h;
    }

    /**
     * @param float|null $highPrice24h
     * @return self
     */
    private function setHighPrice24h(?float $highPrice24h): self
    {
        $this->highPrice24h = $highPrice24h;
        return $this;
    }

    /**
     * @return float|null
     */
    public function getHighPrice24h(): ?float
    {
        return $this->highPrice24h;
    }

    /**
     * @param float|null $lowPrice24h
     * @return self
     */
    private function setLowPrice24h(?float $lowPrice24h): self
    {
        $this->lowPrice24h = $lowPrice24h;
        return $this;
    }

    /**
     * @return float|null
     */
    public function getLowPrice24h(): ?float
    {
        return $this->lowPrice24h;
    }

    /**
     * @param float|null $prevPrice1h
     * @return self
     */
    private function setPrevPrice1h(?float $prevPrice1h): self
    {
        $this->prevPrice1h = $prevPrice1h;
        return $this;
    }

    /**
     * @return float|null
     */
    public function getPrevPrice1h(): ?float
    {
        return $this->prevPrice1h;
    }

    /**
     * @param float|null $markPrice
     * @return self
     */
    private function setMarkPrice(?float $markPrice): self
    {
        $this->markPrice = $markPrice;
        return $this;
    }

    /**
     * @return float|null
     */
    public function getMarkPrice(): ?float
    {
        return $this->markPrice;
    }

    /**
     * @param float|null $indexPrice
     * @return self
     */
    private function setIndexPrice(?float $indexPrice): self
    {
        $this->indexPrice = $indexPrice;
        return $this;
    }

    /**
     * @return float|null
     */
    public function getIndexPrice(): ?float
    {
        return $this->indexPrice;
    }

    /**
     * @param float|null $openInterest
     * @return self
     */
    private function setOpenInterest(?float $openInterest): self
    {
        $this->openInterest = $openInterest;
        return $this;
    }

    /**
     * @return float|null
     */
    public function getOpenInterest(): ?float
    {
        return $this->openInterest;
    }

    /**
     * @param float|null $openInterestValue
     * @return self
     */
    private function setOpenInterestValue(?float $openInterestValue): self
    {
        $this->openInterestValue = $openInterestValue;
        return $this;
    }

    /**
     * @return float|null
     */
    public function getOpenInterestValue(): ?float
    {
        return $this->openInterestValue;
    }

    /**
     * @param float|null $turnover24h
     * @return self
     */
    private function setTurnover24h(?float $turnover24h): self
    {
        $this->turnover24h = $turnover24h;
        return $this;
    }

    /**
     * @return float|null
     */
    public function getTurnover24h(): ?float
    {
        return $this->turnover24h;
    }

    /**
     * @param float|null $volume24h
     * @return self
     */
    private function setVolume24h(?float $volume24h): self
    {
        $this->volume24h = $volume24h;
        return $this;
    }

    /**
     * @return float
     */
    public function getVolume24h(): float
    {
        return $this->volume24h;
    }

    /**
     * @param string|null $nextFundingTime
     * @return self
     */
    private function setNextFundingTime(?string $nextFundingTime): self
    {
        if (!empty($nextFundingTime)) {
            $this->nextFundingTime =  DateTimeHelper::makeFromTimestamp($nextFundingTime);
        }
        return $this;
    }

    /**
     * @return \DateTime|null
     */
    public function getNextFundingTime(): ?\DateTime
    {
        return $this->nextFundingTime;
    }

    /**
     * @param float|null $fundingRate
     * @return self
     */
    private function setFundingRate(?float $fundingRate): self
    {
        $this->fundingRate = $fundingRate;
        return $this;
    }

    /**
     * @return float|null
     */
    public function getFundingRate(): ?float
    {
        return $this->fundingRate;
    }

    /**
     * @param float|null $bid1Price
     * @return self
     */
    private function setBid1Price(?float $bid1Price): self
    {
        $this->bid1Price = $bid1Price;
        return $this;
    }

    /**
     * @return float|null
     */
    public function getBid1Price(): ?float
    {
        return $this->bid1Price;
    }

    /**
     * @param float|null $bid1Size
     * @return self
     */
    private function setBid1Size(?float $bid1Size): self
    {
        $this->bid1Size = $bid1Size;
        return $this;
    }

    /**
     * @return float|null
     */
    public function getBid1Size(): ?float
    {
        return $this->bid1Size;
    }

    /**
     * @param float|null $ask1Price
     * @return self
     */
    private function setAsk1Price(?float $ask1Price): self
    {
        $this->ask1Price = $ask1Price;
        return $this;
    }

    /**
     * @return float|null
     */
    public function getAsk1Price(): ?float
    {
        return $this->ask1Price;
    }

    /**
     * @param float|null $ask1Size
     * @return self
     */
    private function setAsk1Size(?float $ask1Size): self
    {
        $this->ask1Size = $ask1Size;
        return $this;
    }

    /**
     * @return float|null
     */
    public function getAsk1Size(): ?float
    {
        return $this->ask1Size;
    }
}