<?php
class CollectionBatchUpdate extends TPage
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
            
            
            $valores = [];
            $valores['telefone'] = '1111-5555';
            
            
            $repository = new TRepository('Cliente'); // Vai pegar todos os objetos que atendam os criterios
            $repository->update($valores,$criteria);
            /*
               Vai realizar apenas um comando update que irá
               alterar todos aqueles que atenderem ao critério
               e ao filtro. 
           
            */
      
            
            TTransaction::close();
        }    
        catch(Exception $e)
        {
            new TMessage('error',$e->getMessage());
        }
    }
}




