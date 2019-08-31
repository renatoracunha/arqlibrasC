<!DOCTYPE html>
<html>
<head>
	<!-- Meta tags Obrigatórias -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <<!-- Bootstrap CSS -->
  <link rel="stylesheet" href="<?php echo base_url('css/bootstrap.css') ?>">
  <!-- JavaScript (Opcional) -->
  <!-- jQuery primeiro, depois Popper.js, depois Bootstrap JS -->
  <script src="<?php echo base_url('js/jquery.js') ?>"></script>
  <script src="<?php echo base_url('js/popper.js') ?>"></script>
  <script src="<?php echo base_url('js/bootstrap.js') ?>"></script>
  <script src="https://kit.fontawesome.com/8d24bc018e.js"></script>
  
  <title>Cadastro</title>
  <style type="text/css">

    #formulario{
      text-align: center;
    }


    body {
      background: #1c1c1c;
      color: #435160;
      font-family: "Open Sans", sans-serif;
    }

    h2 {
      color: #6D7781;
      font-family: "Sofia", cursive;
      font-size: 15px;
      font-weight: bold;
      font-size: 3.6em;
      text-align: center;
      margin-bottom: 20px;
    }

    a {
      color: #435160;
      text-decoration: none;
    }


    input[type="text"], input[type="date"],input[type="password"] {
      width: 70%;
      padding: 20px 0px;
      background: transparent;
      border: 0;
      border-bottom: 1px solid #435160;
      outline: none;
      color: #6D7781;
      font-size: 16px;
    }
    input[type=checkbox] {
      display: none;
    }

    label {
      display: block;
      position: absolute;
      margin-right: 10px;
      width: 8px;
      height: 8px;
      border-radius: 50%;
      background: transparent;
      content: "";
      transition: all 0.3s ease-in-out;
      cursor: pointer;
      border: 3px solid #435160;
    }



    input[type="submit"] {
      background: #578cff;
      border: 0;
      width: 50%;
      height: 40px;
      border-radius: 3px;
      color: #fff;
      font-size: 20px;
      cursor: pointer;
      transition: background 0.3s ease-in-out;
      margin-bottom: 10px;
    }
    input[type="submit"]:hover {
      background:#5c6b8a;
      animation-name: shake;
    }

    

    ::-webkit-input-placeholder {
      color: #435160;
      font-size: 18px;
    }

    .animated {
      animation-fill-mode: both;
      animation-duration: 1s;
    }

    @keyframes shake {
      0%, 100% {
        transform: translateX(0);
      }
      10%, 30%, 50%, 70%, 90% {
        transform: translateX(-10px);
      }
      20%, 40%, 60%, 80% {
        transform: translateX(10px);
      }
    }

    .container {

      width: 100%;
      margin: 0 auto;
      position: relative;
    }




  </style>
</head>
<body>
  <div class="container">

    <div id="formulario">
      <img src="../imagens/logo.png" alt="logo">
      <form method="post" action="<?php echo base_url('arqlibras/cadastrar_usuario') ?>">        
        <input class="form-control" name="nome" type="text" id="nome" placeholder="Nome" required><br>
        <input class="form-control" name="email" type="text" id="email" placeholder="E-mail" required><br>
        <input class="form-control" name="login" type="text" id="login" placeholder="login" required><br>
        <input class="form-control" name="cpf" type="text" id="cpf" placeholder="cpf" required><br>
        <input class="form-control" name="data_nascimento" type="date" id="data_nascimento" placeholder="data de nascimetno" required><br>
        <input class="form-control" name="telefone" type="text" id="telefone" placeholder="telefone" required><br>
        <input class="form-control" name="senha" type="password" id="senha" placeholder="Senha" required><br>
        <input class="form-control" name="confirmarsenha" type="password" id="confirmarsenha" placeholder="Confirmar Senha" required><br>
        <input class="btn btn-default" type="submit" name="cadastrar" value="cadastrar">

      </form>
      
    </div>
    
  </div>

</body>
</html>