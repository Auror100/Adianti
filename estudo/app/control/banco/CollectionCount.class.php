<?php
class CollectionCount extends TPage
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
            
            $count = $repository->count($criteria);
            
            new TMessage('info',"Registros: $count");
            
            TTransaction::close();
        }    
        catch(Exception $e)
        {
            new TMessage('error',$e->getMessage());
        }
    }
}
