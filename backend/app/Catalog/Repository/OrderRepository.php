<?php

namespace App\Catalog\Repository;

use App\Catalog\Entity\Order;
use DomainException;

final class OrderRepository
{
    public function get(int $id): Order
    {
        return Order::where(['id' => $id])->firstOrFail();
    }

    public function save(Order $order): void
    {
        if (!$order->save()) {
            throw new DomainException('Возникла ошибка при сохранении заявки');
        }
    }

    public function remove(Order $order): void
    {
        if (!$order->delete()) {
            throw new DomainException('Возникла ошибка при удалении заявки');
        }
    }

    public function findById(int $orderId): ?Order
    {
        if (!$order = Order::whereId($orderId)->first()) {
            throw new DomainException('Заявка не найдена');
        }

        return $order;
    }
}
