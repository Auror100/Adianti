<?php
class DataGridExportarPDF extends TPage
{
    public function __construct()
    {
        parent::__construct();
        
        $this->datagrid = new BootstrapDatagridWrapper(new TDataGrid); // Criando a data grid e modelando no padrão bootstrap
        $this->datagrid->width = '100%';
        $this->datagrid->enablePopover('Detalhes' , '<b>ID</id> {id} <br> <b>Nome</b> {nome}'); // Popover que aparece ao passar o mouse sobre uma linha
        
        $col_id = new TDataGridColumn('id', 'Código','center','10%');
        $col_nome = new TDataGridColumn('nome','Nome','left','30%');
        $col_cidade = new TDataGridColumn('cidade','Cidade','left','30%');
        $col_estado = new TDataGridColumn('estado','Estado','left','30%');
        
        $col_id->title = 'Clique nesta coluna para ação';
        
        
        $this->datagrid->addColumn($col_id, new TAction([$this,'onColumnAction'],['coluna' => 'id']));
        $this->datagrid->addColumn($col_nome);
        $this->datagrid->addColumn($col_cidade);
        $this->datagrid->addColumn($col_estado);
        
        $action1 = new TDataGridAction([$this,'onView'],['id' => '{id}' , 'nome' =>'{nome}','teste' => '5']);
        $action2 = new TDataGridAction([$this,'onDelete'],['id' => '{id}', 'nome' =>'{nome}']);
        
        $action1->setUseButton(true); // Transformando em um botão quadrado
        $action2->setUseButton(true);
        
        
        $this->datagrid->addAction($action1,'Visualiza','fa:search blue');
        $this->datagrid->addAction($action2,'Exclui','fa:trash red');
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
        
        $panel->addHeaderActionLink('Salvar PDF', new TAction([$this,'exportaPDF'],['register_state' => 'false']),'far:file-pdf red');
        $panel->addHeaderActionLink('Salvar CSV', new TAction([$this,'exportaCSV'],['register_state' => 'false']),'fa:table black ');
        parent::add($panel);
        
    }
    
    public function exportaCSV()
    {
        try
        {
            $data = $this->datagrid->getOutputData(); // Retorna uma matriz com todos os dados formatados
            
            if($data)
            {
                $file = 'app/output/datagrid-exporta.csv'; // Vai exportar com esse nome e essa extensão
                
                $handler = fopen($file,'w'); // Habilita a escrita no arquivo que está sendo criado
                
                foreach($data as $row)
                {
                    fputcsv($handler,$row); // Formata os dados de maneira automática
                }
                fclose($handler);
                
                parent::openFile($file); // Força o download do arquivo
            }
        }
        catch(Exception $e)
        {
           new TMessage('error',$e->getMessage());
        }
    }
    
    public function exportaPDF($param)
    {
        try
        {
            $html = clone $this->datagrid; // Transforma em html puro
            $conteudo =file_get_contents('app/resources/styles-print.html'). $html->getContents(); // Estilização que o curso já disponibilizou sendo passado ao conteudo que virou html puro
            
            $dompdf = new \Dompdf\Dompdf; // Importa a lib
            $dompdf->loadHtml($conteudo); // Conteudo carregado como html
            $dompdf->setPaper('A4','portrait');
            $dompdf->render(); // Transforma em pdf
            
            $file ='app/output/datagrid-exporta.pdf';
            
            file_put_contents($file,$dompdf->output()); //Coloca o conteúdo neste arquivo
            
            $window = TWindow::create('Exportação',0.8,0.8); // Cria janela com 80% de largura e altura
            
            $object = new TElement('object'); // Ler documentação wc3 html sobre objects suportados
            $object->data = $file; //Coloca o pdf no objeto
            $object->type = 'application/pdf';
            $object->style='width:100%;height:99%;';
            
            $window->add($object);
            $window->show();
        }
        catch(Exception $e)
        {
            new TMessage('error',$e->getMessage());
        }
    }
    
    
    public function onView($param)
    {
        new TMessage('info','ID' . $param['id'] . '- Nome:' . $param['nome']);
    }
    
      public function onDelete($param)
    {
        new TMessage('error','ID' . $param['id'] . '- Nome:' . $param['nome']);
    }
    
    
       public function onColumnAction($param)
    {
        new TMessage('info','Coluna clicada' . $param['coluna']);
    }
    
    
    public function onReload()
    {
        $this->datagrid->clear(); // Limpa  a data grid
        
        $item = new stdClass;
        $item->id =1;
        $item->nome = 'Aretha Franklin';
        $item->cidade = 'Memphis';
        $item->estado = 'Tenessee (US)';
        $this->datagrid->addItem($item);
        
        $item = new stdClass;
        $item->id =2;
        $item->nome = 'Eric Clapton';
        $item->cidade = 'Ripley';
        $item->estado = 'Surrey (UK)';
        $this->datagrid->addItem($item);
        
        $item = new stdClass;
        $item->id =3;
        $item->nome = 'Chris brown';
        $item->cidade = 'Ripley';
        $item->estado = 'Surrey (UK)';
        $this->datagrid->addItem($item);
        
    }
    
    public function show()
    {
        $this->onReload(); // Recarrega as informações
        parent::show();
    }
}


