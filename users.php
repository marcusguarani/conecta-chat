<?php
  session_start();
  include_once "php/config.php";
  if(!isset($_SESSION['unique_id'])){
    header("location: login.php");
  }
?>


<?php include_once "header.php"; ?>
<body class="page-users">
  <div class="chat-app">
    <?php include_once "sidebar.php"; ?>
    <section class="main-panel empty-state">
      <div class="empty-state-content">
        <i class="fas fa-comments"></i>
        <h2>Nenhuma conversa selecionada</h2>
        <p>Escolha um contato na lista ao lado para começar a conversar.</p>
      </div>
    </section>
  </div>

  <script src="js/users.js"></script>

</body>
</html>
