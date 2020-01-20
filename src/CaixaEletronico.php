<?php

namespace Moovin\Job\Backend;

/**
 * Classe CaixaEletronico
   Não utilizei o Github para fazer o desenvolvimento, acabei utilizando uma IDE e um servidor de testes.
 * Fiquei com dúvida em algumas questões de interpretação então coloquei uma possível opção de mudança de código no comentário da classe sacar.
 * Coloquei alguns exemplos de utilização no main.php 
 @author Brenda David <brenda.david@acad.pucrs.br>
 */


class CaixaEletronico
{

    public $numConta;
    private $tipoConta;
    private $saldo = 0;
    private $limiteSaqueCc = 600;
    private $taxaCc = 2.50;
    private $limiteSaqueCp = 1000;
    private $taxaCp = 0.80;

    //Construtor da classe
    function __construct($conta, $tipo)
    {

        $this->numConta = $conta;
        $this->tipoConta = $tipo;

        echo "<p> As operações disponíveis neste caixa eletrônico são:<br><br> 
        - Saque<br>
        - Depósito<br>
        - Transferência<br>";
    }

    //Métodos acessores
    public function getNumConta()
    {

        return $this->numConta;
    }

    public function setNumConta($numero)
    {

        $this->numConta = $numero;

    }

    public function getTipoConta()
    {

        return $this->$tipoConta;

    }

    public function setTipoConta($tipo)
    {

        $this->tipoConta = $tipo;

    }

    public function getSaldo()
    {

        return $this->$saldo;
    }

    public function setSaldo($saldo)
    {

        $this->saldo = $saldo;
    }

    //Método depositar que recebe apenas o valor como parâmetro
    public function depositar($valor)
    {

        $this->setSaldo($this->getSaldo() + $valor);

    }

    //O método transferir valida se o valor é positivo, se tem saldo na conta e se a conta destino não é a mesma do usuário.
    public function transferir($valorTransferencia, $contaDestino)
    {

        if ($valorTransferencia > 0)
        {

            if ($this->saldo >= $valorTransferencia && $this->getNumConta() != $contaDestino)
            {

                $this->setSaldo($this->saldo -= $valorTransferencia);
                echo "<p>Transferência efetuada com sucesso! Seu saldo atual é de B $ {$this->saldo} </p>";

            }

            else if ($contaDestino == $this->getNumConta())
            {

                echo "<p>Você não pode transferir valores para sua própria conta, vá para a opção de depósito ou insira uma outra conta.</p>";

            }

            else
            {

                echo "<p>Saldo insuficiente, a transferência não foi realizada!</p>";

            }
        }

        else
        {

            echo "<p>O valor informado deve ser positivo e maior do que zero<p/>";
        }

    }

    /*O método sacar valida se o valor é positivo e maior que zero e para cada tipo de conta (cc= Conta corrente ou cp = Conta Poupança)
    valida se o valor não excede o limite de saque por operação. Após a operação, é descontado o respectivo valor de tarifa por operação.
    Como o limite de saque é de até 600(cc), a pessoa poderá sacar 600 e ficará com o valor de tarifa negativo. Caso a conta não possa ficar
    negativa, pequenas alterações deverão ser feitas no código como por exemplo: o trecho $valorSaque <= $this->limiteSaqueCc deverá ser 
    substituido por $valorSaque < $this->limiteSaqueCc. Para conta poupança segue o mesmo raciocínio.*/
    public function sacar($valorSaque)
    {

        if ($valorSaque > 0)
        {
            if ($this->tipoConta == "cc")
            {

                if ($this->saldo >= $valorSaque && $valorSaque <= $this->limiteSaqueCc)
                {

                    $this->setSaldo($this->saldo -= $valorSaque);
                    $this->setSaldo($this->saldo -= $this->taxaCc);

                    echo "<p>Saque efetuado com sucesso! Seu saldo atual é de B $ {$this->saldo}</p>";
                }

                else if ($valorSaque > $this->limiteSaqueCc && $this->saldo >= $valorSaque)
                {

                    echo "<p>O valor excedeu o limite de saque que é de B $ 600,00 por acesso, por favor, insira um valor menor para saque.</p>";
                }

                else
                {

                    echo "<p> Saldo insuficiente. Seu saldo atual é de B $ {$this->saldo} ";
                }
            }

            else if ($this->tipoConta == "cp")
            {

                if ($this->saldo >= $valorSaque && $valorSaque <= $this->limiteSaqueCp)
                {

                    $this->setSaldo($this->saldo -= $valorSaque);
                    $this->setSaldo($this->saldo -= $this->taxaCp);

                    echo "<p>Saque efetuado com sucesso! Seu saldo atual é de B $ {$this->saldo}</p>";
                }

                else if ($valorSaque > $this->limiteSaqueCp && $this->saldo >= $valorSaque)
                {

                    echo "<p>O valor excedeu o limite de saque que é de B $ 1000,00 por acesso, por favor, insira um valor menor para saque.</p>";
                }

                else
                {

                    echo "<p> Saldo insuficiente. Seu saldo atual é de B $ {$this->saldo} ";
                }

            }

            else
            {
                echo "<p>Tipo de conta inválida.</p>";
            }

        }

        else
        {

            echo "<p>O valor informado deve ser positivo e maior do que zero<p/>";
        }

    }

}

?>
