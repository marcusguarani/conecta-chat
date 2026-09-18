<?php
  $own_sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$_SESSION['unique_id']}");
  if(mysqli_num_rows($own_sql) > 0){
    $own_row = mysqli_fetch_assoc($own_sql);
  }
?>
<aside class="sidebar">
  <header>
    <div class="content">
      <a href="php/profile.php">
        <img src="php/images/<?php echo $own_row['img']; ?>" alt="">
      </a>
      <div class="details">
        <a href="php/profile.php">
          <span><?php echo $own_row['fname']. " " . $own_row['lname'] ?></span>
        </a>
        <p><?php echo $own_row['status']; ?></p>
      </div>
    </div>
    <a href="php/logout.php?logout_id=<?php echo $own_row['unique_id']; ?>" class="logout" title="Sair" aria-label="Sair">
      <i class="fas fa-sign-out-alt"></i>
    </a>
  </header>
  <div class="search">
    <span class="text">Selecione ou busque um contato</span>
    <input type="text" placeholder="Buscar por nome...">
    <button aria-label="Buscar"><i class="fas fa-search"></i></button>
  </div>
  <div class="users-list">

  </div>
</aside>
