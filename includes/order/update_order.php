<div class="container my-5 table-responsive table-sm" id="updateOrders" style="display:none">
    <h2 class="underline-red text-center">Обробити Замовлення</h2>
    <table class="table">
        <thead class="thead-dark">
        <tr>
            <th scope="col">№</th>
            <th scope="col">Товар</th>
            <th scope="col">Ціна</th>
            <th scope="col">Замовник</th>
            <th scope="col">Телефон</th>
            <th scope="col">Місто, відділення</th>
            <th scope="col">Дата замовлення</th>
            <th scope="col">Статус</th>
        </tr>
        </thead>
        <tbody>

        <?php

        use App\Controllers\OrderController;

        $orderController = new OrderController();

        foreach ($orderController->getFullOrders() as $order) :
            $post = match ($order['order_post']) {
                'nova_post' => $order['order_city'] . ", Нова пошта №" . $order['order_post_id'],
                'ukr_post' => $order['order_city'] . ", Укрпошта " . $order['order_post_id'],
                default => $order['order_city'] . ", №" . $order['order_post_id']
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
                <td><?= htmlspecialchars($order['order_phone']) ?></td>
                <td><?= htmlspecialchars($post) ?></td>
                <td><?= htmlspecialchars(date('d.m.Y H:i', strtotime($order['order_date']))) ?></td>
                <td><?= htmlspecialchars($status) ?></td>
                <?php if ($order['order_status'] !== '3' && $order['order_status'] !== '4') : ?>
                <td>
                    <form action="/includes/order/update_order_status.php" method="post"
                          style="display: flex; align-items: center; gap: 10px;">
                        <input type="hidden" name="order_id" value="<?= $order['order_id'] ?>">
                        <label>
                            <select name="update_order_status" id="update_order_status">
                                <option selected disabled></option>
                                <option value="1">Комплектується</option>
                                <option value="2">У дорозі</option>
                                <option value="3">Виконано</option>
                                <option value="4">Відмінено</option>
                            </select>
                        </label>
                        <button class="btn btn-danger" type="submit"><i class="fas fa-save"></i></button>
                    </form>
                </td>
                <?php endif;?>
            </tr>
        <?php endforeach; ?>

        </tbody>
    </table>
</div>
<div class="mb-5"></div>
