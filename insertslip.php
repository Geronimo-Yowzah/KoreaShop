<?php 
    include "connect.php";
    session_start(); 

    $targetDir = "upload-system/";

    if (isset($_POST['submit'])) {
        if (!empty($_FILES["file"]["name"])) {
            $fileName = basename($_FILES["file"]["name"]);
            $targetFilePath = $targetDir . $fileName;
            $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
                
            // Allow certain file formats
            $allowTypes = array('JPG', 'PNG', 'JPEG');
            if (in_array($fileType, $allowTypes)) {
                if (move_uploaded_file($_FILES['file']['tmp_name'], $targetFilePath)) {
                    $insert = $pdo->prepare("INSERT INTO confirm_order VALUES ('',?, ?)");
                    $insert->bindParam(1, $_POST["order"]);
                    $insert->bindParam(2, $fileName);
                    $insert->execute();
                        if ($insert) {
                            $_SESSION['statusMsg'] = "The file <b>" . $fileName . "</b> has been uploaded successfully.";
                            header("location: confirm-payment.php");
                        } else {
                            $_SESSION['statusMsg'] = "File upload failed, please try again.";
                            header("location: confirm-payment.php");
                        }
                } else {
                    $_SESSION['statusMsg'] = "Sorry, there was an error uploading your file.";
                    header("location: confirm-payment.php");
                }
            } else {
                $_SESSION['statusMsg'] = "Sorry, only JPG, JPEG, PNG are allowed to upload.";
                header("location: confirm-payment.php");
            }
        } else {
            $_SESSION['statusMsg'] = "Please select a file to upload.";
            header("location: confirm-payment.php");
        }
    }
?>

