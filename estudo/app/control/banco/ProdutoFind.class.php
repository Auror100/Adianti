<?php
class ProdutoFind extends TPage
{
    public function __construct()
    {
        parent::__construct();
        
        try
        {
            TTransaction::open('sample');
            
            TTransaction::dump(); // mostra as transações do banco
            
            $produto = Produto::find(10);// Procura pelo id do produto
            
            if($produto instanceof Produto)
            {
                echo '<b>Descrição</b>' . $produto->descricao;
                echo '<br>';
                echo '<b>Estoque</b>:' . $produto->estoque;
                
                // Se existir retorna as informações
            }
            else
            {
                new TMessage('error','Produto não encontrado');
            }
            
                        
            TTransaction::close();
        }
        catch(Exception $e)
        {
            new TMessage('error',$e->getMessage());
        }
    }
}
