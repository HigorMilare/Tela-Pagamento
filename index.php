<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Pagamentos</title>
    <link rel="stylesheet" href="estilo.css">
</head>
<body>

<div class="container">

    <h1>Sistema de Pagamentos</h1>
    <p>Exemplo do padrão de projeto Strategy</p>

    <form action="processar.php" method="POST">

        <label>Valor do pagamento</label>
        <input type="number" name="valor"
               min="0.01" step="0.01"
               placeholder="Digite o valor" required>

        <label>Forma de pagamento</label>

        <select name="forma" id="forma" required>
            <option value="">Selecione</option>
            <option value="pix">PIX</option>
            <option value="cartao">Cartão de Crédito</option>
            <option value="boleto">Boleto Bancário</option>
        </select>

        <div id="areaParcelas" style="display: none;">

            <label>Quantidade de parcelas</label>

            <select name="parcelas" id="parcelas">
                <option value="1">1 vez</option>
                <option value="2">2 vezes</option>
                <option value="3">3 vezes</option>
                <option value="4">4 vezes</option>
                <option value="5">5 vezes</option>
                <option value="6">6 vezes</option>
            </select>

        </div>

        <button type="submit">Realizar Pagamento</button>

    </form>

</div>

<script>
    const forma = document.getElementById("forma");
    const areaParcelas = document.getElementById("areaParcelas");

    forma.addEventListener("change", function() {
        if (forma.value === "cartao") {
            areaParcelas.style.display = "block";
        } else {
            areaParcelas.style.display = "none";
            document.getElementById("parcelas").value = "1";
        }
    });
</script>

</body>
</html>
