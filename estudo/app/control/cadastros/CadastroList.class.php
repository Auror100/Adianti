<?php
class CadastroList extends TPage
{
    private $datagrid;
    private $pageNavigation;
    
    use Adianti\Base\AdiantiStandardListTrait; // Importando a lib Traitr
    
    public function __construct()
    {
        parent::__construct();
        
        $this->setDatabase('sample');// Setando a base
        $this->setActiveRecord('Cliente'); // Setando a classe
        $this->setDefaultOrder('id','asc');// Ordem será por id em ascendente
        $this->addFilterField('id','=','id'); // id exato
        $this->addFilterField('nome','like','nome'); // nome preciso
        $this->addFilterField('endereco','like','endereco');
        $this->addFilterField('genero','=','genero');
        $this->addFilterField('(SELECT nome from cidade where cidade.id = cidade_id)','like','cidade');// Pesquisa de cidade com foreign key
        $this->setOrderCommand('city->name', '(select nome from cidade where cidade_id= cidade.id)'); // setando um atalho para pegar o nome da cidade
         
        
        $this->datagrid = new BootstrapDatagridWrapper(new TDataGrid);
        $this->datagrid->style = 'width:100%';
        
        
        
        $col_id = new TDataGridColumn('id','Cód','center','10%');
        $col_nome = new TDataGridColumn('nome','Nome','left','28%');
        $col_endereco = new TDataGridColumn('endereco','Endereço','left','28%');
        $col_cidade = new TDataGridColumn('{cidade->nome}({cidade->estado->nome})','Cidade','left','28%'); // Acessando cidade, depois pelo objeto cidade que possui id de estado como foreign key e assim chegando no nome do estado
        $col_genero = new TDataGridColumn('genero','Gênero','left','6%');
        
        
        
        $col_id->setAction(new TAction([$this,'onReload']),['order' =>'id']);  // Possibilidade de ordenar pelo atributo
        $col_nome->setAction(new TAction([$this,'onReload'],['order' =>'nome']));
        $col_endereco->setAction(new TAction([$this,'onReload'],['order' =>'endereco']));
        $col_cidade->setAction(new TAction([$this,'onReload'],['order' =>'city->name']));
        
        
        
        $this->datagrid->addColumn($col_id);
        $this->datagrid->addColumn($col_nome);
        $this->datagrid->addColumn($col_endereco); 
        $this->datagrid->addColumn($col_cidade);
        $this->datagrid->addColumn($col_genero);
         
        
        
        
        
        $col_genero->setTransformer
        (
            function($genero)
            {
                return $genero == 'F' ? 'Feminino' : 'Masculino' ; // Se cidade igual a F então feminino senão masculino
            }    
        );
        
        
        
        
        $action1 = new TDataGridAction(['ClienteForm','onEdit'],['key' =>'{id}','register_state' =>'false']); // Não altera a url do navegador
        $action2 = new TDataGridAction([$this,'onDelete'],['key' => '{id}']);
        
        
        $this->datagrid->addAction($action1,'Editar','fa:edit blue');
        $this->datagrid->addAction($action2,'Excluir','fa:trash-alt red');
        
        
        $this->datagrid->createModel();
        
        
        $this->form = new TForm;
        $this->form->add($this->datagrid);
        
        
        $id = new TEntry('id');
        $nome = new TEntry('nome');
        $endereco = new TEntry('endereco');
        $cidade = new TEntry('cidade');
        $genero = new TCombo('genero');
        
        
        
        $genero->addItems(['M' => 'Masculino', 'F' => 'Feminino']);
        
        
        
        $id->exitOnEnter(); // Enter dispara a ação
        $nome->exitOnEnter();
        $endereco->exitOnEnter();
        $cidade->exitOnEnter();
        
        
        
        $id->tabindex = -1; // Não carrega caso você clique fora
        $nome->tabindex= -1;
        $endereco->tabindex = -1;
        $cidade->tabindex = -1;
        $genero->tabindex = -1;
        
        
        
        $id->setExitAction(new TAction([$this,'onSearch'],['static' => '1'])); // Carrega só a função
        $nome->setExitAction(new TAction([$this,'onSearch'],['static' => '1']));
        $endereco->setExitAction(new TAction([$this,'onSearch'],['static' => '1']));
        $cidade->setExitAction(new TAction([$this,'onSearch'],['static' => '1']));
        $genero->setChangeAction(new TAction([$this,'onSearch'],['static' => '1']));
        
        
        
        $tr = new TElement('tr');
        $this->datagrid->prependRow($tr);
        
        
        
        $tr->add(TElement::tag('td',''));
        $tr->add(TElement::tag('td',''));
        $tr->add(TElement::tag('td',$id));
        $tr->add(TElement::tag('td',$nome));
        $tr->add(TElement::tag('td',$endereco));
        $tr->add(TElement::tag('td',$cidade));
        $tr->add(TElement::tag('td',$genero));
        
        
        
        $this->form->addField($id);
        $this->form->addField($nome);
        $this->form->addField($endereco);
        $this->form->addField($cidade);
        $this->form->addField($genero);
        
        
        
        $this->form->setData(TSession::getValue(__CLASS__.'_filter_data')); / Salvando a pesquisa
         
        
        
        
        $this->pageNavigation = new TPageNavigation;
        $this->pageNavigation->setAction(new TAction([$this,'onReload']));
        $this->pageNavigation->enableCounters();
        
        
        
        $panel = new TPanelGroup('Clientes');
        $panel->add($this->form);
        $panel->addFooter($this->pageNavigation);
        
        
        
        
        $dropdown = new TDropDown('Exportar','fa:list');
        $dropdown->setButtonClass('btn btn-default waves-effect dropdown-toggle');
        $dropdown->addAction('Save as CSV',new TAction([$this,'onExportCSV'],['register_state' =>'false','static' => '1' ]),'fa:table fa-fw blue');
        $dropdown->addAction('Save as PDF',new TAction([$this,'onExportPDF'],['register_state' =>'false','static' => '1' ]),'far:file-pdf fa-fw red');// Utilizando a importação do trait
        $dropdown->addAction('Save as XML',new TAction([$this,'onExportXML'],['register_state' =>'false','static' => '1' ]),'fa:code fa-fw green'); 
        
        
        
        
        $panel->addHeaderWidget($dropdown);
        $panel->addHeaderActionLink('Novo',new TAction(['ClienteForm','onEdit'],['register_state' => 'false']),'fa:plus green');
        
        
        
        
        
        parent::add($panel);
        
    }
}
