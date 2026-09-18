<?php
    session_start();
    include_once "config.php";
    if(!isset($_SESSION['unique_id'])){
        header("location: ../login.php");
        exit;
    }

    $unique_id = $_SESSION['unique_id'];
    $fname = mysqli_real_escape_string($conn, trim($_POST['fname']));
    $lname = mysqli_real_escape_string($conn, trim($_POST['lname']));
    $bio = mysqli_real_escape_string($conn, trim($_POST['bio'] ?? ''));

    if(empty($fname) || empty($lname)){
        echo "Nome e sobrenome são obrigatórios!";
        exit;
    }

    // Busca a imagem atual antes de trocar, para poder apagá-la depois se for substituída.
    $current_sql = mysqli_query($conn, "SELECT img FROM users WHERE unique_id = {$unique_id}");
    $current_row = mysqli_fetch_assoc($current_sql);
    $old_img = $current_row ? $current_row['img'] : "";

    $img_update_sql = "";
    $new_img_name = "";
    if(isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK){
        $img_name = $_FILES['image']['name'];
        $img_type = $_FILES['image']['type'];
        $tmp_name = $_FILES['image']['tmp_name'];

        $img_explode = explode('.', $img_name);
        $img_ext = end($img_explode);

        $extensions = ["jpeg", "png", "jpg"];
        if(in_array($img_ext, $extensions) === true){
            $types = ["image/jpeg", "image/jpg", "image/png"];
            if(in_array($img_type, $types) === true){
                $time = time();
                $new_img_name = $time.$img_name;
                if(move_uploaded_file($tmp_name, "images/".$new_img_name)){
                    $img_update_sql = ", img = '{$new_img_name}'";
                }else{
                    echo "Não foi possível salvar a nova imagem. Tente novamente!";
                    exit;
                }
            }else{
                echo "Envie uma imagem nos formatos jpeg, png ou jpg";
                exit;
            }
        }else{
            echo "Envie uma imagem nos formatos jpeg, png ou jpg";
            exit;
        }
    }

    $sql = mysqli_query($conn, "UPDATE users SET fname = '{$fname}', lname = '{$lname}', bio = '{$bio}' {$img_update_sql} WHERE unique_id = {$unique_id}");
    if($sql){
        // Só apaga a imagem antiga depois que o banco confirmou a troca, e nunca a imagem que acabou de ser salva.
        if($new_img_name !== "" && $old_img !== "" && $old_img !== $new_img_name){
            $old_img_path = "images/".$old_img;
            if(is_file($old_img_path)){
                unlink($old_img_path);
            }
        }
        echo "success";
    }else{
        echo "Algo deu errado. Tente novamente!";
    }
?>
