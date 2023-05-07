<?php
namespace Carpenstar\ByBitAPI\WebSockets\Objects\WebSockets;

use Carpenstar\ByBitAPI\WebSockets\Interfaces\IWebSocketArgumentInterface;

abstract class WebSocketArgument implements IWebSocketArgumentInterface
{
    protected ?string $reqId;

    protected ?string $symbol;


    public function __construct(string $symbol, ?string $reqId = null)
    {
        $this
            ->setSymbol($symbol)
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
    protected function setSymbol(string $symbol): self
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