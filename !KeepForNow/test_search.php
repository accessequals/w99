<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Search for tests</title>
<script type="text/javascript">
function TestSearch()
{
var txt = document.getElementById("searchBox").value;
var msg = document.getElementById("msg");
var res = document.getElementById("resultsList");

if (txt.length >= 3)
{
var xhr = new XMLHttpRequest();
xhr.open("GET", "http://accessequals.com/api/test_results.php?search=" + txt, false);
xhr.send();
var results = JSON.parse(xhr.responseText);
res.innerHTML = "";
msg.innerText = results.length + " results";

for (var j=0; j<results.length; j++)
{
var opt = document.createElement("option");
opt.text = results[j].blurb;
res.appendChild(opt);
} //for
} else {
msg.innerText = "No results";
} //if
} //testSearch
</script>
</head>
<body>
<h1>Search for tests</h1>
<div id="msg" aria-live="assertive"></div>
<form>
<p>
<label for="searchBox">Search:</label>
<input type="text" id="searchBox" onkeyup="javascript:TestSearch();" />
</p>

<p>
<select id="resultsList"></select>
</p>
</form>
</body>
</html>