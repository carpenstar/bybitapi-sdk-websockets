<?php
namespace Carpenstar\ByBitAPI\WebSockets\Interfaces;


interface IWebSocketsChannelInterface
{
    public function __construct(IWebSocketArgumentInterface $arguments, IChannelHandlerInterface $channelHandler);

    /**
     * @return array
     */
    public function getTopic(): array;

    /**
     * @return string
     */
    public function getOperation(): string;

    /**
     * @return string
     */
    public function getResponseClassname(): string;

    /**
     * @return void
     */
    public function execute(): void;
}