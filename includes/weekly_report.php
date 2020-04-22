<?php
    require 'db_key.php';
    require('fpdf182/fpdf.php');
    session_start();
    $connString = connect_db();
    $connect = new PDO("mysql:host=localhost;dbname=habitracker", "root", "");
    
    class PDF extends FPDF
    {
        // Page header
        function Header()
        {
            $lastSunday = date('Y-m-d',strtotime('last sunday'));
            $dayafterlastSunday = date('Y-m-d',strtotime('last sunday -6 days'));
            $username = $_SESSION['username'];
            
            // Logo
            $this->Image('img\ReportBackground.png',0,0,210);
            $this->Image('img\logo.png',10,5,70);
            
        }
        
        // Page footer
        function Footer()
        {
            // Position at 2.0 cm from bottom
            $this->SetY(-20);
            // Times italic 10
            $this->SetFont('Times','I',10);
            // Page number
            $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
            
        }
    }
    
    $lastSunday = date('Y-m-d',strtotime('last sunday'));
    $dayafterlastSunday = date('Y-m-d',strtotime('last sunday -6 days'));
    
    $query = "SELECT * FROM login";
    
    $statement = $connect->prepare($query);
    
    $statement->execute();
    
    $result = $statement->fetchAll();
    
    foreach($result as $row) {
        $username = $row['username'];
        
        $pdf = new PDF();
        $pdf->AddPage();
        $pdf->AliasNbPages();
        
        $pdf->SetFont('Times','B',13);
        // Move to the right
        $pdf->Cell(80,38,'',0,1,'C');
        // Title
        $pdf->Cell(109,10,"Week: $dayafterlastSunday to $lastSunday",0,1,'L');
        $pdf->Cell(109,10,"User: $username",0,0,'L');
        // Line break
        $pdf->Ln(20);
        
        $pdf->SetFont('Times','B',12);
        $pdf->Cell(40,6,'Goal ID',1,0);
        $pdf->Cell(94,6,'Goal name',1,0);
        $pdf->Cell(55,6,"Streaks as of $lastSunday",1,1);
        //the first number add up to 189 = a line
        
    
        $query = "SELECT * FROM goals WHERE username = '$username' and goal_enddate >= '$dayafterlastSunday'";
        $statement = $connect->prepare($query);
        $statement->execute();
        $result_2 = $statement->fetchAll();
        
        foreach($result_2 as $row_2){
            $streak = $row_2['streak'];
            $goal_id = $row_2['goal_id'];
            mysqli_query($connString, "Update goals Set streak_lastSun = '$streak' Where goal_id = '$goal_id'");
            $pdf->Cell(40,10,$row_2['goal_id'],1,0);
            $pdf->Cell(94,10,$row_2['goal_name'],1,0);
            $pdf->Cell(55,10,$row_2['streak_lastSun'],1,1);
        }
        
        if ($row['receive_weeklyreport']==1) {
        //$pdf->output(); 
        $to = $row['email'];
        //$to = 'wongchika@ymail.com';
        
        //$file_name = 'testing_report' . '.pdf';
        $pdfoutputfile = 'C:\xampp\htdocs\habitracker\img\temp-file.pdf';
        $file = $pdf->Output($pdfoutputfile,'F');
        //$file = $pdf->Output();
        $attachment = chunk_split(base64_encode($file));
        
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
        
        //$mail->Subject = $subject;
        //$mail->Body = $message;
        $mail->AddAddress($to);
        
        $mail->AddEmbeddedImage('img/logo.png','logo');
        $mail->AddAttachment('C:\xampp\htdocs\habitracker\img\temp-file.pdf',$name = 'myattachment',$encoding = 'base64', $type ='application/pdf');
        //$mail->addStringAttachment($attachment, 'myattachment.pdf');
        
        $mail->Subject = 'Weekly Report';
        $mail->Body = 'Please find your weekly report in attach PDF file.';
        
        $mail->Send();
        unlink('C:\xampp\htdocs\habitracker\img\temp-file.pdf');
        }
    }
?>
