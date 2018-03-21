<?
$servername = "localhost";
$username = "mentor_admin";
$password = "mentor_admin123";
$dbname = "mentor_program_db";

//使用PDO存取資料庫時，需要將資料庫依下列格式撰寫，讓程式讀取資料庫
$dbconnect = "mysql:host=$servername;dbname=$dbname;charset=utf8";

//用 PDO 方式改寫
try{
    //建立MySQL伺服器連接和開啟資料庫 
	$conn = new PDO($dbconnect, $username, $password);
    //指定PDO錯誤模式和錯誤處理
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	//echo "Connected Success";
}
catch(PDOException $e){
    //顯示錯誤訊息
	echo "Connected Failed: " . $e->getMessage();
}

/** 
    //原本使用MySQLi的方式連結資料庫
    $conn = new mysqli($servername, $username, $password, $dbname);
    mysqli_set_charset($conn, "utf8");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 
*/

//$username = "root";
//$password = "";
//$dbname = "mentor";
?>