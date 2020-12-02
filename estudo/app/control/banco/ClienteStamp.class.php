<?php
class ClienteStamp extends TPage
{
    public function __construct()
    {
        parent::__construct();
        
        try
        {
            TTransaction::open('sample');
           
           
            $cliente = new Cliente; // Cria o objeto 
            $cliente->nome = "Teste";
            $cliente->endereco="Rua teste";
            $cliente->telefone="123";
            $cliente->categoria_id=1;
            $cliente->cidade_id=1;
            $cliente->store();
            
            new TMessage('info','Cliente cadastrado com sucesso');
            
            TTransaction::close();    
        }
        catch(Exception $e)
        {
            new TMessage('error',$e->getMessage());
        }
    }
    
}

