<?php
  session_start();
  include_once "php/config.php";
  if(!isset($_SESSION['unique_id'])){
    header("location: login.php");
  }
?>
<?php include_once "header.php"; ?>
<body class="page-chat">
  <div class="chat-app">
    <?php include_once "sidebar.php"; ?>
    <section class="main-panel chat-area">
      <header>
        <?php
          $user_id = mysqli_real_escape_string($conn, $_GET['user_id']);
          $sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$user_id}");
          if(mysqli_num_rows($sql) > 0){
            $row = mysqli_fetch_assoc($sql);
          }else{
            header("location: users.php");
          }
        ?>
        <a href="users.php" class="back-icon" aria-label="Voltar"><i class="fas fa-arrow-left"></i></a>
        <img src="php/images/<?php echo $row['img']; ?>" alt="">
        <div class="details">
          <span><?php echo $row['fname']. " " . $row['lname'] ?></span>
          <p><?php echo $row['status']; ?></p>
        </div>
        <button type="button" class="clear-chat-btn" id="clearChatBtn" title="Limpar conversa" aria-label="Limpar conversa">
          <i class="fas fa-trash-alt"></i>
        </button>
      </header>
      <div class="chat-box">

      </div>
      <form action="#" class="typing-area">
        <input type="text" class="incoming_id" name="incoming_id" value="<?php echo $user_id; ?>" hidden>
        <input type="text" name="message" class="input-field" placeholder="Escreva uma mensagem..." autocomplete="off">
        <button aria-label="Enviar"><i class="fab fa-telegram-plane"></i></button>
      </form>

      <div class="modal-overlay" id="clearChatModal">
        <div class="modal-box" role="alertdialog" aria-modal="true" aria-labelledby="clearChatTitle">
          <p id="clearChatTitle">Limpar esta conversa?</p>
          <p class="modal-subtext">As mensagens continuam salvas para <?php echo $row['fname']; ?>, mas somem da sua tela e não podem ser recuperadas depois.</p>
          <div class="modal-actions">
            <button type="button" class="modal-btn cancel" id="cancelClearBtn">Cancelar</button>
            <button type="button" class="modal-btn confirm" id="confirmClearBtn">Limpar</button>
          </div>
        </div>
      </div>
    </section>
  </div>

  <script src="js/chat.js"></script>

</body>
</html>
