# ByBitAPI - websockets package

### Install

```sh 
composer require carpenstar/bybitapi-sdk-websockets
```

### Available channels:

###### SPOT - PUBLIC CHANNEL - ORDER BOOK
https://bybit-exchange.github.io/docs/spot/ws-public/orderbook

```php
use Carpenstar\ByBitAPI\BybitAPI;
use Carpenstar\ByBitAPI\WebSockets\Channels\Spot\PublicChannels\PublicTrade\Argument\PublicTradeArgument;
use Carpenstar\ByBitAPI\WebSockets\Channels\Spot\PublicChannels\PublicTrade\PublicTradeChannel;

$bybit = new BybitAPI("https://api-testnet.bybit.com", "apiKey", "secret");
$channelArgument = new PublicTradeArgument("BTCUSDT"); // string $symbol, [?string $reqId = null]
$channelHandler = new DefaultChannelHandler();
$bybit->websocket(PublicTradeChannel::class, $channelArgument, $channelHandler);
```


###### SPOT - PUBLIC CHANNEL - KLINE
https://bybit-exchange.github.io/docs/spot/ws-public/kline

```php
use Carpenstar\ByBitAPI\BybitAPI;
use Carpenstar\ByBitAPI\WebSockets\Channels\Spot\PublicChannels\PublicTrade\Argument\PublicTradeArgument;
use Carpenstar\ByBitAPI\WebSockets\Channels\Spot\PublicChannels\PublicTrade\PublicTradeChannel;
use Carpenstar\ByBitAPI\Core\Enums\EnumIntervals;

$bybit = new BybitAPI("https://api-testnet.bybit.com", "apiKey", "secret");
$channelArgument = new KlineArgument(EnumIntervals::HOUR_1, "BTCUSDT"); // string $interval, string $symbol, [?string $reqId = null]
$channelHandler = new DefaultChannelHandler();
$bybit->websocket(KlineChannel::class, $channelArgument, $channelHandler);
```

###### SPOT - PUBLIC CHANNEL - BOOKTICKER
https://bybit-exchange.github.io/docs/spot/ws-public/bookticker

```php
use Carpenstar\ByBitAPI\BybitAPI;
use Carpenstar\ByBitAPI\WebSockets\Channels\Spot\PublicChannels\PublicTrade\Argument\PublicTradeArgument;
use Carpenstar\ByBitAPI\WebSockets\Channels\Spot\PublicChannels\PublicTrade\PublicTradeChannel;

$bybit = new BybitAPI("https://api-testnet.bybit.com", "apiKey", "secret");
$channelArgument = new BooktickerArgument("BTCUSDT"); // string $symbol, [?string $reqId = null]
$channelHandler = new DefaultChannelHandler();
$bybit->websocket(BooktickerChannel::class, $channelArgument, $channelHandler);
```

###### SPOT - PUBLIC CHANNEL - TICKERS
https://bybit-exchange.github.io/docs/spot/ws-public/ticker

###### SPOT - PUBLIC CHANNEL - PUBLIC TRADE
https://bybit-exchange.github.io/docs/spot/ws-public/public-trade

