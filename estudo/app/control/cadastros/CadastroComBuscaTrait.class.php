<?php
class CadastroComBuscaTrait extends TPage
{
    
    private $form;
    private $datagrid;
    private $pageNavigation;
    
    use Adianti\Base\AdiantiStandardListTrait; // Importando o Trait

    public function __construct()
    {
        parent::__construct();
        
        $this->setDatabase('sample');
        $this->setActiveRecord('Cidade');
        $this->addFilterField('nome','like','nome');
        $this->setDefaultOrder('id','asc');
        
        $this->form = new BootstrapFormBuilder;
        $this->form->setFormTitle('Cidades');
        $nome = new TEntry('nome');
        
        
        
        $this->form->addFields([new TLabel('Nome')],[$nome]);
        $this->form->setData(TSession::getValue(__CLASS__.'_filter_data')); // Carrega o nome que foi colocado na sessão
        
        
        $this->form->addAction('Buscar',new TAction([$this,'onSearch']),'fa:search blue');
        $this->form->addActionLink('Novo', new TAction([$this,'clear']),'fa:eraser red');
        
       
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
    
    
    
    
    public function clear()
    {
        $this->clearFilters(); // Limpar os filtros no carregamento
        $this->onReload();
    }   
}
