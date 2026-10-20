
<?php

require_once __DIR__ . "/Pagamento.php";

class Boleto implements Pagamento {

    public function pagar($valor, $parcelas = 1) {
        return [
            "forma" => "Boleto Bancário",
            "valor" => $valor,
            "parcelas" => 1,
            "valorParcela" => $valor,
            "mensagem" => "Boleto simulado gerado com sucesso!"
        ];
    }
}
