<?php
function success($str1, $str2){
	return "<!DOCTYPE html>
	<html>
	<title>Login Data</title>
		<body>
			<table>
				<tr>                    
					<td>                    
						username: ".$str1."                   
					</td>
				</tr>
				<tr>
					<td>
						password: ".$str2."                       
					</td>
				</tr>
			</table>        
		</body>
	</html>";
}

echo success($_POST['usr'], $_POST['psw1']);

function usecase($str1, $str2)
{
		
}
?>

<!DOCTYPE html>
<html>
	<script>
		function homeUrl() 
		{
    		location.href = 'http://localhost/WAN_IT31_Goralewski/home/';
		}
	</script>
		<body>
			<table>
				<tr>                    
					<td>                    
						<input type="button" value="Back" onclick="homeUrl()">                   
					</td>
				</tr>
		</body>
</html>