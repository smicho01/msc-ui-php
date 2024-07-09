<div class="row">
    <div class="col-12">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item"><a href="/index.php?c=user&v=account">Your account</a></li>
                <li class="breadcrumb-item active" aria-current="page">Transactions</li>
            </ol>
        </nav>

    </div>
</div>
<div class="row">
    <div class="col-12">
        <h3 class="heading">Your Transactions</h3>
        <p>Your token count: <?php echo $foundUser['tokens']; ?></p>
    </div>

    <div class="col-12">
    <?php if(count($userTransactions) == 0) : ?>
        <p>No transactions</p>
    <?php else: ?>

    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">Value</th>
            <th scope="col">In/Out</th>
            <th scope="col">Event Type</th>
            <th scope="col">Transaction ID</th>
            <th scope="col">Date</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($userTransactions as $transaction): ?>
            <tr>
                <td><?php echo $transaction['amount']; ?></td>
                <td><?php echo ucwords($transaction['type']); ?></td>
                <td><?php echo $transaction['event']; ?></td>
                <td ><?php echo $transaction['id']; ?></td>
                <td ><?php echo $transaction['date']; ?></td>
            </tr>
        <?php endforeach; ?>

        </tbody>
    </table>
    <?php endif; ?>
    </div>

</div>