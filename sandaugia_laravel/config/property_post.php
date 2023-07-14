<?php
if(isset($_POST['post'])){
    //create db connection
    include 'database.php';

    $content = $_POST['content'];
    $image = $_FILES['image']['name'];
    $price = $_POST['price'];
    $end_date = $_POST['end_date'];
    $message = $_POST['message'];

    $target = "uppload/".basename($image);
    move_uploaded_file($_FILES['image']['name'], $target);

    $sql = "INSERT INTO Product (email, content, image, name, price, end_date, message)
    VALUES ('".$_SESSION['email']." ,$content', '$image', '$price', '$end_date', '$message')";

    $result = mysqli_query($con, $sql);
    if(mysqli_num_rows($result)==1){
        header('Đăng bán thành công !');
        exit();
    }else{
        echo 'Lỗi !';
    }

}
?>