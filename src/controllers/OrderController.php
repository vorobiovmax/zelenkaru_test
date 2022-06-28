<?php

namespace mvorobiov\controllers;


use mvorobiov\models\Filepath;
use mvorobiov\models\OrderId;
use mvorobiov\models\Url;
use mvorobiov\services\order\boundary\OrdersFacade;
use yii\console\ExitCode;
use yii\helpers\Console;


class OrderController extends \yii\console\Controller
{
    public function actionIndex(): int {
        $this->stdout("Available commands:\n", Console::FG_YELLOW, );
        $this->stdout("\t- order/update-net [url]\n", Console::FG_GREEN);
        $this->stdout("\t- order/update-local [path-to-file]\n", Console::FG_GREEN);
        $this->stdout("\t- order/info [order-real-id]\n", Console::FG_GREEN);

        return ExitCode::OK;
    }

    public function actionUpdateNet($url): int {
        $url = new Url(['url' => $url]);

        if(!$url->validate()) {
            $this->stdout($url->getFirstError('url') . PHP_EOL, Console::FG_RED);

            return ExitCode::DATAERR;
        }

        $facade = \Yii::createObject(OrdersFacade::class);

        $facade->updateOrders($url->url, OrdersFacade::READER_URL);

        return ExitCode::OK;
    }

    public function actionUpdateLocal($filepath): int {
        $filepath = new Filepath(['filepath' => $filepath]);

        if(!$filepath->validate()) {
            $this->stdout($filepath->getFirstError('filepath') . PHP_EOL, Console::FG_RED);

            return ExitCode::IOERR;
        }

        $facade = \Yii::createObject(OrdersFacade::class);

        $facade->updateOrders($filepath->filepath, OrdersFacade::READER_FILE);

        return ExitCode::OK;
    }

    public function actionInfo($realId): int {
        $orderId = new OrderId(['realId' => $realId]);

        if(!$orderId->validate()) {
            $this->stdout($orderId->getFirstError('realId') . PHP_EOL, Console::FG_RED);

            return ExitCode::DATAERR;
        }

        $facade = \Yii::createObject(OrdersFacade::class);

        $this->stdout($facade->getOrderInfo($orderId->realId, OrdersFacade::FORMAT_JSON));

        return ExitCode::OK;
    }
}