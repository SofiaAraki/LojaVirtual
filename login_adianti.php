<?php
require_once 'adianti/init.php'; // Arquivo de inicialização do Adianti

class LoginForm extends TPage {
    private $form;
    
    public function __construct() {
        parent::__construct();
        
        $this->form = new TQuickForm('form_login');
        $this->form->setFormTitle('Login');
        
        $login = new TEntry('login');
        $password = new TPassword('password');
        
        $this->form->addQuickField('Login', $login);
        $this->form->addQuickField('Senha', $password);
        
        $this->form->addQuickAction('Login', new TAction([$this, 'onLogin']), 'fa:sign-in');
        
        $container = new TVBox;
        $container->style = 'width: 300px';
        $container->add($this->form);
        
        parent::add($container);
    }
    
    public function onLogin($param) {
        $data = $this->form->getData();
        
        // Implemente sua lógica de autenticação aqui
        // Por exemplo, verifique se o login e a senha são válidos
        
        if ($data->login == 'admin' && $data->password == 'admin') {
            TSession::setValue('logged', true); // Define uma variável de sessão para indicar que o usuário está logado
            TApplication::gotoPage('index.php'); // Redireciona para a página inicial após o login
        } else {
            new TMessage('error', 'Login inválido'); // Exibe uma mensagem de erro se o login falhar
        }
    }
}

$login = new LoginForm();
$login->show();
