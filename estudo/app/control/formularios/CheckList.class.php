<?php
class CheckList extends TPage
{
     public function __construct()
     {
         parent::__construct();
         
         $this->form = new BootstrapFormBuilder;
         $this->form->setFormTitle('Check list');
         
         $id = new TEntry('id');
         $nome = new TEntry('nome');
         $lista = new TCheckList('lista_produtos'); // Cria Checklist
         
         $lista->addColumn('id', 'Id', 'center', '10%'); // Entry, nome, customizações
         $lista->addColumn('descricao','Descricao', 'left' , '50%');
         $lista->addColumn('preco_venda', 'Preço venda', 'left', '40%');
         $lista->setHeight(250);
         $lista->makeScrollable(); // Cria barra de rolagem
         
         $input = new TEntry('busca');
         $input->placeholder = 'Busca...';
         $input->setSize('100%');
         
         $lista->enableSearch($input,'id,descricao,preco_venda'); // Habilita a pesquisa desses campos
         
         $hbox = new THBox; // Cria caixa
         
         $hbox->style = 'border-bottom:1px solid gray; padding-bottom:10px';
         $hbox->add(new TLabel('Produtos'));
         $hbox->add($input)->style = 'float:right; width:30%';
         
       
         
         $this->form->addFields([new TLabel('Id')], [$id]);
         $this->form->addFields([new TLabel('Nome')], [$nome]);
         $this->form->addFields([new TLabel('Produtos')], [$lista]);
         
         $this->form->addContent([$hbox]); // Coloca a caixa dentro do formulário
         $lista->addItems(Produto::allInTransaction('sample'));
         
         $this->form->addAction('Enviar', new TAction([$this,'onSend']),'fa:save');
         
         parent::add($this->form);
         
         
     }
     
     public static function onSend($param)
     {
         new TMessage('info', json_encode($param));
     }
     
     
}