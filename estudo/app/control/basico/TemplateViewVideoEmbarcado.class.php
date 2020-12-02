<?php
class TemplateViewVideoEmbarcado extends TPage
{
    public function __construct()
    {
        parent::__construct();
        
        $object =  new TElement('iframe'); // Embarca
        $object->width = '100%';
        $object->height = '600px';
        $object->src = 'https://www.youtube.com/embed/lpnbL3zOyE0';
        $object->frameborder = '0';
        $object->allow = 'accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture'; // Padrão para vídeos
        
        parent::add($object);
    }
}
