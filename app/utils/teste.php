<?php 
    abstract class ValidacaoForm
    {
        protected $data;
        protected $erro;
        protected $msg;
        
        public function __construct($post)
        {
            $this->data = $post;
            $this->msg  = null;
            $this->erro = false;
        }
        public function nome($campo)
        {   
            $nome = trim($this->data[$campo]);
        
            if(empty($nome))
            {
                $this->msg[] = "Campo {$campo} está vazio";
                $this->erro = true;
                return;
            }
            if(strlen($nome) < 2)
            {
                $this->msg[] = "Preencha o {$campo} com no mínimo 2 letras.";
                $this->erro = true;
                return; 
            }
            if( strlen($nome) > 60)
            {
                $this->msg[] = "Preencha o {$campo} com no máximo 60 letras.";
                $this->erro = true;
                return; 
            }
        }

        public function email()
        {
            $email = trim($this->data['email']);
        
            if(empty($email))
            {
                $this->msg[] = "Campo email está vazio";
                $this->erro = true;
                return;
            }
            if(strlen($email) > 60)
            {
                $this->msg[] = "Preencha o e-mail no máximo 60 caracteres!";
                $this->erro = true;
                return;                
            }
            if (!filter_var($email, FILTER_VALIDATE_EMAIL))
            {
                $this->msg[] = "Campo senha está vazio";
                $this->erro = true;
                return;
            }
        }
        
        abstract public function validar();
        
        public function is_sucess()
        {
            return $this->erro;
        }
        
        public function getMsg()
        {
            return $this->msg;
        }

        public function senha($campo,$nomeLabel)
        {
            $senha = trim($this->data[$campo]);
    
            if(empty($senha))
            {
                $this->msg[] = "Campo {$nomeLabel} está vazio";
                $this->erro = true;
                return;
            }
            if(strlen($senha) != 8)
            {
                $this->msg[] = "Preencha a senha com 8 caracteres!";
                $this->erro = true;
                return; 
            }
        }
        
    }
    
    class ValidFormCadastroUsuario extends ValidacaoForm
    {

        public function validar()
        {
            $this->nome('nome');
            $this->nome('sobrenome');
            $this->email();
            $this->senha('senha','senha');
            $this->senha('confSenha','Confirmar senha');
            $this->confirmSenha('confSenha','Confirmar senha');
        }

        public function confirmSenha()
        {
            $senha     = trim($this->data['senha']);
            $confsenha = trim($this->data['confSenha']);

            if($confsenha != $senha)
            {
                $this->msg[] = "A confimação de senha e a senha devem ser iguais!";
                $this->erro = true;
                return;
            }
        }

    }   

    if(isset($_POST) && !empty($_POST))
    {
        $v = new ValidFormCadastroUsuario($_POST);
        $v->validar();

        if($v->is_sucess())
        {
            echo '<pre>';
            var_dump($v->getMsg());
            echo '</pre>';
        }
        else{
            echo "Tudo okay!";
        }
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="teste.php" method="POST">
        <label for="nome">Nome:</label>
        <input type="text" name="nome" id="" required><br>
        <label for="sobrenome">Sobrenome:</label>
        <input type="text" name="sobrenome" id="" required><br>
        <label for="email">E-mail:</label>
        <input type="email" name="email" id="" required><br>
        <label for="senha">Senha:</label>
        <input type="password" name="senha" id="" required><br>
        <label for="confSenha">Confirmar Senha:</label>
        <input type="password" name="confSenha" id="" required>
        <input type="submit" value="Enviar">
    </form>   
</body>
</html>