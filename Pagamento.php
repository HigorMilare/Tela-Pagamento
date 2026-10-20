
<?php

interface Pagamento {
    public function pagar($valor, $parcelas = 1);
}
