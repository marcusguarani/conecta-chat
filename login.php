<?php
  session_start();
  if(isset($_SESSION['unique_id'])){
    header("location: users.php");
  }
?>


<?php include_once "header.php"; ?>
<body class="auth-page">
  <div class="wrapper">
    <section class="form login">
      <header>Entrar</header>
      <form action="#" method="POST" enctype="multipart/form-data" autocomplete="off">
        <div class="error-text"></div>
        <div class="field input">
          <label>E-mail</label>
          <input type="text" name="email" placeholder="Digite seu e-mail" required>
        </div>
        <div class="field input">
          <label>Senha</label>
          <input type="password" name="password" placeholder="Digite sua senha" required>
          <i class="fas fa-eye"></i>
        </div>
        <div class="field button">
          <input type="submit" name="submit" value="Entrar no chat">
        </div>
      </form>
      <div class="link">Ainda não tem uma conta? <a href="index.php">Criar conta</a></div>
    </section>
  </div>


  <script src="js/password-eye-btn.js"></script>
  <script src="js/login.js"></script>

</body>
</html>
