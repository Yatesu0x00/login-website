<?php
    //Die folgenden beiden Funktionen gibt es eigentlich immer
    function error($str)
    {
        return "<!DOCTYPE html>
        <html lang=\"de\">
        <title>Datenbank</title>
				<head>
					<meta charset=\"utf-8\">
                    <style>       
                    body{
                        margin: 0;
                        padding: 0;
                        background: url(bgd.jpg);
                        background-size: unset;
                        background-position: unset;
                    }
                    #error {
                        color: red;
                        font-size:20pt;
                        font-family:arial
                    }
                    #back{
                        font-size: 13px;
                        background-color: #ecd552;
                        outline: none;
                        border: none;
                        font-family:arial
                        height: 50px;
                        width: 100px;
                        cursor: pointer;
                        border-radius: 20px;
                        background-color: #ecd552;
                        color: #ffffff;
                    }
                    </style>
                </head>                 
                <body>
                <form class = \"loginbox\">     
                    <div id=\"error\">$str.</div>
                    <p>
                        <input id=\"back\" type=\"button\" value=\"ZURÜCK\" onclick=\"window.location.href = 'index.html';\">
                    </p>
                </body>
        </html>";
    }
    
    function success($str)
    {
        return "<!DOCTYPE html>
        <html lang=\"de\">
        <title>Datenbank</title>
				<head>
					<meta charset=\"utf-8\">
                    <style>
                    body{
                        margin: 0;
                        padding: 0;
                        background: url(bgd.jpg);
                        background-size: unset;
                        background-position: unset;
                    }
                    #success {
                        color: blue;
                        font-size:20pt;
                        font-family:arial
                    }
                    #back{
                        font-size: 13px;
                        background-color: #ecd552;
                        outline: none;
                        border: none;
                        font-family:arial
                        height: 50px;
                        width: 100px;
                        cursor: pointer;
                        border-radius: 20px;
                        color: #ffffff;
                    }
                    </style>
                </head>                 
                <body>
                    <div id=\"success\">$str.</div>
                </body>
                <p>
                    <input id=\"back\" type=\"button\" value=\"ZURÜCK\" onclick=\"window.location.href = 'index.html';\">
                </p>
        </html>";
    }
       
    $db = mysqli_connect("localhost", "root", "", "goralewski");

    if (mysqli_connect_errno())
    {
        printf("Verbindung fehlgeschlagen: " . mysqli_connect_error());
        exit();
    }

    if ($_POST['usecase'] == "log")
    {
        $usr = mysqli_real_escape_string($db, $_POST['usr']);
        $query = "SELECT Password FROM user WHERE Username = '$usr'";

        if(!$res = mysqli_query($db, $query))
        {
            printf(error("Fehler: ".mysqli_error($db)));
            mysqli_close($db);
            exit();
        }

        if(!$row = mysqli_fetch_assoc($res)) 
        {
            printf(error("Der Benutzer ".$usr." ist nicht in der Datenbank vorhanden"));
            mysqli_close($db);
            exit();
        }
        else
        {
            if(password_verify($_POST['psw1'], $row['Password']))
            {                          
                echo(success("Willkommen " .$usr. ""));
            }
            else
            {
                echo(error("Das Passwort ist falsch"));
                mysqli_close($db);
                exit();
            }
        }               
        mysqli_free_result($res);
    }
    else if($_POST['usecase'] == "reg")
    {
        $usr = mysqli_real_escape_string($db, $_POST['usr']);
        $query = "SELECT Username FROM user WHERE Username = '$usr'";
              
        $pswhash = password_hash($_POST['psw1'], PASSWORD_DEFAULT);
        $psw = mysqli_real_escape_string($db, $pswhash);

        $res = mysqli_query($db, $query);
        if(!$row = mysqli_fetch_assoc($res))
        {
            $query = "INSERT INTO user (Username, Password) VALUES ('$usr', '$psw')";
            mysqli_query($db, $query);
            echo(success("Sie haben den Benutzer ".$usr. " erfolgreich angelegt"));
        }
        else
        {
            echo(error("Der Benutzer ".$usr. " ist schon in der Datenbank vorhanden"));
        }
        mysqli_close($db);
    }   
    if($_POST['usecase'] == "checkName")
    {
        $usr = mysqli_real_escape_string($db, $_POST['name']); 
          
        $query = "SELECT count(*) as countTest FROM user WHERE Username = '$usr'";

        $res = mysqli_query($db, $query);
        $row = mysqli_fetch_assoc($res);

        if($row['countTest'] >= 1)
        {
            echo("1");
            
        }
        else
        {
            echo("0");
        }

        
    }
?>