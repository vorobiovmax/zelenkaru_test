<?php

namespace mvorobiov\services\order\boundary;


use mvorobiov\services\order\control\formatters\FormattersFactory;
use mvorobiov\services\order\control\readers\IReader;
use mvorobiov\services\order\control\readers\ReadersFactory;
use mvorobiov\services\order\control\storages\RepositoryFactory;


//TODO: config service as dependency
class OrdersFacade
{
    public const READER_URL = 'url';
    public const READER_FILE = 'file';
    public const FORMAT_JSON = 'json';

    protected FormattersFactory $formattersFactory;
    protected RepositoryFactory $repositoryFactory;
    protected ReadersFactory $readersFactory;

    public function __construct(
        FormattersFactory $formattersFactory,
        RepositoryFactory $repositoryFactory,
        ReadersFactory $readersFactory
    ) {
        $this->formattersFactory = $formattersFactory;
        $this->repositoryFactory = $repositoryFactory;
        $this->readersFactory = $readersFactory;
    }

    /**
     * @return string
     */
    protected function currentRepositoryType(): string {
        return 'localDatabase';
    }

    /**
     * @param string $sourcePath
     * url / filepath / ... that recognized by readers
     * @see IReader
     *
     * @param string $readerType
     *
     *
     * @throws OrdersFacadeException
     * @throws \mvorobiov\services\order\control\formatters\FormattersFactoryException
     * @throws \mvorobiov\services\order\control\readers\ReadersFactoryException
     * @throws \mvorobiov\services\order\control\storages\RepositoryFactoryException
     */
    public function updateOrders(string $sourcePath, string $readerType): void {
        $reader = $this->readersFactory->createByType($readerType);

        $repository = $this->repositoryFactory->createByType($this->currentRepositoryType());

        $content = $reader->getContent($sourcePath);

        $formatter = $this->formattersFactory->createByType($content->type);

        $orders = $formatter->parse($content->output);

        foreach ($orders as $order) {
            $result = $repository->save($order);

            if(!$result) {
                $msg = sprintf('Failed to save order #%s', $order->id);
                throw new OrdersFacadeException($msg);
            }
        }
    }

    /**
     * @param int $realId
     * @param string $format
     * @return string
     * @throws \mvorobiov\services\order\control\formatters\FormattersFactoryException
     * @throws \mvorobiov\services\order\control\storages\RepositoryFactoryException
     */
    public function getOrderInfo(int $realId, string $format): string {
        $repository = $this->repositoryFactory->createByType($this->currentRepositoryType());
        $formatter = $this->formattersFactory->createByType($format);

        $order = $repository->findByRealId($realId);

        if(!$order) {
            return sprintf('Order #%s was\'t found' . PHP_EOL, $realId);
        }

        return $formatter->represent($order);
    }
}