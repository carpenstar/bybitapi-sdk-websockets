# ByBitAPI - websockets package

**Дисклэймер: это неофициальный SDK от биржи ByBit.   
Поддержка функционала осуществляется только в пределах зоны отвественности кода и при возможности со стороны разработчика**

**Разработка интеграции еще не закончена, поэтому работоспособность (как полностью, так и отдельных компонентов) не гарантируется.**

## Install

```sh 
composer require carpenstar/bybitapi-sdk-websockets
```

## Настройка и использование

При создании экземпляра приложения необходимо передать 3 параметра - хост, apikey и secret.

Информация об актуальных хостах содержатся на страницах описания подключения в зависимости от типа торговли:
- Деривативы: https://bybit-exchange.github.io/docs/derivatives/ws/connect
- Спот: https://bybit-exchange.github.io/docs/spot/ws/connect

Генерация ключа api и secret производится на странице: https://www.bybit.com/app/user/api-management

```php
use Carpenstar\ByBitAPI\BybitAPI;
new BybitAPI(string $host, string $apiKey, string $secret);
```

Для подключения к сокет-каналам существует единая точка входа в приложении BybitAPI

```php
public function websocket(string $webSocketChannelClassName, IWebSocketArgumentInterface $data, IChannelHandlerInterface $channelHandler, int $mode = EnumOutputMode::MODE_ENTITY, int $wsClientTimeout = IWebSocketArgumentInterface::DEFAULT_SOCKET_CLIENT_TIMEOUT): void
```

1. `string $webSocketChannelClassName` - обязательный параметр. Имя класса базового канала, содержащий в себе все необходимые инструкции для соединения
   (cписок доступных на текущий момент каналов приводится ниже, в примерах использования)


2. `IWebSocketArgumentInterface $data` - обязательный параметр. Обьект опций который необходим для настройки соединения, информация о параметрах передаваемых в констуктор нужно смотреть в аннотации каждого из обьекта;


3. `IChannelHandlerInterface $channelHandler` - обязательный параметр. Пользовательский обьект обработчика сообщений пришедших от сервера.
   Шаблон класса можно посмотреть по пути: `Carpenstar\ByBitAPI\WebSockets\Objects\Channels\DefaultChannelHandler`


4. `int $mode` - необязательный параметр. Режим обработки сообщений присылаемых с сокет-сервера и то в каком виде они будут переданы в обработчик сообщений канала `IChannelHandlerInterface`.

   По умолчанию, каждое сообщение перед передачей в обработчик оборачивается в сущность.  
   Возможные значения:  
   `\Carpenstar\ByBitAPI\Core\Enums\EnumOutputMode::MODE_ENTITY` - преобразование в сущности (медленнее)  
   `\Carpenstar\ByBitAPI\Core\Enums\EnumOutputMode::MODE_JSON` - обработчик канала получит сырое сообщение в формате json (быстрее)


5. `int $wsClientTimeout` - необязательный параметр. Таймаут сокет-клиента в милисекундах. По умолчанию: 1000

## Available channels:

### SPOT

#### PUBLIC CHANNEL - ORDER BOOK

https://bybit-exchange.github.io/docs/spot/ws-public/orderbook

Пример подключения:
```php
use Carpenstar\ByBitAPI\BybitAPI;
use Carpenstar\ByBitAPI\WebSockets\Channels\Spot\PublicChannels\PublicTrade\OrderBookChannel;
use Carpenstar\ByBitAPI\WebSockets\Channels\Spot\PublicChannels\PublicTrade\Argument\OrderBookArgument;

$bybit = new BybitAPI("https://api-testnet.bybit.com", "apiKey", "secret");
$bybit->websocket(OrderBookChannel::class, new OrderBookArgument("BTCUSDT"), new CustomChannelHandler());
```
Обьект для подключения к каналу:
```php
\Carpenstar\ByBitAPI\WebSockets\Channels\Spot\PublicChannels\OrderBook\Argument\OrderBookArgument(string $symbol [, ?string $reqId = null])
```
Структура сообщения приходящего в callback:
```php
\Carpenstar\ByBitAPI\WebSockets\Channels\Spot\PublicChannels\OrderBook\Entities\OrderBookEntity::class
    
public function getTopic(): string // Topic name
public function getType(): string // Data type. snapshot
public function getSymbol(): string // Trading pair
public function getRequestTimestamp(): \DateTime // The timestamp that message is sent out
public function getResponseTimestamp(): \DateTime // The timestamp that system generates the data.
public function getAsk(): ICollectionInterface // OrderBookPriceEntity[]
public function getBid(): ICollectionInterface // OrderBookPriceEntity[]
```
```php
\Carpenstar\ByBitAPI\WebSockets\Channels\Spot\PublicChannels\OrderBook\Entities\OrderBookPriceEntity::class
    
public function getPrice(): float
public function getSize(): float
```
<br/>

#### PUBLIC CHANNEL - KLINE
https://bybit-exchange.github.io/docs/spot/ws-public/kline

Пример подключения:
```php
use Carpenstar\ByBitAPI\BybitAPI;
use Carpenstar\ByBitAPI\WebSockets\Channels\Spot\PublicChannels\PublicTrade\KlineChannel;
use Carpenstar\ByBitAPI\WebSockets\Channels\Spot\PublicChannels\PublicTrade\Argument\KlineArgument;
use Carpenstar\ByBitAPI\Core\Enums\EnumIntervals;

$bybit = new BybitAPI("https://api-testnet.bybit.com", "apiKey", "secret");
$bybit->websocket(KlineChannel::class, new KlineArgument(EnumIntervals::HOUR_1, "BTCUSDT"), new CustomChannelHandler());
```
Обьект для подключения к каналу:
```php
\Carpenstar\ByBitAPI\WebSockets\Channels\Spot\PublicChannels\Kline\Argument\KlineArgument(string $symbol, string $interval [, ?string $reqId = null])
```
Структура сообщения приходящего в callback:
```php
\Carpenstar\ByBitAPI\WebSockets\Channels\Spot\PublicChannels\Kline\Entities\KlineEntity::class

public function getTopic(): string // Topic name
public function getType(): string // Data type. snapshot
public function getSymbol(): string // Trading pair
public function getRequestTimestamp(): \DateTime // The timestamp that message is sent out
public function getBarTimestamp(): \DateTime // The start timestamp of the bar
public function getClosePrice(): float // Close price
public function getHighPrice(): float // High price
public function getLowPrice(): float // Low price
public function getOpenPrice(): float // Open price
public function getTradingVolume(): float // Trading volume
```
<br/>

#### PUBLIC CHANNEL - BOOKTICKER
https://bybit-exchange.github.io/docs/spot/ws-public/bookticker

Пример подключения:
```php
use Carpenstar\ByBitAPI\BybitAPI;
use Carpenstar\ByBitAPI\WebSockets\Channels\Spot\PublicChannels\PublicTrade\PublicTradeChannel;
use Carpenstar\ByBitAPI\WebSockets\Channels\Spot\PublicChannels\PublicTrade\Argument\BooktickerArgument;

$bybit = new BybitAPI("https://api-testnet.bybit.com", "apiKey", "secret");
$bybit->websocket(BooktickerChannel::class, new BooktickerArgument("BTCUSDT"), new CustomChannelHandler());
```

Обьект для подключения к каналу:
```php
\Carpenstar\ByBitAPI\WebSockets\Channels\Spot\PublicChannels\Bookticker\Argument\BooktickerArgument(string $symbol [, ?string $reqId = null])
```

Структура сообщения приходящего в callback:
```php
Carpenstar\ByBitAPI\WebSockets\Channels\Spot\PublicChannels\Bookticker\Entities\BooktickerEntity::class

public function getTopic(): string // Topic name
public function getType(): string // Data type. snapshot
public function getSymbol(): string // Trading pair
public function getRequestTimestamp(): \DateTime // The timestamp that message is sent out
public function getResponseTimestamp(): \DateTime // The timestamp response from server
public function getBestBidPrice(): float // Best bid price
public function getBidQuantity(): float // Bid quantity
public function getBestAskPrice(): float // Best ask price
public function getAskQuantity(): float // Ask quantity
```
<br/>

#### PUBLIC CHANNEL - TICKERS
https://bybit-exchange.github.io/docs/spot/ws-public/ticker

Пример подключения:
```php
use Carpenstar\ByBitAPI\BybitAPI;
use Carpenstar\ByBitAPI\WebSockets\Channels\Spot\PublicChannels\Tickers\TickersChannel;

$bybit = new BybitAPI("https://api-testnet.bybit.com", "apiKey", "secret");
$bybit->websocket(TickersChannel::class, new TickersChannelArgument("BTCUSDT"), new CustomChannelHandler());
```

Обьект для подключения к каналу:
```php
\Carpenstar\ByBitAPI\WebSockets\Channels\Spot\PublicChannels\Bookticker\Argument\TickersArgument(string $symbol [, ?string $reqId = null])
```

Структура сообщения приходящего в callback:
```php
Carpenstar\ByBitAPI\WebSockets\Channels\Spot\PublicChannels\Bookticker\Entities\TickersEntity::class

public function getTopic(): string // Topic name
public function getType(): string // Data type. snapshot
public function getTimestamp(): \DateTime // The timestamp that message is sent out
public function getData(): ?ICollectionInterface // TickersItemEntity[]
```
```php
Carpenstar\ByBitAPI\WebSockets\Channels\Spot\PublicChannels\Bookticker\Entities\TickersItemEntity::class

public function getSymbol(): string // Trading pair
public function getTimestamp(): \DateTime // Timestamp (trading time in the match box)
public function getOpenPrice(): float // Open price
public function getHighPrice(): float // High price
public function getLowPrice(): float // Low price
public function getClosePrice(): float // Close price
public function getTradingVolume(): float // Trading volume
public function getTradinqQuoteVolume(): float // Trading quote volume
public function getChange(): float // Change
public function getUsdIndexPrice(): string // USD index price. It can be empty
```
<br/> 

#### PUBLIC CHANNEL - PUBLIC TRADE
https://bybit-exchange.github.io/docs/spot/ws-public/public-trade

Пример подключения:
```php
use Carpenstar\ByBitAPI\BybitAPI;
use Carpenstar\ByBitAPI\WebSockets\Channels\Spot\PublicChannels\PublicTrade\PublicTradeChannel;

$bybit = new BybitAPI("https://api-testnet.bybit.com", "apiKey", "secret");
$api->websocket(PublicTradeChannel::class, new PublicTradeArgument("BTCUSDT"), new CustomChannelHandler());
```

Обьект для подключения к каналу:
```php
\Carpenstar\ByBitAPI\WebSockets\Channels\Spot\PublicChannels\Bookticker\Argument\PublicTradeArgument(string $symbol [, ?string $reqId = null])
```

Структура сообщения приходящего в callback:
```php
Carpenstar\ByBitAPI\WebSockets\Channels\Spot\PublicChannels\Bookticker\Entities\PublicTradeEntity::class

public function getTopic(): string // Topic name
public function getRequestTimestamp(): \DateTime // The timestamp that message is sent out
public function getType(): string // Data type. snapshot
public function getTradeId(): string // Trade ID
public function getTradingTime(): \DateTime // Timestamp (trading time in the match box)
public function getPrice(): float // Price
public function getQuantity(): float // Quantity
public function getIsTaker(): bool // True indicates buy side is taker, false indicates sell side is taker
public function getTradeType(): int // Trade type. 0：Spot trade. 1：Paradigm block trade
```
<br/> 

### Derivatives

#### PUBLIC CHANNEL - ORDER BOOK
https://bybit-exchange.github.io/docs/derivatives/ws-public/orderbook

Пример подключения:
```php
use Carpenstar\ByBitAPI\BybitAPI;
use Carpenstar\ByBitAPI\WebSockets\Channels\Derivatives\PublicChannels\OrderBook\OrderBookChannel;
use Carpenstar\ByBitAPI\WebSockets\Channels\Derivatives\PublicChannels\OrderBook\Argument\OrderBookArgument;

$bybit = new BybitAPI("https://api-testnet.bybit.com", "apiKey", "secret");
$bybit->websocket(OrderBookChannel::class, new OrderBookArgument("BTCUSDT", 40), new CustomChannelHandler());
```

Обьект для подключения к каналу:
```php
\Carpenstar\ByBitAPI\WebSockets\Channels\Derivatives\PublicChannels\OrderBook\Argument\OrderBookArgument(string $symbol, int $depth [, ?string $reqId = null])
```

Структура сообщения приходящего в callback:
```php
\Carpenstar\ByBitAPI\WebSockets\Channels\Derivatives\PublicChannels\OrderBook\Entities\PublicTradeEntity::class

public function getTopic(): string // Topic name
public function getType(): string // Data type. snapshot
public function getSymbol(): string // Trading pair
public function getTimestamp(): \DateTime // The timestamp that message is sent out
public function getUpdateId(): int // Update id, is always in sequence. Occasionally, you'll receive "u"=1, which is a snapshot data due to the restart of the service. So please overwrite the locally saved orderbook
public function getCrossSequence(): int  
public function getBid(): ICollectionInterface // OrderBookPriceEntity[]
public function getAsk(): ICollectionInterface // OrderBookPriceEntity[]
```
```php
\Carpenstar\ByBitAPI\WebSockets\Channels\Derivatives\PublicChannels\OrderBook\OrderBookPriceEntity::class
public function getPrice(): float
public function getSize(): float
```
<br/>

#### PUBLIC CHANNEL - TICKERS
https://bybit-exchange.github.io/docs/derivatives/ws-public/ticker

Пример подключения:
```php
use Carpenstar\ByBitAPI\BybitAPI;
use Carpenstar\ByBitAPI\WebSockets\Channels\Derivatives\PublicChannels\Tickers\TickersChannel;
use Carpenstar\ByBitAPI\WebSockets\Channels\Spot\PublicChannels\Tickers\Argument\TickersChannelArgument;
$bybit = new BybitAPI("https://api-testnet.bybit.com", "apiKey", "secret");
$bybit->websocket(TickersChannel::class, new TickersChannelArgument("BTCUSDT"), new CustomChannelHandler());
```

Обьект для подключения к каналу:
```php
\Carpenstar\ByBitAPI\WebSockets\Channels\Derivatives\PublicChannels\OrderBook\Argument\TickersArgument(string $symbol [, ?string $reqId = null])
```

Структура сообщения приходящего в callback:
```php
\Carpenstar\ByBitAPI\WebSockets\Channels\Derivatives\PublicChannels\OrderBook\Entities\PublicTradeEntity::class
public function getTopic(): string // Topic name
public function getType(): string // Data type. snapshot
public function getTimestamp(): \DateTime // The timestamp that message is sent out
public function getCrossSequence(): int
public function getData(): ICollectionInterface // TickersDataItemEntity[]
```