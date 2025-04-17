<div class="container my-5 table-responsive table-sm">
    <h2 class="underline-red text-center">Ваші Замовлення</h2>
    <table class="table">
        <thead class="thead-dark">
        <tr>
            <th scope="col">№</th>
            <th scope="col">Товар</th>
            <th scope="col">Ціна</th>
            <th scope="col">Замовник</th>
            <th scope="col">Місто, відділення</th>
            <th scope="col">Дата замовлення</th>
            <th scope="col">Статус</th>
        </tr>
        </thead>
        <tbody>

        <?php
        use App\Controllers\OrderController;
        $orderController = new OrderController();

        foreach ($orderController->getOrders() as $order):
            $post = match ($order['order_post']) {
                'nova_post' =>  $order['order_city']. ", Нова пошта №" . $order['order_post_id'],
                'ukr_post' =>  $order['order_city']. ", Укрпошта " . $order['order_post_id'],
                default => $order['order_city']. ", №".$order['order_post_id']
            };

            $status = match ($order['order_status']) {
                '1' => 'Комплектується',
                '2' => 'У дорозі',
                '3' => 'Виконано',
                '4' => 'Відмінено!',
                default => 'Нове замовлення'
            }; ?>

            <tr>
                <th scope="row">FIRE_<?= $order['order_id'] ?></th>
                <td><?= htmlspecialchars($order['product_name']) ?></td>
                <td><?= htmlspecialchars($order['product_price']) ?> грн.</td>
                <td><?= htmlspecialchars($order['order_user']) ?></td>
                <td><?= htmlspecialchars($post) ?></td>
                <td><?= htmlspecialchars(date('d.m.Y H:i', strtotime($order['order_date']))) ?></td>
                <td><?= htmlspecialchars($status) ?></td>
            </tr>
        <?php endforeach; ?>

        </tbody>
    </table>
</div>