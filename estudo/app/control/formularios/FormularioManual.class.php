<?php
class FormularioManual extends TPage
{
    public function __construct()
    {
        parent::__construct();
        
        $this->form = new TForm('meu_form'); // Cria um form
        
        $notebook = new TNotebook; // Cria paginação lateral
        $this->form->add($notebook); // Coloca paginação lateral no formulário
        
        $table1 = new TTable;  // Cria tabela
        $table2 = new TTable;
        
        $table1->width = '100%'; // Muda a largura da tabela
        $table2->width = '100%';
        
        $table1->style = 'padding:10px'; // Aumenta o preenchimento da tabela 
        $table2->style = 'padding:10px';
        
        $notebook->appendPage('Página 1', $table1); // Adiciona na primeira página a tabela1
        $notebook->appendPage('Página 2', $table2);
        
        $field1 =  new TEntry('field1'); // Cria campo de input
        $field2 =  new TEntry('field2');
        $field3 =  new TEntry('field3');
        $field4 =  new TEntry('field4');
        $field5 =  new TEntry('field5');
        $field6 =  new TEntry('field6');
        $field7 =  new TEntry('field7');
        $field8 =  new TEntry('field8');
        
        $table1->addRowSet(new TLabel('Campo 1'),$field1); // Adiciona uma linha na tabela e a entrada vai ver guardada em field1
        $table1->addRowSet(new TLabel('Campo 2'),$field2);
        $table1->addRowSet(new TLabel('Campo 3'),$field3);
        $table1->addRowSet(new TLabel('Campo 4'),$field4);
        
        
        $table2->addRowSet(new TLabel('Campo 5'),$field5);
        $table2->addRowSet(new TLabel('Campo 6'),$field6);
        $table2->addRowSet(new TLabel('Campo 7'),$field7);
        $table2->addRowSet(new TLabel('Campo 8'),$field8);
        
        $botao = new TButton('enviar'); // Cria botão de envio
        $botao->setAction(new TAction([$this,'onSend']),'Enviar'); // Ao botão ser clicado realiza uma ação que irá disparar a função onSend
        $botao->setImage('fa:save'); // Imagem para o botão
        
        $this->form->setFields([$field1,$field2,$field3,$field4,$field5,$field6,$field7,$field8,$botao]); // Informa para o formulários que seus campos correspondem aos dados destas variaveis
        
        
        
        $panel = new TPanelGroup('FormularioManual'); //Cria um painel e dá um titulo 
        $panel->add($this->form); // Adiciona o formulário ao painel
        $panel->addFooter($botao); // No rodapé do painel coloca o botão
        
        parent::add($panel); // Adiciona o painel e todos os objetos encapsulados no template
        
    }
    
    public function onSend($param){ // recebe os parametros
        $data = $this->form->getData(); // Data irá receber os dados do formulário
        
        $this->form->setData($data); // Manter o formulário preenchido ao enviar
        
        new TMessage('info',str_replace(',','<br>',json_encode($data)));
        
    }
}
