<?php
class CollectionLoad extends TPage
{
    public function __construct()
    {
        parent::__construct();
        
        try
        {
            TTransaction::open('sample');
            
            $criteria = new TCriteria; // Funcionalidade para setar critérios
            $criteria->add(new TFilter('situacao','=','Y'));
            $criteria->add(new TFilter('genero','=','F'));
            
            $repository = new TRepository('Cliente'); // Vai pegar todos os objetos que atendam os criterios
            
            $objetos = $repository->load($criteria); // Carrega os objetos que atendam o criterio
            
            if($objetos)
            {
                foreach($objetos as $objeto)
                {
                    echo $objeto->id . '-' . $objeto->nome;
                    echo '<br>';
                }
            }
            
            TTransaction::close();
        }    
        catch(Exception $e)
        {
            new TMessage('error',$e->getMessage());
        }
    }
}


