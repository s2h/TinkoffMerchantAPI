<?php
spl_autoload('TinkoffMerchantAPI');
$api = new TinkoffMerchantAPI('TestB', 'ni78Hh9Ah', 'https://rest-api-test.tcsbank.ru/rest/');
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="main.css"/>
    <link
        href="data:image/x-icon;base64,AAABAAEAEBAQAAAAAAAoAQAAFgAAACgAAAAQAAAAIAAAAAEABAAAAAAAgAAAAAAAAAAAAAAAEAAAAAAAAABpOwkAnm45AAAAAAD/hAAAGhIGANSmdAD69/8A//v3AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAIiIREiERIiIiIiICICIiIiIiAAAAACIiIiIGVlZQIiIhEgVlZWAhEiIQAFZWAAEiIRIgZWUCIRIiIiBWVgIiIiIgAAAAAAIiIiB3d3d3AiIiEHQ3dDcBIiIgcRdxFwIiIiB3d3d3AiIiIAAAAAACIiIiICIiAiIiIiIREiERIiLxjwAA/b8AAPAPAADwDwAAkAkAAMADAACYGQAA+B8AAOAHAADgBwAAwAMAAOAHAADgBwAA4AcAAPvfAADxjwAA"
        rel="icon" type="image/x-icon"/>
    <title>Testing Merchant API</title>
</head>
<body>
<h1 align="center">Тестирование MerchantAPI</h1>

<?php if (true): ?>
    <div class="card">
        <h2>Метод Init:</h2>

        <div class="article">
            <?php
            $params = array(
//    'TerminalKey' => 'TestB',
                'OrderId' => '667',
                'Amount' => rand(),
                'Description' => 'Любовь',
                'DATA' => 'Email=a@test.com',
//                'Recurrent' => 'Y',
                'CustomerKey' => '5',
//    'Token' => '1',
            );
            $api->init($params);
            echo 'Params:';
            //    Debug::trace($params);
            ?>

            <p><span class="highlight">Response</span>: <?= $api->response ?></p>

            <?php if ($api->error): ?>
                <span class="error"><?= $api->error ?></span>
            <?php else: ?>
                <p><span class="highlight">Status</span>: <?= $api->status ?></p>
                <p>
                    <span class="highlight">PaymentUrl</span>:
                    <a href="<?= $api->paymentUrl ?>" target="_blank"><?= $api->paymentUrl ?></a>
                </p>
                <p><span class="highlight">PaymentId</span>: <?= $api->paymentId ?></p>
            <?php endif; ?>
        </div>
    </div>
<?php endif; ?>

<?php if (false): ?>
    <div class="card">
        <h2>Метод GetState:</h2>

        <div class="article">
            <?php
            $params = array(
                'PaymentId' => '147161',
            );
            $api->getState($params);
            ?>
            <p><span class="highlight">Response</span>: <?php echo $api->response ?></p>
            <?php if ($api->error): ?>
                <p><span class="error"><?= $api->error ?></span></p>
            <?php else: ?>
                <p><span class="highlight">Status</span>: <?php echo $api->status ?></p>
                <p><span class="highlight">PaymentId</span>: <?php echo $api->paymentId ?></p>
                <p><span class="highlight">OrderId</span>: <?php echo $api->orderId ?></p>
            <?php endif; ?>
        </div>
    </div>
<?php endif; ?>

<?php if (false): ?>
    <div class="card">
        <h2>Метод Confirm:</h2>

        <div class="article">
            <?php
            $params = array(
                'PaymentId' => '147161',
            );
            $api->confirm($params);
            //    echo 'Params:';
            //    Debug::trace($params);
            ?>

            <p><span class="highlight">Response</span>: <?= $api->response ?></p>

            <?php if ($api->error): ?>
                <span class="error"><?= $api->error ?></span>
            <?php else: ?>
                <p><span class="highlight">Status</span>: <?= $api->status ?></p>
                <p><span class="highlight">PaymentId</span>: <?= $api->paymentId ?></p>
            <?php endif; ?>
        </div>
    </div>
<?php endif; ?>

<?php if (false): ?>
    <div class="card">
        <h2>Метод Resend</h2>

        <div class="article">

            <p><span class="highlight">Response</span>: <?= $api->resend() ?></p>

            <p><span class="highlight">Count</span>: <?= $api->Count ?></p>
        </div>
    </div>
<?php endif; ?>

<?php if (false): ?>
    <div class="card">
        <h2>Метод AddCustomer</h2>

        <div class="article">
            <?php
            $params = array(
                'CustomerKey' => '4',
            );
            $api->addCustomer($params);
            ?>

            <p><span class="highlight">Response</span>: <?= $api->response ?></p>
            <?php if ($api->error): ?>
                <p><span class="error"><?= $api->error ?></span></p>
            <?php else: ?>
                <p><span class="highlight">CustomerKey</span>: <?= $api->customerKey ?></p>
            <?php endif; ?>
        </div>
    </div>
<?php endif; ?>

<?php if (false): ?>
    <div class="card">
        <h2>Метод GetCustomer</h2>

        <div class="article">
            <?php
            $params = array(
                'CustomerKey' => '4',
            );
            $api->getCustomer($params);
            ?>

            <p><span class="highlight">Response</span>: <?= $api->response ?></p>
            <?php if ($api->error): ?>
                <p><span class="error"><?= $api->error ?></span></p>
            <?php else: ?>
                <p><span class="highlight">CustomerKey</span>: <?= $api->customerKey ?></p>
            <?php endif; ?>
        </div>
    </div>
<?php endif; ?>

<?php if (false): ?>
    <div class="card">
        <h2>Метод RemoveCustomer</h2>

        <div class="article">
            <?php
            $params = array(
                'CustomerKey' => '4',
            );
            $api->removeCustomer($params);
            ?>

            <p><span class="highlight">Response</span>: <?= $api->response ?></p>
            <?php if ($api->error): ?>
                <p><span class="error"><?= $api->error ?></span></p>
            <?php else: ?>
                <p><span class="highlight">CustomerKey</span>: <?= $api->customerKey ?></p>
            <?php endif; ?>
        </div>
    </div>
<?php endif; ?>

<?php if (true): ?>
    <div class="card">
        <h2>Метод GetCardList</h2>

        <div class="article">
            <?php
            $params = array(
                'CustomerKey' => '5',
            );
            $api->getCardList($params);
            ?>

            <p><span class="highlight">Response</span>: <?= $api->response ?></p>
            <?php if ($api->error): ?>
                <p><span class="error"><?= $api->error ?></span></p>
            <?php else: ?>
                <p><span class="highlight">CustomerKey</span>: <?= $api->customerKey ?></p>
            <?php endif; ?>
        </div>
    </div>
<?php endif; ?>

<?php if (true): ?>
    <div class="card">
        <h2>Метод RemoveCard</h2>

        <div class="article">
            <?php
            $params = array(
                'CardId' => '10804',
                'CustomerKey' => '5',
            );
            $api->removeCard($params);
            ?>

            <p><span class="highlight">Response</span>: <?= $api->response ?></p>
            <?php if ($api->error): ?>
                <p><span class="error"><?= $api->error ?></span></p>
            <?php else: ?>
                <p><span class="highlight">CustomerKey</span>: <?= $api->customerKey ?></p>
            <?php endif; ?>
        </div>
    </div>
<?php endif; ?>

</body>
</html>