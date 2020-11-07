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
    if (str == "") {
      document.getElementById("txtHint").innerHTML = "";
      return;
    }
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("txtHint").innerHTML = this.responseText;
      }
    };
    xhttp.open("GET", "getStudent.php?q=" + str, true);
    xhttp.send();
  }
</script>