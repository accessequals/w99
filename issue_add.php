<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Record an issue</title>
<style type="text/css">
.hidden {
position: absolute !important;
height: 1px; width: 1px;
overflow: hidden;
clip: rect(1px 1px 1px 1px); /* IE6, IE7 */
clip: rect(1px, 1px, 1px, 1px);
}
</style>

<script src="//tinymce.cachefly.net/4.2/tinymce.min.js"></script>

<script type="text/javascript">
var lastFilter = "abc";
var DelayFunction = DelayTimer();

function DelayTimer()
{
var timer;
return function(fun)
{
clearTimeout(timer);
timer = setTimeout(fun, 500);
};
}

function TestSearch()
{
var txt = document.getElementById("searchBox").value;
var msg = document.getElementById("msg");
var res = document.getElementById("resultsList");
var xhr = new XMLHttpRequest();

if (lastFilter == txt) //nothing has changed
{

} else {
if (txt.length >= 3)
{
xhr.open("GET", "http://accessequals.com/api/test_results.php?search=" + txt, false);
} else {
xhr.open("GET", "http://accessequals.com/api/test_results.php", false);
} //if

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

lastFilter = txt;
} //if

return true;
} //testSearch
</script>

<script type="text/javascript">
tinymce.init({
selector:'textarea'
});
</script>
</head>
<body onload="javascript:TestSearch();">
<h1>Record an issue</h1>
<form>
<p>
<label for="searchBox">Filter tests by keyword:</label>
<input type="text" id="searchBox" onkeyup="DelayFunction(TestSearch);" />
<span id="msg" aria-live="assertive" class="hidden"></span>
</p>

<p>
<label for="resultsList">Test to fail</label>
<select name="test_id" id="resultsList"></select>
</p>

<p>
<label for="page">Page or URL</label>
<input type="text" name="page" id="page" />
</p>

<p>
<label for="summary">Summary</label>
<input type="text" name="summary" id="summary" />
</p>

<p>
<label for="description">Description</label>
<br />
<textarea name="description" id="description" rows="5" cols="80"></textarea>
</p>

<p>
<label for="solution">Suggested solution</label>
<br />
<textarea name="solution" id="solution" rows="5" cols="80"></textarea>
</p>

<p>
<label for="screenshot">Screenshot</label>
<input type="file" name="screenshot" id="screenshot" />
</p>

<p>
<label for="codeSample">Code sample</label>
<br />
<textarea name="code_sample" id="codeSample" rows="5" cols="80"></textarea>
</p>

<p>
<input type="submit" value="Record issue" />
</p>
</form>
</body>
</html>