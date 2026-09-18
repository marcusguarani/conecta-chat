<?php
    session_start();
    if(isset($_SESSION['unique_id'])){
        include_once "config.php";
        $outgoing_id = $_SESSION['unique_id'];
        $incoming_id = mysqli_real_escape_string($conn, $_POST['incoming_id']);
        $output = "";

        // Ponto a partir do qual o usuário logado "limpou" essa conversa (0 se nunca limpou).
        $cleared_sql = mysqli_query($conn, "SELECT cleared_up_to_msg_id FROM cleared_chats
            WHERE user_id = {$outgoing_id} AND other_user_id = {$incoming_id}");
        $cleared_row = mysqli_fetch_assoc($cleared_sql);
        $cleared_up_to = $cleared_row ? (int)$cleared_row['cleared_up_to_msg_id'] : 0;

        $sql = "SELECT * FROM messages LEFT JOIN users ON users.unique_id = messages.outgoing_msg_id
                WHERE ((outgoing_msg_id = {$outgoing_id} AND incoming_msg_id = {$incoming_id})
                OR (outgoing_msg_id = {$incoming_id} AND incoming_msg_id = {$outgoing_id}))
                AND msg_id > {$cleared_up_to} ORDER BY msg_id";
        $query = mysqli_query($conn, $sql);
        if(mysqli_num_rows($query) > 0){
            while($row = mysqli_fetch_assoc($query)){
                if($row['outgoing_msg_id'] === $outgoing_id){
                    $output .= '<div class="chat outgoing">
                                <div class="details">
                                    <p>'. $row['msg'] .'</p>
                                </div>
                                </div>';
                }else{
                    $output .= '<div class="chat incoming">
                                <img src="php/images/'.$row['img'].'" alt="">
                                <div class="details">
                                    <p>'. $row['msg'] .'</p>
                                </div>
                                </div>';
                }
            }
        }else{
            $output .= '<div class="text">Nenhuma mensagem ainda. Diga olá! 👋</div>';
        }
        echo $output;
    }else{
        header("location: ../login.php");
    }

?>
