<?php
class FormularioInputBase extends TPage
{
    public function __construct()
    {
        parent::__construct();
        
        $this->form = new BootstrapFormBuilder;
        $this->form->setFormTitle('Campos de seleção');
    
        
        $radio = new TDBRadioGroup('radio','sample','Categoria','id','nome'); // Entry , .ini , table, primary key, nome
        $radio2 = new TDBRadioGroup('radio2','sample','Categoria','id','{id} - {nome}'); // Ultimos parametros sao mascaras
        $check = new TDBCheckGroup('check','sample','Categoria','id','nome'); // Check
        $check2 = new TDBCheckGroup('check2','sample','Categoria','id','{id} - {nome}');
        $combo2 = new TCombo('combo','sample','Categoria','id','nome');
        $combo = new TCombo('combo2','sample','Categoria','id','nome');
        $select = new TSelect('select','sample','Categoria','id','nome'); // Diferente do combo da para selecionar mais de uma opção no select
        $search =  new TMultiSearch('search','sample','Categoria','id','nome'); // Tem uma caixa de pesquisa
        $unique =  new TUniqueSearch('unique','sample','Categoria','id','nome'); // Da para acrescentar Tags no estilo SoundCloud
        $autocomp = new TEntry('autocomplete','sample','Categoria','id','nome'); // Da para autocompletar o que foi feito
      
        $radio->setLayout('horizontal');
        $radio2->setLayout('horizontal');
        $check->setLayout('horizontal');
        $check2->setLayout('horizontal');
        $radio2->setUseButton();
        $check2->setUseButton();
        $combo2->enableSearch();
        $search->setMinLength(1);
        $unique->setMinLength(1);
        
        /*
        $search->setMask('{nome} ({id})');
        
        $unique->setMask('{nome} ({id})');
        
        */
        
        /*
        $radio->setValue('b');
        $radio2->setValue('b');
        $check->setValue(['a','c']);
        $check2->setValue(['a','c']);
        $combo->setValue('b');
        $combo2->setValue('b');
        $select->setValue(['a','c']);
        $search->setValue(['a','c']);
        $unique->setValue(['b']);
        $multi->setValue(['aaa','ccc']);
        
        */
        
        $this->form->addFields([new TLabel('Radio 1')],[$radio]);
        $this->form->addFields([new TLabel('Radio 2')],[$radio2]);
        $this->form->addFields([new TLabel('Check 1')],[$check]);
        $this->form->addFields([new TLabel('Check 2')],[$check2]);
        $this->form->addFields([new TLabel('Combo')],[$combo]);
        $this->form->addFields([new TLabel('Combo 2')],[$combo2]);
        $this->form->addFields([new TLabel('Select')],[$select]);
        $this->form->addFields([new TLabel('Unique Search')],[$unique]);
        $this->form->addFields([new TLabel('Auto complete')],[$autocomp]);
        
        $this->form->addAction('Enviar',new TAction([$this,'onSend']),'fa:save');
        
        
        parent::add($this->form);
    }
    
    public function onSend($param)
    {
        $data = $this->form->getData();
        
        $this->form->setData($data);
    }
}
