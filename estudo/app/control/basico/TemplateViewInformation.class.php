<?php
class TemplateViewInformation extends TPage
{
    public function __construct()
    {
        parent::__construct();
        
        new TMessage('info','Mensagem'); // Info, error, warning
        
    }
}
