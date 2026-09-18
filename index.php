<?php
  session_start();
  if(isset($_SESSION['unique_id'])){
    header("location: users.php");
  }
?>



<?php include_once "header.php"; ?>


<body class="auth-page">
  <div class="wrapper">
    <section class="form signup">
      <header>Criar conta</header>
      <form action="#" method="POST" enctype="multipart/form-data" autocomplete="off">
        <div class="error-text"></div>
        <div class="name-details">
          <div class="field input">
            <label>Nome</label>
            <input type="text" name="fname" placeholder="Seu nome" required>
          </div>
          <div class="field input">
            <label>Sobrenome</label>
            <input type="text" name="lname" placeholder="Seu sobrenome" required>
          </div>
        </div>
        <div class="field input">
          <label>E-mail</label>
          <input type="text" name="email" placeholder="Digite seu e-mail" required>
        </div>
        <div class="field input">
          <label>Senha</label>
          <input type="password" name="password" placeholder="Crie uma senha" required>
          <i class="fas fa-eye"></i>
        </div>
        <div class="field image">
          <label>Foto de perfil</label>
          <input type="file" name="image" accept="image/x-png,image/gif,image/jpeg,image/jpg" required>
        </div>
        <div class="field button">
          <input type="submit" name="submit" value="Criar conta e entrar no chat">
        </div>
      </form>
      <div class="link">Já tem uma conta? <a href="login.php">Entrar</a></div>
    </section>
  </div>

  <script src="js/password-eye-btn.js"></script>
  <script src="js/signup.js"></script>

</body>
</html>
