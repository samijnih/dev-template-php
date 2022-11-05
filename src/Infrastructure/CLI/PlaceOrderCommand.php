<?php

declare(strict_types=1);

namespace Infrastructure\CLI;

use Domain\Order\Saga\PlaceOrderSaga;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(name: 'order:place')]
final class PlaceOrderCommand extends Command
{
    public function __construct(readonly PlaceOrderSaga $placeOrderSaga)
    {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->placeOrderSaga->start('Order 1', [
            [
                'id' => '366068cb-2c45-4ba3-9611-4e5083a1b6e3',
                'sku' => 'SKU001',
                'quantity' => 2,
                'price' => ['2000', 'EUR'],
            ],
            [
                'id' => '26d9b86b-46b4-4083-90f1-8c5bc3e34aed',
                'sku' => 'SKU002',
                'quantity' => 1,
                'price' => ['500', 'EUR'],
            ],
        ]);

        return self::SUCCESS;
    }
}
