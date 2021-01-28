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
                        color: white;
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
                        color: white;
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

    session_start();

    if (isset($_SESSION['loginSuccess']) && $_SESSION['loginSuccess']) {
		printf(success("Anmledung erfolgreich und sie wurden zur Einstiegsseite weitergeleitet"));
		
		unset($_SESSION['loginSuccess']);
	} else {
		printf(error("Das geht nicht! Sie müssen sich zuerst anmelden"));
	}
?>