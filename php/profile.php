<?php
  session_start();
  include_once "config.php";
  if(!isset($_SESSION['unique_id'])){
    header("location: ../login.php");
  }
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Perfil · ConectaChat</title>
  <link rel="icon" type="image/svg+xml" href="../assets/favicon.svg">
  <link rel="alternate icon" href="../assets/favicon.ico">
  <link rel="apple-touch-icon" href="../assets/apple-touch-icon.png">
  <link rel="stylesheet" href="../css/styles.css">
  <link rel="stylesheet" href="../css/styles2.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
</head>
<body class="profile-page">
  <section class="profile" id="profileSection">
    <a href="../users.php" class="profile-back" aria-label="Voltar para o chat">
      <i class="fas fa-arrow-left"></i>
    </a>
    <button type="button" class="profile-edit-toggle" id="editToggleBtn" title="Editar perfil" aria-label="Editar perfil">
      <i class="fas fa-pen"></i>
    </button>
    <header class="header">
      <div class="details">
        <?php
          $sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$_SESSION['unique_id']}");
          if(mysqli_num_rows($sql) > 0){
            $row = mysqli_fetch_assoc($sql);
          }
          $default_bio = "Olá, eu sou ". $row['fname']. " " . $row['lname'] .". Tenho paixão por programação e o design é o meu forte. Fique à vontade para entrar em contato. Obrigado!";
          $bio = (!empty($row['bio'])) ? $row['bio'] : $default_bio;
        ?>
        <div class="avatar-wrapper">
          <img src="images/<?php echo $row['img']; ?>" alt="" class="profile-pic" id="profilePicPreview">
          <label class="avatar-edit-btn" id="avatarEditBtn" title="Alterar foto">
            <i class="fas fa-camera"></i>
            <input type="file" name="image" id="profileImageInput" accept="image/x-png,image/gif,image/jpeg,image/jpg" hidden>
          </label>
        </div>

        <h1 class="heading" id="viewName"><span><?php echo $row['fname']. " " . $row['lname'] ?></span></h1>

        <div class="edit-name-form" id="editNameForm">
          <input type="text" id="editFname" placeholder="Nome" value="<?php echo htmlspecialchars($row['fname']); ?>">
          <input type="text" id="editLname" placeholder="Sobrenome" value="<?php echo htmlspecialchars($row['lname']); ?>">
        </div>

        <p class="profile-status"><i class="fas fa-circle"></i> <?php echo $row['status']; ?></p>
      </div>
    </header>
    <div class="profile-body">
      <div class="profile-field">
        <span class="label">E-mail</span>
        <span class="value"><?php echo $row['email']; ?></span>
      </div>
      <p class="profile-bio" id="profileBio"><?php echo nl2br(htmlspecialchars($bio)); ?></p>

      <textarea class="edit-bio-form" id="editBio" placeholder="Escreva algo sobre você..." maxlength="280"><?php echo htmlspecialchars($bio); ?></textarea>

      <div class="profile-error" id="profileError"></div>

      <div class="profile-edit-actions" id="editActions">
        <button type="button" class="btn-cancel" id="cancelEditBtn">Cancelar</button>
        <button type="button" class="btn-save" id="saveEditBtn">Salvar alterações</button>
      </div>
    </div>
  </section>

  <script src="../js/profile.js"></script>
</body>
</html>
