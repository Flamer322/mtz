<?php

namespace App\Product\Repository;

use App\Product\Entity\Product;
use DomainException;

final class ProductRepository
{
    public function get(int $id): Product
    {
        return Product::where(['id' => $id])->firstOrFail();
    }

    public function save(Product $product): void
    {
        if (!$product->save()) {
            throw new DomainException('Возникла ошибка при сохранении изделия');
        }
    }

    public function remove(Product $product): void
    {
        if (!$product->delete()) {
            throw new DomainException('Возникла ошибка при удалении изделия');
        }
    }

    public function findById(int $productId): ?Product
    {
        if (!$product = Product::whereId($productId)->first()) {
            throw new DomainException('Изделие не найдена');
        }

        return $product;
    }
}
