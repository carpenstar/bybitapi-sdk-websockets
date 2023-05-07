<?php
namespace Carpenstar\ByBitAPI\WebSockets\Channels\Spot\PublicChannels\Kline;

use Carpenstar\ByBitAPI\Core\Enums\EnumIntervals;
use Carpenstar\ByBitAPI\WebSockets\Interfaces\IWebSocketArgumentInterface;
use Carpenstar\ByBitAPI\WebSockets\Objects\WebSocketArguments;

class KlineArgumentsDTO extends WebSocketArguments
{
    private string $topicName = 'kline';

    private string $operation = 'subscribe';

    private string $interval;

    private string $symbol;

    private ?string $reqId;

    private ?int $socketClientTimeout = IWebSocketArgumentInterface::DEFAULT_SOCKET_CLIENT_TIMEOUT;

    public function __construct(string $interval, string $symbol, ?string $reqId = null, ?int $socketClientTimeout = null)
    {
        $this
            ->setInterval($interval)
            ->setSymbol($symbol)
            ->setReqId($reqId);
    }

    /**
     * @param int|null $socketClientTimeout
     * @return KlineArgumentsDTO
     */
    private function setSocketClientTimeout(?int $socketClientTimeout): self
    {
        $this->socketClientTimeout = $socketClientTimeout;
        return $this;
    }

    /**
     * @return int
     */
    public function getSocketClientTimeout(): int
    {
        return $this->socketClientTimeout;
    }

    /**
     * @return array
     */
    public function getTopic(): array
    {
        return ["$this->topicName.{$this->getInterval()}.{$this->getSymbol()}"];
    }

    /**
     * @return string
     */
    public function getOperation(): string
    {
        return $this->operation;
    }

    /**
     * @param string|null $reqId
     * @return self
     */
    private function setReqId(?string $reqId): self
    {
        $this->reqId = $reqId;
        return $this;
    }

    /**
     * @return string
     */
    public function getReqId(): string
    {
        return $this->reqId;
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
    public function getInterval(): string
    {
        return $this->interval;
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

}