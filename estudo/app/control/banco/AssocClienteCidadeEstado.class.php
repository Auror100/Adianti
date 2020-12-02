<?php
class AssocClienteCidadeEstado extends TPage
{
    public function __construct()
    {
        parent::__construct();
        
        try
        {
            TTransaction::open('sample');
            
            $cliente = new Cliente(3);
            $produto = new Produto(3);
            
            
            echo $cliente->nome;
            echo '<br>';
            echo $cliente->cidade->nome; // Por causa do get_cidade no cliente da para acessar o nome da cidade
            echo '<br>';
            echo $cliente->cidade->estado->nome; // Por causa do get_estado na cidade da para acessar o nome do estado
            
            //
            
            echo '<pre>';
            print_r($cliente->toArray()); // Printando o objeto com array
            echo '<pre>';
            
            //
            
            
            
            $dados = [];
            $dados['descricao'] = 'Smart Watch';
            $dados['estoque'] = 2;
            $dados['preco_venda']=200;
            $dados['unidade']= 'PC';
            
            $produto = new Produto;
            $produto->fromArray($dados); // Transformando o objeto em array
            $produto->store();
             
             //
             
             print $produto->render('O produto (<b>{id}</b>) - nome <b>{descricao}</b> - preco R$ <b>{preco_venda}</b>'); // Cria a capacidade de setar uma máscara e colocar os parâmetros
             echo '<br>';
             
             //
             
             $produto->evaluate('= {preco_venda} * {estoque}'); // Cria a capacidade de fazer uma equação customizável
             
             
            TTransaction::close();
        }
        catch(Exception $e)
        {
            new TMessage('error',$e->getMessage());
        }
    }
}
