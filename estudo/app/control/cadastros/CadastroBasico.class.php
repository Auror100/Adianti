<?php
class CadastroBasico extends TPage
{
    
    public function __construct()
    {
        parent::__construct();
        
        $this->form = new BootstrapFormBuilder;
        $this->form->setFormTitle('Cidade');
        $this->form->setClientValidation(true); // Validação via front end
        
        $id = new TEntry('id');
        $nome= new TEntry('nome');
        $estado = new TDBCombo('estado_id','sample','Estado','id','nome'); // nome do input, ini, classe, campos na base 
        $id->setEditable(FALSE);
        
            
        $this->form->addFields([new TLabel('Id')],[$id]);
        $this->form->addFields([new TLabel('Nome')],[$nome]);
        $this->form->addFields([new TLabel('Estado')],[$estado]);
        
        $nome->addValidation('Nome',new TRequiredValidator); // Adicionando validação ao nomes
        $estado->addValidation('Estado',new TRequiredValidator);
        
        $this->form->addAction('Salvar', new TAction([$this,'onSave']),'fa:save green');
        $this->form->addActionLink('Limpar',new TAction([$this,'onClear']),'fa:eraser red');  
        parent::add($this->form);      
    }
    
    
    
    public function onClear()
    {
        $this->form->clear(true); // Limpando os campos
    }
    
    
    
    public function onSave($param)
    {
          try
          {
            TTransaction::open('sample');
        
            $this->form->validate(); // Chamando a validação nos campos
        
            $data = $this->form->getData();
            
            $cidade = new Cidade;
            $cidade->fromArray((array) $data); // Pegando todos os dados de TDCombo cidade
            $cidade->store();
            
            $this->form->setData($cidade);
            
            new TMessage('info','Registro salvo com sucesso');
            
            TTransaction::close();  
          }
          catch(Exception $e)
          {
               new TMessage('error',$e->getMessage());
          }  
   
   }
   
   
   
   public function onEdit($param)
   {
       try
       {
           TTransaction::open('sample');
           
           if(isset($param['id'])) // Se tiver um id guardar a data
           {
               $key = $param['id'];
               $cidade = new Cidade ($key); // Pegando o id que estava colocando e chamando o objeto cidade
               $this->form->setData($cidade);
           }
           else
           {
               $this->form->clear(true);
           }    
           
           TTransaction::close();
       }
       catch(Exception $e)
       {
           new TMessage('error', $e->getMessage());
           TTransaction::rollback(); // Caso não seja completado não realizar as mudanças
       }
   }
}
