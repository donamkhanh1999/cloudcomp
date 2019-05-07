
<?php
  $db = parse_url(getenv("DATABASE_URL"));
  $pdo = new PDO("pgsql:" . sprintf(
      "host=%s;port=%s;user=%s;password=%s;dbname=%s",
      $db["host"],
      $db["port"],
      $db["user"],
      $db["pass"],
      ltrim($db["path"], "/")
  ));

  $sql = "SELECT username, user_password FROM users";
  $stmt = $pdo->prepare($sql);
  //Thiết lập kiểu dữ liệu trả về
  $stmt->setFetchMode(PDO::FETCH_ASSOC);
  $stmt->execute();
  $resultSet = $stmt->fetchAll();

  if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    echo $username;
    echo $password;

    foreach ($resultSet as $row) {
      if ($username == $row['username'] && $password ==  $row['user_password']){
        echo 'yessss';
      }else{
        echo '
          <script>
            alert("WRONG! Wanna try again?");
          </script>
        ';
      }
    }

  }

?>