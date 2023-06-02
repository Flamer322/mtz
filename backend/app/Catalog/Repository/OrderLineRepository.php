<?php

namespace App\Catalog\Repository;

use App\Catalog\Entity\OrderLine;
use DomainException;

final class OrderLineRepository
{
    public function get(int $id): OrderLine
    {
        return OrderLine::where(['id' => $id])->firstOrFail();
    }

    public function save(OrderLine $line): void
    {
        if (!$line->save()) {
            throw new DomainException('Возникла ошибка при сохранении линии');
        }
    }

    public function remove(OrderLine $line): void
    {
        if (!$line->delete()) {
            throw new DomainException('Возникла ошибка при удалении линии');
        }
    }

    public function findById(int $lineId): ?OrderLine
    {
        if (!$line = OrderLine::whereId($lineId)->first()) {
            throw new DomainException('Линия не найдена');
        }

        return $line;
    }
}
