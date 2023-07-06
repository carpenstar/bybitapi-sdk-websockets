<?php
namespace Carpenstar\ByBitAPI\WebSockets\Objects\WebSockets;

use Carpenstar\ByBitAPI\WebSockets\Interfaces\IWebSocketArgumentInterface;

abstract class WebSocketArgument implements IWebSocketArgumentInterface
{
    protected ?string $reqId;

    protected array $symbols;

    public function __construct(string $symbol, ?string $reqId = null)
    {
        $this
            ->setSymbols($symbol)
            ->setReqId($reqId);
    }

    abstract public function getOperation(): string;

    /**
     * @param string|null $reqId
     * @return self
     */
    protected function setReqId(?string $reqId): self
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
     * @param string $symbol
     * @return self
     */
    protected function setSymbols(string $symbol): self
    {
        $this->symbols = explode(',', $symbol);
        return $this;
    }

    /**
     * @return string
     */
    public function getSymbols(): array
    {
        return $this->symbols;
    }
}