[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/carpenstar/bybitapi-sdk-websockets/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/carpenstar/bybitapi-sdk-websockets/?branch=master)
[![Build Status](https://scrutinizer-ci.com/g/carpenstar/bybitapi-sdk-websockets/badges/build.png?b=master)](https://scrutinizer-ci.com/g/carpenstar/bybitapi-sdk-websockets/build-status/master)
[![Code Intelligence Status](https://scrutinizer-ci.com/g/carpenstar/bybitapi-sdk-websockets/badges/code-intelligence.svg?b=master)](https://scrutinizer-ci.com/code-intelligence)

# ByBitAPI - websockets package

**Дисклэймер: это неофициальный SDK от биржи ByBit.   
Поддержка функционала осуществляется только в пределах зоны отвественности кода и при возможности со стороны разработчика**  

**Разработка интеграции еще не закончена, поэтому работоспособность (как полностью, так и отдельных компонентов) не гарантируется.**

## Установка


```sh 
composer require carpenstar/bybitapi-sdk-websockets
```

## Экземпляр приложения

```php
use Carpenstar\ByBitAPI\BybitAPI;

$bybit = new BybitAPI(
    string $host, 
    string $apiKey, 
    string $secret
);

```

Информация об актуальных хостах содержатся на страницах описания подключения в зависимости от типа торговли: 
- Деривативы: https://bybit-exchange.github.io/docs/derivatives/ws/connect
- Спот: https://bybit-exchange.github.io/docs/spot/ws/connect

Генерация ключа api и secret производится на странице: https://www.bybit.com/app/user/api-management
Для подключения к сокет-каналам существует единая точка входа в приложении BybitAPI

```php
public function websocket(
        string $webSocketChannelClassName,  // Имя класса базового канала, содержащий в себе все необходимые инструкции для соединения
        IWebSocketArgumentInterface $argument, // Обьект опций который необходим для настройки соединения
        IChannelHandlerInterface $channelHandler, // Пользовательский коллбэк сообщений пришедших от сервера.
        [int $mode = EnumOutputMode::MODE_ENTITY], // Тип сообщений передаваемых в коллбэк (dto или json)
        [int $wsClientTimeout = IWebSocketArgumentInterface::DEFAULT_SOCKET_CLIENT_TIMEOUT] // Таймаут сокет-клиента в милисекундах. По умолчанию: 1000
        ): void
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

## Пример использования

```php
namespace \SomethingNameSpace\Directory;

class CustomChannelHandler extends ChannelHandler
{
    /**
    * @param KlineEntity $data
    * @return void
    */
    public  function handle($data): void
    {
        echo $data->getTopic() . ' - ' . $data->getSymbol() . ' - ' . $data->getTradingVolume();
        // Какой-то код...
    }
}
```

```php
use Carpenstar\ByBitAPI\BybitAPI;
use Carpenstar\ByBitAPI\WebSockets\Channels\Spot\PublicChannels\PublicTrade\KlineChannel;
use Carpenstar\ByBitAPI\WebSockets\Channels\Spot\PublicChannels\PublicTrade\Argument\KlineArgument;
use Carpenstar\ByBitAPI\Core\Enums\EnumIntervals;
use SomethingNameSpace\Directory\CustomChannelHandler;

$wsArgument = new KlineArgument(EnumIntervals::HOUR_1, "BTCUSDT");
$callbackHandler = new CustomChannelHandler();

$bybit = new BybitAPI("https://api-testnet.bybit.com", "apiKey", "secret");
$bybit->websocket(KlineChannel::class, $wsArgument, $callbackHandler);
```

## Поддерживаемые каналы:

### SPOT

#### PUBLIC CHANNEL - ORDER BOOK
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
use Carpenstar\ByBitAPI\WebSockets\Channels\Spot\PublicChannels\PublicTrade\KlineChannel;
use Carpenstar\ByBitAPI\WebSockets\Channels\Spot\PublicChannels\PublicTrade\Argument\KlineArgument;
use Carpenstar\ByBitAPI\Core\Enums\EnumIntervals;

$bybit = new BybitAPI("https://api-testnet.bybit.com", "apiKey", "secret");
$bybit->websocket(KlineChannel::class, new KlineArgument(EnumIntervals::HOUR_1, "BTCUSDT"), new CustomChannelHandler());
```

#### PUBLIC CHANNEL - BOOKTICKER
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
use Carpenstar\ByBitAPI\WebSockets\Channels\Spot\PublicChannels\PublicTrade\PublicTradeChannel;
use Carpenstar\ByBitAPI\WebSockets\Channels\Spot\PublicChannels\PublicTrade\Argument\BooktickerArgument;

$bybit = new BybitAPI("https://api-testnet.bybit.com", "apiKey", "secret");
$bybit->websocket(BooktickerChannel::class, new BooktickerArgument("BTCUSDT"), new CustomChannelHandler());
```

#### PUBLIC CHANNEL - TICKERS
https://bybit-exchange.github.io/docs/spot/ws-public/ticker

```php
use Carpenstar\ByBitAPI\BybitAPI;
use Carpenstar\ByBitAPI\WebSockets\Channels\Spot\PublicChannels\Tickers\TickersChannel;

$bybit = new BybitAPI("https://api-testnet.bybit.com", "apiKey", "secret");
$bybit->websocket(TickersChannel::class, new TickersChannelArgument("BTCUSDT"), new CustomChannelHandler());
```

#### PUBLIC CHANNEL - PUBLIC TRADE
https://bybit-exchange.github.io/docs/spot/ws-public/public-trade

```php
use Carpenstar\ByBitAPI\BybitAPI;
use Carpenstar\ByBitAPI\WebSockets\Channels\Spot\PublicChannels\PublicTrade\PublicTradeChannel;

$bybit = new BybitAPI("https://api-testnet.bybit.com", "apiKey", "secret");
$api->websocket(PublicTradeChannel::class, new PublicTradeArgument("BTCUSDT"), new CustomChannelHandler());
```

### Derivatives

#### PUBLIC CHANNEL - ORDER BOOK
https://bybit-exchange.github.io/docs/derivatives/ws-public/orderbook

```php
use Carpenstar\ByBitAPI\BybitAPI;
use Carpenstar\ByBitAPI\WebSockets\Channels\Derivatives\PublicChannels\OrderBook\OrderBookChannel;
use Carpenstar\ByBitAPI\WebSockets\Channels\Derivatives\PublicChannels\OrderBook\Argument\OrderBookArgument;

$bybit = new BybitAPI("https://api-testnet.bybit.com", "apiKey", "secret");
$bybit->websocket(OrderBookChannel::class, new OrderBookArgument("BTCUSDT", 40), new CustomChannelHandler());
```

#### PUBLIC CHANNEL - TICKERS
https://bybit-exchange.github.io/docs/derivatives/ws-public/ticker

###### SPOT - PUBLIC CHANNEL - TICKERS
https://bybit-exchange.github.io/docs/spot/ws-public/ticker

###### SPOT - PUBLIC CHANNEL - PUBLIC TRADE
https://bybit-exchange.github.io/docs/spot/ws-public/public-trade
