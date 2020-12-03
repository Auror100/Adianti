<?php
class CollectionDelete extends TPage
{
    public function __construct()
    {
        parent::__construct();
        
        try
        {
            TTransaction::open('sample');
            
                TTransaction::dump();
            
            $criteria = new TCriteria; // Funcionalidade para setar critérios
            $criteria->add(new TFilter('situacao','=','Y'));
            $criteria->add(new TFilter('genero','=','F'));
            
            
      
            
            
            $repository = new TRepository('Cliente'); // Vai pegar todos os objetos que atendam os criterios
            $repository->delete($criteria);
        
            
            TTransaction::close();
        }    
        catch(Exception $e)
        {
            new TMessage('error',$e->getMessage());
        }
    }
}






