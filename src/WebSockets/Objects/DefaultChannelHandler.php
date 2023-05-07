<?php
namespace Carpenstar\ByBitAPI\WebSockets\Objects;

class DefaultChannelHandler extends ChannelHandler
{
    public  function handle($data): void
    {
        var_dump($data);
    }
}