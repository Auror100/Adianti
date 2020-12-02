<?php
class ProdutoUpdate extends TPage
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
                 $produto->descricao = 'Gravador CD-R';
                 $produto->store();   
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

