<?php
class CadastroComBusca extends TPage
{
    
    private $form;
    private $datagrid;
    private $pageNavigation;
    private $loaded;

    public function __construct()
    {
        parent::__construct();
        
        $this->form = new BootstrapFormBuilder;
        $this->form->setFormTitle('Cidades');
        $nome = new TEntry('nome');
        $nome->setValue(TSession::getValue('CidadeList_nome')); // Carrega o nome que foi colocado na sessão
        
        
        $this->form->addFields([new TLabel('Nome')],[$nome]);
        
        
        
        $this->form->addAction('Buscar',new TAction([$this,'onSearch']),'fa:search blue');
        $this->form->addActionLink('Novo', new TAction(['CadastroBasico','onClear']),'fa:plus-circle green');
        
       
        $this->datagrid = new BootstrapDatagridWrapper(new TDataGrid);
        $this->datagrid->width = '100%';
        
        
        $col_id = new TDataGridColumn('id','Cód','right','10%');
        $col_nome = new TDataGridColumn('nome','Nome','left','60%');
        $col_estado = new TDataGridColumn('estado->nome','Estado','center','30%'); // estado->nome pega a propriedade nome que está na classe estado
       
       
        $col_id->setAction(new TAction([$this,'onReload'],['order' =>'id' ])); // Order por id
        $col_nome->setAction(new TAction([$this,'onReload'],['order' =>'nome' ])); // Ordenar por nome
        
        
        $this->datagrid->addColumn($col_id);
        $this->datagrid->addColumn($col_nome);
        $this->datagrid->addColumn($col_estado);
        
        
        $action1 = new TDataGridAction(['CadastroBasico','onEdit'],['key' => '{id}']); // Ao clicar em editar será redirecionado para a classe de cadastro 
        $action2 = new TDataGridAction([$this,'onDelete'],['key' => '{id}']);
        
        
        $this->datagrid->addAction($action1,'Editar','fa:edit blue');
        $this->datagrid->addAction($action2,'Excluir','fa:trash-alt red');
        
        
        $this->datagrid->createModel();
        
        
        $this->pageNavigation = new TPageNavigation;
        $this->pageNavigation->setAction(new TAction([$this,'onReload'])); // Naveção por página
      
      
        $panel = new TPanelGroup;
        $panel->add($this->datagrid);
        $panel->addFooter($this->pageNavigation);
        
        
        $vbox = new TVBox;
        $vbox->style ='width:100%';
        $vbox->add($this->form);
        $vbox->add($panel);
        
        
        parent::add($vbox);
        
        
    }
   
   
   
   
    public function onReload($param)
    {
        try
        {
            TTransaction::open('sample');
            
            
            $repository = new TRepository('Cidade');
            
                
                if(empty($param['order']))
                {
                    
                    $param['order'] = 'id'; // Caso o usuário não escolha uma ordem a ordem padrão será crescente por id ascendente
                    $param['direction']='asc';
                    
                    
                }
            
            
            $limit= 5;
            
            
            $criteria = new TCriteria;
            $criteria->setProperty('limit',$limit); // Limite de loads por página
            $criteria->setProperties($param); // Colocando a ordem que deve ser apresentado
            
            
            if(TSession::getValue('CidadeList_filter'))
            {
               
                $criteria->add(TSession::getValue('CidadeList_filter'));
                
            }
            
            
            $cidades = $repository->load($criteria); // Aplicando os critérios a classe cidade


            $this->datagrid->clear(); 
            
            
                if($cidades)
                {
                
                    foreach($cidades as $cidade)
                    {
                        
                        $this->datagrid->addItem($cidade);
                        
                    }  
                      
                }
            
            
            $criteria->resetProperties();
            $count = $repository->count($criteria);
            
            
            $this->pageNavigation->setCount($count);
            $this->pageNavigation->setProperties($param);
            $this->pageNavigation->setLimit($limit); 
            
            
            $this->loaded = true;
            TTransaction::close();           
        }
        catch(Exception $e)
        {
           
            new TMessage('error',$e->getMessage());
            
        }
    }
    
    
    
    
    public static function onSave()
    {
            
        
    }
    
    
    
    
    public function onSearch($param)
    {
    
        $data = $this->form->getData();
        
        if(isset($data->nome))
        {
        
            $filter = new TFilter('nome','like',"%{$data->nome}%");
            
            
            TSession::setValue('CidadeList_filter',$filter);
            TSession::setValue('CidadeList_nome',$data->nome);
            
            
            $this->form->setData($data);
        }
        
        
        $this->onReload([]);        
    }
    
    
    
    
    
    public static function onClear()
    {
        
    }
    
    
    
    
    public static function onDelete($param)
    {
        $action =  new TAction([__CLASS__,'Delete']);
        $action->setParameters($param);
        new TQuestion('Deseja excluir o registro',$action);
    }
    
    
    
    
    
    public static function Delete($param)
    {
        try
        {
            TTransaction::open('sample');
            
            
            $key = $param['key'];
            
            
            $cidade = new Cidade;
            $cidade->delete($key);
            
            
            $pos_action = new TAction([__CLASS__,'onReload']);
            
            
            new TMessage('info','Registro excluído',$pos_action);
            
            
            TTransaction::close();
        }
        catch(Exception $e)
        {
        
            new TMessage('error',$e->getMessage());
            
            TTransaction::rollback();
        }
    }
    
    
    
    
    
    
    function show()
    {
        if(!$this->loaded)
        {
            $this->onReload(func_get_arg(0));
        }
        parent::show();
    }
    
    
 
    
}
