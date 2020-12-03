<?php
class CollectionLimit extends TPage
{
    public function __construct()
    {
        parent::__construct();
        
        try
        {
            TTransaction::open('sample');
            
            $criteria = new TCriteria; // Funcionalidade para setar critérios
            $criteria->setProperty('limit',10); // Propriedades a serem mostradas
            $criteria->setProperty('offset',20);
            $criteria->setProperty('order','id');
            
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




