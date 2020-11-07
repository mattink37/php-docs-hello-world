<head>
  <link rel="shortcut icon" href="">
</head>

<form action="">
  <select name="students" onchange="showStudent(this.value)">
    <option value="">Select a student:</option>
    <option value="0">student 0</option>
    <option value="1">student 1</option>
    <option value="123">student 123</option>
  </select>
</form>
<br>
<div id="txtHint">Student grades will be listed here</div>

<script>
  function showStudent(str) {
    var xhttp;
    var response;
    if (str == "") {
      document.getElementById("txtHint").innerHTML = "";
      return;
    }
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
      response = JSON.parse(this.responseText);
      if (this.readyState == 4 && this.status == 200) {
        var i;
        for (i = 0; i < response.length; i++) {
          document.getElementById("txtHint").innerHTML += response[i].grade + "<br>";
        }
      }
    };
    xhttp.open("GET", "getStudent.php?q=" + str, true);
    xhttp.send();
    document.getElementById("txtHint").innerHTML = "";
  }
</script>

<!--[{"id":0,"grade":100},{"id":0,"grade":89},{"id":0,"grade":95},{"id":0,"grade":98},{"id":0,"grade":0}]-->