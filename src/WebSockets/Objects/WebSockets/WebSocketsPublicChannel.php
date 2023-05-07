<?php
namespace Carpenstar\ByBitAPI\WebSockets\Objects\WebSockets;

use Carpenstar\ByBitAPI\Core\Builders\ResponseBuilder;
use Carpenstar\ByBitAPI\Core\Enums\EnumOutputMode;
use Carpenstar\ByBitAPI\Core\Interfaces\IResponseEntityInterface;
use Carpenstar\ByBitAPI\WebSockets\Interfaces\IChannelHandlerInterface;
use Carpenstar\ByBitAPI\WebSockets\Interfaces\IWebSocketArgumentInterface;
use Carpenstar\ByBitAPI\WebSockets\Interfaces\IWebSocketsChannelInterface;
use Carpenstar\ByBitAPI\WebSockets\Objects\Channels\ChannelHandler;
use WebSocket\Client;

abstract class WebSocketsPublicChannel implements IWebSocketsChannelInterface
{
    protected Client $socketClient;

    protected IChannelHandlerInterface $channelHandler;

    protected IResponseEntityInterface $response;

    protected array $topic;

    protected string $operation;

    /**
     * 0 - raw | 1 - dto
     * @var int
     */
    protected int $mode;

    public function __construct(
        IWebSocketArgumentInterface $arguments,
        IChannelHandlerInterface $channelHandler,
        int $mode = 0,
        int $socketTimeout = IWebSocketArgumentInterface::DEFAULT_SOCKET_CLIENT_TIMEOUT)
    {
        $this
            ->setClient(new Client(static::$wssRoute))
            ->setChannelHandler($channelHandler)
            ->setMode($mode)
            ->setTopic($arguments->getTopic())
            ->setOperation($arguments->getOperation());

        $this->socketClient->setTimeout($socketTimeout);
    }

    /**
     * @param Client $client
     * @return self
     */
    private function setClient(Client $client): self
    {
        $this->socketClient = $client;
        return $this;
    }

    /**
     * @return Client
     */
    public function getClient(): Client
    {
        return $this->socketClient;
    }

    /**
     * @param IChannelHandlerInterface $channelHandler
     * @return self
     */
    private function setChannelHandler(IChannelHandlerInterface $channelHandler): self
    {
        $this->channelHandler = $channelHandler;
        return $this;
    }

    /**
     * @return ChannelHandler
     */
    public function getChannelHandler(): ChannelHandler
    {
        return $this->channelHandler;
    }

    /**
     * @param array $topics
     * @return $this
     */
    protected function setTopic(array $topic): self
    {
        $this->topic = $topic;
        return $this;
    }

    /**
     * @return array
     */
    public function getTopic(): array
    {
        return $this->topic;
    }

    /**
     * @param string $operation
     * @return $this
     */
    protected function setOperation(string $operation): self
    {
        $this->operation = $operation;
        return $this;
    }

    /**
     * @return string
     */
    public function getOperation(): string
    {
        return $this->operation;
    }

    /**
     * @param int $mode
     * @return $this
     */
    protected function setMode(int $mode): self
    {
        $this->mode = $mode;
        return $this;
    }

    /**
     * @return int
     */
    public function getMode(): int
    {
        return $this->mode;
    }

    /**
     * @return void
     * @throws \WebSocket\BadOpcodeException
     */
    public function execute(): void
    {
        $pushData = [
            "op" => $this->getOperation(),
            "args" => $this->getTopic()
        ];

        $this->getClient()->send(json_encode($pushData));

        while (true) {
            try {
                $test = $message = $this->getClient()->receive();
                if ($this->getMode() == EnumOutputMode::MODE_JSON) {
                    $message = json_decode($message, true);
                    if (empty($message['topic'])) {
                        continue;
                    }
                    $message = ResponseBuilder::make($this->getResponseDTOClass(), $message);
                }

                $this->getChannelHandler()->handle($message);

            } catch (\Exception $e) {
                var_dump('error 1', $e->getMessage(), $test);die;
            }
        }
    }
}