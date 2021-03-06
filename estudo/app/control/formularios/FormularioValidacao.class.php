<?php
class FormularioValidacao extends TPage
{
    public function __construct()
    {
        parent::__construct();
        
        $this->form = new BootstrapFormBuilder;
        $this->form->setFormTitle('Validações');
        $this->form->setClientValidation(true); // Roda no client side ao invés do server, contudo não se deve usar em form com paginação lateral
        
        
        $field1 = new TEntry('field1');
        $field2 = new TEntry('field2');
        $field3 = new TEntry('field3');
        $field4 = new TEntry('field4');
        $field5 = new TEntry('field5');
        $field6 = new TEntry('field6');
        $field7 = new TEntry('field7');
        
        $this->form->addFields([new TLabel('field 1')],[$field1]);
        $this->form->addFields([new TLabel('field 2')],[$field2]);
        $this->form->addFields([new TLabel('field 3')],[$field3]);
        $this->form->addFields([new TLabel('field 4')],[$field4]);
        $this->form->addFields([new TLabel('field 5')],[$field5]);
        $this->form->addFields([new TLabel('field 6')],[$field6]);
        $this->form->addFields([new TLabel('field 7')],[$field7]);
        
        $field1->addValidation('Field 1', new TMinLengthValidator, [3]); // Valor mínimo
        $field1->addValidation('Field 1', new TRequiredValidator); // Not null
        $field2->addValidation('Field 2', new TMaxLengthValidator,[20]); // Valor máximo
        $field3->addValidation('Field 3', new TMinValueValidator, [1]); // Valor mínimo número
        $field4->addValidation('Field 4', new TMaxValueValidator, [10]);
        $field5->addValidation('Field 5', new TRequiredValidator);
        $field6->addValidation('Field 6', new TRequiredValidator);
        $field6->addValidation('Field 6', new TEmailValidator);
        $field7->addValidation('Field 7', new TNumericValidator);
        
        $this->form->addAction('Enviar', new TAction([$this,'onSend']),'fa:save');
        
        parent::add($this->form);
        
        
    }
    
    public function onSend($param)
    {
        $data =  $this->form->getData();
        $this->form->setData($data);
    }
}


