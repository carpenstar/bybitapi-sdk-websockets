<?php
namespace Carpenstar\ByBitAPI\WebSockets\Interfaces;

interface IWebSocketArgumentInterface
{
    const DEFAULT_SOCKET_CLIENT_TIMEOUT = 1000;

    public function getTopic(): array;
}