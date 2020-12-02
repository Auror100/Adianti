<?php
class ProdutoStore extends TPage
{
    public function __construct()
    {
        parent::__construct();
        
        try
        {
            TTransaction::open('sample');
           /* 
            TTransaction::setLogger(new TLoggerTXT('/tmp/log.txt')); Cria um logger
            
            TTransaction::dump('/tmp/log.txt'); //Mostra as gravações do log
            
            TTransaction::setLoggerFunction(function($mensagem)
            {
                print $mensagem . '<br>';
            }
            ); Habilita fazer operações com o Log        
           */
           
            $produto = new Produto; // Cria o objeto 
            $produto->descricao = "Gravador DVD"; // Seta os parametros
            $produto->estoque = 10;
            $produto->preco_venda = 100;
            $produto->unidade = 'PC';
            $produto->local_foto = '';
            $produto->store();
            
            new TMessage('info','Produto cadastrado com sucesso');
            
            TTransaction::close();    
        }
        catch(Exception $e)
        {
            new TMessage('error',$e->getMessage());
        }
    }
    
}
