<?php

require 'db_key.php';
session_start();

$query = "
SELECT * FROM users 

";
//for query above WHERE boolean of sending notification about weekly report is true

$statement = $connect->prepare($query);

$statement->execute();

$result = $statement->fetchAll();

foreach($result as $row)
{
    $to = $row['email'];
    $url = "localhost/habitracker/login.php";

    $subject = 'Your weekly progress report';
    $message = '<img src="cid:logo" width="200">';
    $message .= '<p>'.$row['username'].'Your weekly report is out! Check out your progress so far this week in Habitracker! </p>'; 
    $message .= '<a href="' . $url . '">' . $url . '</a></p></br>';

    $message .= 'Habit is a cable; we weave a thread each day, and at last we cannot break it. ―Horace Mann</br>';
    $message .= '<p>Keep up with your goals and track your habits today! </br>';   
    
    $message .= '<p>Want to set yourself a new challenge this week</br>?';
    $message .= '<p>Do not hesitate and create your new habit in Habitracker!</br>';
   
    $message .= '<p>Please send an email to noreply-habitracker@gmail.com if you have any queries.';

    require_once('PHPMailer-5.2-stable/PHPMailerAutoload.php');

    $mail = new PHPMailer();
    $mail->isSMTP();
    $mail->SMTPAuth = true; //tell phpmailer to authenticate with gmail
    $mail->SMTPSecure = 'ssl'; //to use gmail need to connect sll
    $mail->Host = 'smtp.gmail.com';
    $mail->Port = '465';
    $mail->isHTML();
    $mail->Username = 'noreply.habitracker@gmail.com';//your own email address
    $mail->Password = 'csci3100';
    $mail->Subject = $subject;;
    $mail->Body = $message;
    $mail->AddAddress($to);
    $mail->AddEmbeddedImage('logo.png','logo');

    $mail->Send();

    }