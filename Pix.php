
<?php

require_once __DIR__ . "/Pagamento.php";

class Pix implements Pagamento {

    public function pagar($valor, $parcelas = 1) {

        return [
            "forma" => "PIX",
            "valor" => $valor,
            "parcelas" => 1,
            "valorParcela" => $valor,
            "mensagem" => "Pagamento via PIX simulado com sucesso!"
        ];
    }
}
