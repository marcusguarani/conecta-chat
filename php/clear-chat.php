<?php
    session_start();
    if(!isset($_SESSION['unique_id'])){
        header("location: ../login.php");
        exit;
    }
    include_once "config.php";

    $user_id = $_SESSION['unique_id'];
    $other_user_id = mysqli_real_escape_string($conn, $_POST['incoming_id']);

    if(empty($other_user_id)){
        echo "Contato inválido.";
        exit;
    }

    // Descobre a última mensagem já trocada entre os dois, até agora.
    $max_sql = mysqli_query($conn, "SELECT MAX(msg_id) AS max_id FROM messages
        WHERE (incoming_msg_id = {$other_user_id} AND outgoing_msg_id = {$user_id})
           OR (incoming_msg_id = {$user_id} AND outgoing_msg_id = {$other_user_id})");
    $max_row = mysqli_fetch_assoc($max_sql);
    $max_id = ($max_row && $max_row['max_id'] !== null) ? (int)$max_row['max_id'] : 0;

    // Guarda esse ponto de corte só para o usuário logado — nada é apagado de "messages".
    $sql = mysqli_query($conn, "INSERT INTO cleared_chats (user_id, other_user_id, cleared_up_to_msg_id)
        VALUES ({$user_id}, {$other_user_id}, {$max_id})
        ON DUPLICATE KEY UPDATE cleared_up_to_msg_id = {$max_id}");

    if($sql){
        echo "success";
    }else{
        echo "Não foi possível limpar a conversa. Tente novamente!";
    }
?>
