<?php

declare(strict_types=1);

namespace Domain\Order\Model\Order;

use Doctrine\Common\Collections\ArrayCollection;

class Order
{
    public readonly string $id;
    public readonly ArrayCollection $products;

    public function __construct(
        OrderId $id,
        public readonly string $internalId,
        Products $products,
    ) {
        $this->id = (string) $id;
        $this->products = new ArrayCollection($products->toArray());
    }
}