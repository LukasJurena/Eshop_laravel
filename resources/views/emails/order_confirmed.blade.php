<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Potvrzení objednávky</title>
</head>
<body>
    <h2>Dobrý den,</h2>
    <p>Vaše objednávka byla úspěšně potvrzena.</p>
    <p><strong>Platba:</strong> {{ $payment->payment_method }}</p>
    <p><strong>Částka:</strong> {{ $payment->amount }} Kč</p>
    <p><strong>Stav:</strong> {{ $payment->status }}</p>
    <p>Děkujeme za váš nákup!</p>
</body>
</html>