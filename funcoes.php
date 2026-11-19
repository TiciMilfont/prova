<?php 

function lerFuncionarios() {
    $arquivo = __DIR__ . "/funcionarios.json";

    if  (!file_exists($arquivo)){ return[ ];}

    $dados = file_get_contents($dados , true) ?? [ ];

}

function salvarFuncionarios($funcionarios) {
    $arquivo = __DIR__ . "/funcionarios.json";
    $json = json_encode ($funcionarios, JSON_PRETTY_PRINT);

    file_put_contents($arquivo, $json , LOCK_EX);

}
