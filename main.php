<?php

require_once __DIR__ . '/vendor/autoload.php';

use Moovin\Job\Backend;

$transacaoCc = new CaixaEletronico("5678 678-1", "cc");
$transacaoCc->depositar(1000);
$transacaoCc->transferir(150, "1570 778-0");
$transacaoCc->sacar(600);

$transacaoCp = new CaixaEletronico("1234 900-1", "cp");
$transacaoCp->depositar(1000);
$transacaoCp->transferir(300, "4321 455-0");
$transacaoCp->sacar(1000);
