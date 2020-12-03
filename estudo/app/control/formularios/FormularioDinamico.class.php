<?php
class FormularioDinamico extends TPage
{
     public function __construct()
     {
         parent::__construct();
         
         $this->form = new BootstrapFormBuilder('meu_form');
         $this->form->setFormTitle('Lista de campos');
         
         $combo = new TCombo('combo[]'); // Os [] apontam para o form que ele pode ser preenchido mais de uma vez em uma mesma requisição
         $texto =  new TEntry('texto[]');
         $numero = new TEntry('valor[]');
         $date = new TDate('dt_registro[]');
         
         $combo->enableSearch(); // Habilita pesquisa por uma seleção no TCombo
         $combo->addItems(['a' => 'Opção A', 'b' => 'Opçao B']);
         $combo->setSize('100%');
         
         $texto->setSize('100%');
         $numero->setSize('100%');
         $numero->style = 'text-align:right';
         $date->setSize('100%');

         $fieldlist = new TFieldList; // Criador de lista dinâmica
         $fieldlist->width = '100%';
         $fieldlist->addField('<b>Combo</b>',$combo,['width' => '25%']); // Cabeçalho
         $fieldlist->addField('<b>Texto</b>',$texto,['width' => '25%']);
         $fieldlist->addField('<b>Número</b>',$numero,['width' => '25%']);
         $fieldlist->addField('<b>Data Registro</b>',$date,['width' => '25%']);
         
         $fieldlist->enableSorting(); //Habilita mudar os campos de lugar
         
         $fieldlist->addHeader(); //Habilita os títulos das colunas
         $fieldlist->addDetail(new stdClass); // Numero de vez que os campos vão aparecer na tela inicial
         $fieldlist->addDetail(new stdClass);
         $fieldlist->addDetail(new stdClass);
         $fieldlist->addDetail(new stdClass);
         $fieldlist->addCloneAction(); // Cria a capacidade de aumentar o número de campos
         
         $this->form->addField($combo); // Fala quais campos o form vai gerenciar no post
         $this->form->addField($numero);
         $this->form->addField($date);
         $this->form->addField($texto);
         
         
         
         $this->form->addContent([$fieldlist]);
         $this->form->addAction('Enviar',new TAction([$this,'onSend']),'fa:save');
         
         parent::add($this->form);
         
     }
     
     public static function onSend($param)
     {
         new TMessage('info', json_encode($param));
     }
     
     
}