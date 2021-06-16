<?php

/* LISTA DE CEPS NA TABELA DE SERVIÇO L1 (INTERMEDIARIO ENTRE PAC E SEDEX) */
/* KEY = VALOR INICIAL */ /* VALUE = VALOR FINAL */
$faixaCeps = [
    '01000000' => '05999999',
    '06000000' => '06299999',
    '06300000' => '06399999',
    '06400000' => '06499999',
    '06500000' => '06549999',
    '06550000' => '06599999',
    '06600000' => '06649999',
    '06650000' => '06699999',
    '06700000' => '06729999',
    '06730000' => '06749999',
    '06750000' => '06799999',
    '06800000' => '06849999',
    '06850000' => '06889999',
    '06890000' => '06899999',
    '06900000' => '06949999',
    '07000000' => '07399999',
    '07400000' => '07499999',
    '07500000' => '07599999',
    '07600000' => '07699999',
    '07700000' => '07749999',
    '07750000' => '07799999',
    '07800000' => '07899999',
    '07900000' => '07999999',
    '08000000' => '08499999',
    '08500000' => '08549999',
    '08550000' => '08569999',
    '08570000' => '08599999',
    '08600000' => '08699999',
    '08700000' => '08899999',
    '09000000' => '09299999',
    '09300000' => '09399999',
    '09400000' => '09449999',
    '09450000' => '09499999',
    '09500000' => '09599999',
    '09600000' => '09899999',
    '09900000' => '09999999',
    '11000000' => '11249999',
    '12200001' => '12249999',
    '12300001' => '12349999',
    '12900001' => '12929999',
    '12940000' => '12954999',
    '13000000' => '13139999',
    '13140000' => '13149999',
    '13150000' => '13159999',
    '13160000' => '13164999',
    '13165000' => '13169999',
    '13170000' => '13182999',
    '13183000' => '13189999',
    '13190000' => '13199999',
    '13200000' => '13219999',
    '13250000' => '13259999',
    '13270000' => '13279999',
    '13280000' => '13289999',
    '13330000' => '13349999',
    '13380001' => '13389999',
    '13400001' => '13439999',
    '13450000' => '13459999',
    '13460000' => '13464999',
    '13465000' => '13479999',
    '13480000' => '13819999',
    '13820000' => '13824999',
    '13825000' => '13829999',
    '13830000' => '13834999',
    '13920000' => '13929999',
    '18000001' => '18109999',
    '18110001' => '18119999',
];

while (true) {

    $cepError = false;
    $result = 0;
    echo "\033[0m\n";
    echo "Digite o CEP para consulta: ";

    $cepConsulta = fopen('php://stdin', 'r');
    $cepConsulta = trim(fgets($cepConsulta));

    // CLEAR COMMAND
    if($cepConsulta == "") continue;

    // SAIR
    if($cepConsulta == "s") die();

    // REMOVE TRAÇO SEPARADOR DO CEP
    $pos = strpos($cepConsulta, "-");
    if($pos) {
       if(strlen($cepConsulta) != 9) $cepError = true;
       $cepConsulta = substr($cepConsulta, 0, 5) . substr($cepConsulta, 6, 3);
    }

    // VALIDA ENTRADA CEP
    if(strlen($cepConsulta) != 8) $cepError = true;
    if(! is_numeric($cepConsulta)) $cepError = true;

    // MENSAGEM ERRO
    if($cepError) {   
        echo "\n";
        echo "    " . "\033[41m" . "CEP DIGITADO INVÁLIDO\033[0m\n";
        continue;
    }

    // VERIFICA TABELA
    foreach($faixaCeps as $inicial => $final) {
        if((intval($cepConsulta) >= intval($inicial)) && (intval($cepConsulta) <= intval($final))) 
        {
            $result = 1;
        }    
    }

    // RECONSTROI CEP COM TRAÇO    
    $cepConsulta = substr($cepConsulta, 0, 5) . "-" . substr($cepConsulta, 5, 3);

    // IMPRIME RESULTADO    
    echo "\n";
    if($result) echo "    " . "\033[41m" . "O CEP: " . $cepConsulta . " PERTENCE A TABELA LOCAL L1.\033[0m\n";
    else echo "    " . "O CEP: " . $cepConsulta . " ESTA FORA DA TABELA L1.\n";

}