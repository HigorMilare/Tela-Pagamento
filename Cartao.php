
<?php

require_once __DIR__ . "/Pagamento.php";

class Cartao implements Pagamento {

    public function pagar($valor, $parcelas = 1) {

        if ($parcelas < 1 || $parcelas > 6) {
            throw new InvalidArgumentException("Parcelamento inválido.");
        }

        return [
            "forma" => "Cartão de Crédito",
            "valor" => $valor,
            "parcelas" => $parcelas,
            "valorParcela" => $valor / $parcelas,
            "mensagem" => "Pagamento com cartão simulado com sucesso!"
        ];
    }
}
