<?php
class DataGridFormats extends TPage
{
    public function __construct()
    {
        parent::__construct();
        
        $this->datagrid = new BootstrapDatagridWrapper(new TDataGrid); // Criando a data grid e modelando no padrão bootstrap
        $this->datagrid->width = '100%';
        $this->datagrid->enablePopover('Detalhes' , '<b>ID</id> {id} <br> <b>Nome</b> {nome}'); // Popover que aparece ao passar o mouse sobre uma linha
        
        $col_id = new TDataGridColumn('id', 'Código','center');
        $col_nome = new TDataGridColumn('nome','Nome','left');
        $col_cidade = new TDataGridColumn('cidade','Cidade','left');
        $col_estado = new TDataGridColumn('estado','Estado','left');
        $col_nascimento = new TDataGridColumn('nascimento','Nascimento','left');
        $col_cache = new TDataGridColumn('cache','Cache','right');
        
        $col_cache->setDataProperty('style','font-weight:bold'); // Colocando as letra em negrito
        $col_cache->setTransformer([$this, 'formatCache']); //Set Transformer irá permitir uma função para mudanças
        $col_nascimento->setTransformer([$this,'formatDate']);
        
        $col_id->title = 'Clique nesta coluna para ação';
        
        
        $this->datagrid->addColumn($col_id);
        $this->datagrid->addColumn($col_nome);
        $this->datagrid->addColumn($col_cidade);
        $this->datagrid->addColumn($col_estado);
        $this->datagrid->addColumn($col_nascimento);
        $this->datagrid->addColumn($col_cache);
        
        
     
        
      
        
        
        
        //após definir colunas, e ações... criar a estrutura
        
        
        $this->datagrid->createModel(); // Cria a datagrid que foi setada
        /*
        $item = new stdClass;
        $item->id =1;
        $item->nome = 'Aretha Franklin';
        $item->cidade = 'Memphis';
        $item->estado = 'Tenesse';
        
        $this->datagrid->addItem($item);
        */
        
    
        
      
        
        $panel = new TPanelGroup('Datagrid');
        $panel->add($this->datagrid);
        
        parent::add($panel);
        
    }
    
    public function formatDate($nascimento,$object,$row) // Carrega a variável, o objeto inteiro e a linha
    {
        $date = new DateTime($object->nascimento);
        return $date->format('d/m/Y'); // Propriedade format
    }
    
    public function formatCache($cache,$object,$row)
    {
        $formatado = number_format($cache,2,',','.');
        
        if($cache < 200000)
        {
            $row->style = 'background: #FFF9A7';
            
            return "<span style='color:#F00'>$formatado</span>";
        }
        else
        {
            return"<span style='color:#0F0'>$formatado</span>";
        }
       
    }
    
    public function onView($param)
    {
        new TMessage('info','ID' . $param['id'] . '- Nome:' . $param['nome']);
    }
    
  
 
    
    
    public function onReload()
    {
        $this->datagrid->clear(); // Limpa  a data grid
        
        $item = new stdClass;
        $item->id =1;
        $item->nome = 'Aretha Franklin';
        $item->cidade = 'Memphis';
        $item->estado = 'Tenessee (US)';
        $item->nascimento = '1942-03-25';
        $item->cache= 100000;
        $this->datagrid->addItem($item);
        
        $item = new stdClass;
        $item->id =2;
        $item->nome = 'Eric Clapton';
        $item->cidade = 'Ripley';
        $item->estado = 'Surrey (UK)';
        $item->nascimento = '1982-04-25';
        $item->cache= 200000;
        $this->datagrid->addItem($item);
        
        $item = new stdClass;
        $item->id =3;
        $item->nome = 'Chris brown';
        $item->cidade = 'Ripley';
        $item->estado = 'Surrey (UK)';
        $item->nascimento = '1980-03-25';
        $item->cache= 300000;
        $this->datagrid->addItem($item);
        
    }
    
    public function show()
    {
        $this->onReload(); // Recarrega as informações
        parent::show();
    }
}
