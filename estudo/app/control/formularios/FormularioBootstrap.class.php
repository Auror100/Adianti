<?php
class FormularioBootstrap extends TPage
{
     public function __construct()
     {
         parent::__construct();
         
         $this->form = new BootstrapFormBuilder; // Chama a funcionalidade do bootstrapbuilder que faz forms dinâmicos e responsivos
         $this->form->setFormTitle('Formulário Bootstrap'); // Adiciona título
         
         $id = new TEntry('id');
         $descricao =  new TEntry('descricao');
         $senha = new TPassword('senha'); // Camuflador de campo senha
         $dt_criacao = new TDateTime('dt_criacao'); // Data e hora
         $dt_expiracao  = new TDate('dt_expiracao'); // Apenas data
         $valor =  new TEntry('valor');
         $cor = new TColor('cor'); // Escolher cor por meio de quadro gráfico
         $peso = new TSpinner('peso');// Label com setas para aumentar e dimuir valores do campo
         $tipo =  new TCombo('tipo'); // Conjunto com mais de uma opção tipo um select
         $texto = new TText('texto'); // Caixa de texto
         
         $id->setEditable(FALSE); // Impossibilitando a edição de id
         $cor->setSize('100%');
         $dt_criacao->setMask('dd/mm/yyyy hh:ii'); // Aprensentando os dados de data na maneira brasileira para o usuário
         $dt_criacao->setDatabaseMask('yyyy-mm-dd hh:ii'); // Dizendo a maneira como os dados de data entrarão no banco
         
         $dt_expiracao->setMask('dd/mm/yyyy'); // 
         $dt_expiracao->setDatabaseMask('yyyy-md-dd');
         
         $valor->setNumericMask(2,',','.',true); // Máscara numérica e true habilita para o banco armazenar a data do próprio jeito
         
         $valor->setSize('100%');
         $dt_criacao->setSize('100%');
         $dt_expiracao->setSize('100%');
         
         $tipo->addItems(['a' => 'Opcção A', 'b' => 'Opção B','c' =>'Opção c']); // Adicionando as opções no TCombo tipo
         
         $dt_criacao->setValue(date('Y-m-d H:i')); // Mostrando como as datas devem entrar no banco
         $dt_expiracao->setValue(date('Y-m-d'));
         $valor->setValue(123.45);
         $peso->setValue(30);
         $peso->setRange(1,100,0.1); // Valor mínimo, valor máximo e quantidade de aumento por clique na seta
         
         $descricao->placeholder = 'Digite aqui a descrição ';
         $descricao->setTip('Digite aqui a descrição'); // Helper que aparece ao passar o mouse sobre o campo
         
         $this->form->appendPage('Aba 1'); // Criação da primeira aba
         
         $this->form->addFields([new TLabel('ID')],[$id]);
         $this->form->addFields([new TLabel('Descrição')],[$descricao]);
         $this->form->addFields([new TLabel('Senha')],[$senha]);
         $this->form->addFields([new TLabel('Dt. Criação')],[$dt_criacao],[new TLabel('Dt. Expiracao')],[$dt_expiracao]); // Ao adicionar juntos ficam na mesma linha
         $this->form->addFields([new TLabel('Valor')],[$valor],[new TLabel('Cor')],[$cor]);
         $this->form->addFields([new TLabel('Peso')],[$peso],[new TLabel('Tipo')],[$tipo]);
         
         $this->form->appendPage('Aba 2'); // Criação da segunda aba
         
         $label = new TLabel('Divisória', '#697BF',12,'bi'); //12 tamanho da fonte
         
         $label->style = 'text-align:left;border-bottom: 1px solid gray; width: 100%'; // Criação de borda
         
         $this->form->addContent([$label]);
         
         $this->form->addFields([new TLabel('Texto')],[$texto]);
         
         $this->form->addAction('Enviar', new TAction([$this,'onSend']),'fa:save');
         
         parent::add($this->form);

         
     }
     
     public function onSend($param)
     {
         $data = $this->form->getData();
         $this->form->setData($data);
         
         new TMessage('info', json_encode($data));
     }
     
     
}