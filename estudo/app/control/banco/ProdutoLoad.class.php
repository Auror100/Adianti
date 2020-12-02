<?php
class ProdutoLoad extends TPage
{
    public function __construct()
    {
        parent::__construct();
        
        try
        {
            TTransaction::open('sample');
            
            TTransaction::dump(); // mostra as transações do banco
            
            $produto = new Produto(10);
            
            echo '<b>Descrição</b>' . $produto->descricao;
            echo '<br>';
            echo '<b>Estoque</b>:' . $produto->estoque;
            
            TTransaction::close();
        }
        catch(Exception $e)
        {
            new TMessage('error',$e->getMessage());
        }
    }
}
