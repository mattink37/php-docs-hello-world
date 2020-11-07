<head>
  <link rel="shortcut icon" href="">
</head>

<button onclick="myFunction()">Toggle Mode</button>

<div id="GET">
<h1>Student Grade Retrieval</h1>
<?php
try {
    $conn = new PDO("sqlsrv:server = tcp:cloudcomputingclassdb.database.windows.net,1433; Database = CloudComputingClassDB", "mattink37", "a:U7wp_a");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $e) {
    print("Error connecting to SQL Server.");
    die(print_r($e));
}

// // SQL Server Extension Sample Code:
$connectionInfo = array("UID" => "mattink37", "pwd" => "a:U7wp_a", "Database" => "CloudComputingClassDB", "LoginTimeout" => 30, "Encrypt" => 1, "TrustServerCertificate" => 0);
$serverName = "tcp:cloudcomputingclassdb.database.windows.net,1433";
$conn = sqlsrv_connect($serverName, $connectionInfo);
$tsql= "SELECT DISTINCT id FROM Grades";
$getResults = sqlsrv_query($conn, $tsql);

$data = array();
while ($row = sqlsrv_fetch_array($getResults, SQLSRV_FETCH_ASSOC))
{
  $data[] = $row;
}

echo "<form action=\"\">
        <select name=\"students\" onchange=\"showStudent(this.value)\">
          <option value=\"\">Select a student:</option>";
          for ($i = 0; $i < count($data); $i++)
          {
            $studentID = implode(" ", $data[$i]);
            echo "<option value=" . $studentID . ">student " . $studentID . "</option>";
          }
echo "</select></form>";
?><div id="txtHint">Student grades will be listed here</div></div>

<div id="POST" style="display:none">
<h1>Student Grade Entry</h1>
<?php
try {
    $conn = new PDO("sqlsrv:server = tcp:cloudcomputingclassdb.database.windows.net,1433; Database = CloudComputingClassDB", "mattink37", "a:U7wp_a");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $e) {
    print("Error connecting to SQL Server.");
    die(print_r($e));
}

// // SQL Server Extension Sample Code:
$connectionInfo = array("UID" => "mattink37", "pwd" => "a:U7wp_a", "Database" => "CloudComputingClassDB", "LoginTimeout" => 30, "Encrypt" => 1, "TrustServerCertificate" => 0);
$serverName = "tcp:cloudcomputingclassdb.database.windows.net,1433";
$conn = sqlsrv_connect($serverName, $connectionInfo);
$tsql= "SELECT DISTINCT id FROM Grades";
$getResults = sqlsrv_query($conn, $tsql);

$data = array();
while ($row = sqlsrv_fetch_array($getResults, SQLSRV_FETCH_ASSOC))
{
  $data[] = $row;
}

echo "<form action=\"\">
        <select name=\"students\" onchange=\"showStudent(this.value)\">
          <option value=\"\">Select a student:</option>";
          for ($i = 0; $i < count($data); $i++)
          {
            $studentID = implode(" ", $data[$i]);
            echo "<option value=" . $studentID . ">student " . $studentID . "</option>";
          }
echo "</select></form>";
?></div>


<script>
function myFunction() {
  let get = document.getElementById("GET");
  let post = document.getElementById("POST");

  if (get.style.display === "none") {
    get.style.display = "block";
    post.style.display = "none";
  } else {
    post.style.display = "block";
    get.style.display = "none";
  }
}
</script>

<script>
  function showStudent(str) {
    var xhttp;
    var response;
    var deserializedResponse;
    var grades = 0;
    var grade;
    if (str == "") {
      document.getElementById("txtHint").innerHTML = "";
      return;
    }
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
      response = this.responseText;
      deserializedResponse = JSON.parse(response);
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("txtHint").innerHTML = "Grades:<br>"; 
        var i;
        for (i = 0; i < deserializedResponse.length; i++) {
          grade = deserializedResponse[i].grade;
          document.getElementById("txtHint").innerHTML += grade + "<br>";
          grades += grade;
        }
        document.getElementById("txtHint").innerHTML += "Average: " + grades / deserializedResponse.length;
      }
    };
    xhttp.open("GET", "getStudent.php?q=" + str, true);
    xhttp.send();
    document.getElementById("txtHint").innerHTML = "";
  }
</script>

<br><br><footer>Created by Matt Inkeles</footer>

<!--[{"id":0,"grade":100},{"id":0,"grade":89},{"id":0,"grade":95},{"id":0,"grade":98},{"id":0,"grade":0}]-->