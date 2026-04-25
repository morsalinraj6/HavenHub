<?php include __DIR__ . '/../layouts/header.php'; ?>
<div class="row justify-content-center">
    <div class="col-xl-9">
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-body p-4 p-lg-5">
                <div class="d-flex justify-content-between flex-wrap gap-3 mb-4">
                    <div>
                        <h2 class="fw-bold mb-1">Invoice #<?= $booking['id']; ?></h2>
                        <p class="text-muted mb-0">Generated for <?= htmlspecialchars($booking['guest_name']); ?></p>
                    </div>
                    <div class="text-lg-end">
                        <div><strong>Room:</strong> <?= htmlspecialchars($booking['room_number']); ?></div>
                        <div><strong>Stay:</strong> <?= htmlspecialchars($booking['check_in']); ?> to <?= htmlspecialchars($booking['check_out']); ?></div>
                        <div><strong>Status:</strong> <?= htmlspecialchars($booking['status']); ?></div>
                    </div>
                </div>
                <?php $roomSubtotal = $booking['price'] * $booking['total_nights']; ?>
                <div class="table-responsive mb-4">
                    <table class="table">
                        <thead><tr><th>Item</th><th>Details</th><th class="text-end">Cost</th></tr></thead>
                        <tbody>
                            <tr>
                                <td>Room Charge</td>
                                <td><?= htmlspecialchars($booking['category']); ?> · <?= $booking['total_nights']; ?> night(s)</td>
                                <td class="text-end"><?= format_money($roomSubtotal); ?></td>
                            </tr>
                            <?php foreach ($services as $service): ?>
                                <tr>
                                    <td>Service</td>
                                    <td><?= htmlspecialchars($service['service_name']); ?></td>
                                    <td class="text-end"><?= format_money($service['cost']); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="2" class="text-end">Total</th>
                                <th class="text-end"><?= format_money($payment['total_amount'] ?? $roomSubtotal); ?></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <div class="d-flex justify-content-end">
                    <button onclick="window.print()" class="btn btn-warning"><i class="bi bi-printer me-1"></i> Print Invoice</button>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include __DIR__ . '/../layouts/footer.php'; ?>
