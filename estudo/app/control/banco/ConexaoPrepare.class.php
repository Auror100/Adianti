<?php
class ConexaoPrepare extends TPage
{
    public function __construct()
    {
        parent::__construct();
        
        try
        {
            TTransaction::open('sample');
            
            //var_dump(TTransaction::getDatabase()); traz o nome da DB
            //var_dump(TTransaction::getDatabaseInfo()); traz as infos de uma DB
            
            $conn =  TTransaction::get();
            
            $statement = $conn->prepare('SELECT id, nome FROM cliente WHERE id>= ? AND id<=?'); // Cria o Prepare
            $statement->execute([3,12]); // Envia os valores
            
            $result =  $statement->fetchAll(); // Termina o prepare e executa
            
            foreach($result as $row)
            {
                print $row['id'] . '-'.
                      $row['nome'] . "<br>\n";
            }
            
            TTransaction::close();
        }
        catch(Exception $e)
        {
            new TMessage('error',$e->getMessage());
        }
    }
}
