<?php

declare(strict_types=1);

namespace App\Catalog\Command\Order\Create;

use App\Catalog\Entity\Order;
use App\Catalog\Entity\OrderLine;
use App\Catalog\Repository\ClientCompanyRepository;
use App\Catalog\Repository\OrderLineRepository;
use App\Catalog\Repository\OrderRepository;
use App\Product\Repository\ProductRepository;
use App\User\Repository\UserRepository;

final class Handler
{
    public function __construct(
        private readonly OrderRepository $orders,
        private readonly UserRepository $users,
        private readonly ClientCompanyRepository $companies,
        private readonly ProductRepository $products,
        private readonly OrderLineRepository $lines,
    ) {
    }

    public function handle(Command $command, int $userId): Order
    {
        $order = new Order([
            'contact_name' => $command->contactName,
            'contact_phone' => $command->contactPhone,
            'contact_email' => $command->contactEmail,
            'document_type' => $command->documentType,
            'comment' => $command->comment,
            'end_user_of_product' => $command->endUserOfProduct,
            'delivery_date' => $command->deliveryDate,
            'status' => Order::STATUS_WAIT_DEPARTURE,
        ]);

        $order->user()->associate(
            $this->users->findById($userId)
        );

        $order->buyerCompany()->associate(
            $this->companies->findById($command->buyerCompany)
        );

        $order->payerCompany()->associate(
            $this->companies->findById($command->payerCompany)
        );

        $this->orders->save($order);

        foreach ($command->lines as $line) {
            $orderLine = new OrderLine([
                'quantity' => $line['quantity']
            ]);

            $orderLine->order()->associate($order);

            $orderLine->product()->associate(
                $this->products->findById($line['product'])
            );

            $this->lines->save($orderLine);
        }

        $order->recipientCompany()->associate(
            $this->companies->findById($command->recipientCompany)
        );

        return $order;
    }
}
