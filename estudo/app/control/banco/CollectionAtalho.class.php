<?php
class CollectionAtalho extends TPage
{
    public function __construct()
    {
        parent::__construct();
        
        try
        {
             TTransaction::open('sample');
             
             /*
               
             Mostra informações de todos os objetos cliente 
             
             $clientes = Cliente::all();
             
             echo '<pre>';
             print_r($clientes);
             echo '</pre>';
             
             */
             
             /*
              Realizando uma conta baseada em um parametro where
             
             $count = Cliente::where('situacao','=','Y')->count();
             print_r($count);
             
             */
             
             /*
              Utilizando 2 where como parametros de pesquisa
             
             $count = Cliente::where('situacao','=','Y')->where('genero','=','F')->count();
             print_r($count);
             
             */
             
             /*
                Carregando informações de todos os clientes
                baseados no comando where
             
             $clientes = Cliente::where('situacao','=','Y')
                                 ->where('genero','=','F')
                                 ->load();
             echo '<pre>';
             print_r($clientes);
             echo '</pre>';
                                 
             */
             
             /*   
             
                 Ordenando por id
             
             
                  $clientes = Cliente::where('situacao','=','Y')
                                 ->where('genero','=','F')
                                 ->orderBy('id')
                                 ->load();
                  echo '<pre>';
                  print_r($clientes);
                  echo '</pre>';
               
              */
              
              /*
                  Pegando 10 e pulando 10 dos resultados
              
              $clientes = Cliente::where('id','>',0)
                                 ->take(10)
                                 ->skip(10)
                                 ->load();
              echo '<pre>';
              print_r($clientes);
              echo '</pre>';
              
              
              */
              
             /*
                 Pegando apenas o primeiro
             
             $clientes = Cliente::where('situacao','=','Y')
                                 ->where('genero','=','F')
                                 ->first();
             echo '<pre>';
             print_r($clientes);
             echo '</pre>';
             
             */
             
             /*
                 
             
             Cliente::where('cidade_id','=','3')
                    ->set('telefone','222-444')
                    ->update();
                    
             */
             
             /*
             
             Cliente::where('cidade_id','=','3')
                     ->delete();
                     
             */
             
             /*
                 Mostrando id e nome como array 
                 
             $clientes = Cliente::getIndexedArray('id','nome');
             
             echo '<pre>';
             print_r($clientes);
             echo '</pre>';
             
             */ 
             /*
                 Ordenando por id
             
             $clientes = Cliente::where('situacao','=','Y')
                                ->orderBy('id')
                                ->getIndexedArray('id','descricao');
             echo '<pre>';
             print_r($clientes);
             echo '</pre>';
              
             */                    
             TTransaction::close();
        }
        
        catch(Exception $e)
        {
            new TMessage('error',$e->getMessage());
        }
    }
}
