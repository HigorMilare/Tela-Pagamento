<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once __DIR__ . "/Pagamento.php";
require_once __DIR__ . "/Pix.php";
require_once __DIR__ . "/Cartao.php";
require_once __DIR__ . "/Boleto.php";
require_once __DIR__ . "/ProcessadorPagamento.php"; 

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: index.php");
    exit;
}

$valor = filter_input(
    INPUT_POST,
    "valor",
    FILTER_VALIDATE_FLOAT
);

$forma = $_POST["forma"] ?? "";
$parcelas = filter_input(
    INPUT_POST,
    "parcelas",
    FILTER_VALIDATE_INT
);

if ($valor === false || $valor === null || $valor <= 0) {
    die("Valor inválido.");
}

if ($parcelas === false || $parcelas === null) {
    die("Parcelamento inválido.");
}

switch ($forma) {
    case "pix":
        $pagamento = new Pix();
        $parcelas = 1;
        break;

    case "cartao":
        $pagamento = new Cartao();
        break;

    case "boleto":
        $pagamento = new Boleto();
        $parcelas = 1;
        break;

    default:
        die("Forma de pagamento inválida.");
}

$processador = new ProcessadorPagamento($pagamento);

try {
    $resultado = $processador->processar($valor, $parcelas);
} catch (InvalidArgumentException $erro) {
    die(htmlspecialchars($erro->getMessage()));
}

function dinheiro($valor) {
    return "R$ " . number_format($valor, 2, ',', '.');
}

$data = date("d/m/Y H:i:s");
$numero = strtoupper(bin2hex(random_bytes(4)));

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comprovante</title>
    <link rel="stylesheet" href="estilo.css">
</head>
<body>

<div class="container">

    <h1>Comprovante</h1>

    <div class="sucesso">
        <?php echo htmlspecialchars($resultado["mensagem"]); ?>
    </div>

    <div class="comprovante">

        <p><strong>Número:</strong>
            <?php echo $numero; ?>
        </p>

        <p><strong>Data:</strong>
            <?php echo $data; ?>
        </p>

        <p><strong>Pagamento:</strong>
            <?php echo htmlspecialchars($resultado["forma"]); ?>
        </p>

        <p><strong>Valor total:</strong>
            <?php echo dinheiro($resultado["valor"]); ?>
        </p>

        <p><strong>Parcelas:</strong>
            <?php echo $resultado["parcelas"]; ?>x
        </p>

        <p><strong>Valor por parcela:</strong>
            <?php echo dinheiro($resultado["valorParcela"]); ?>
        </p>

    </div>

    <button onclick="window.print()">Imprimir comprovante</button>

    <a href="index.php" class="voltar">Novo Pagamento</a>

</div>

</body>
</html>
