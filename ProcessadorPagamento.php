
<?php

require_once __DIR__ . "/Pagamento.php";

class ProcessadorPagamento {

    private Pagamento $pagamento;

    public function __construct(Pagamento $pagamento) {
        $this->pagamento = $pagamento;
    }

    public function processar($valor, $parcelas = 1) {
        return $this->pagamento->pagar($valor, $parcelas);
    }
}
