<?php
namespace Carpenstar\ByBitAPI\WebSockets\Objects\Channels;

class DefaultChannelHandler extends ChannelHandler
{
    public  function handle($data): void
    {
        var_dump($data);
    }
}