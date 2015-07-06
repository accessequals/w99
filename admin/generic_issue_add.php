<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Add a generic issue</title>
<style type="text/css">
.hidden {
position: absolute !important;
height: 1px; width: 1px;
overflow: hidden;
clip: rect(1px 1px 1px 1px); /* IE6, IE7 */
clip: rect(1px, 1px, 1px, 1px);
}
</style>

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
<script src="//tinymce.cachefly.net/4.2/tinymce.min.js"></script>
<script>tinymce.init({
selector:'textarea',
fix_list_elements : true,

toolbar: [
"bold italic underline | styleselect formatselect removeformat fontselect fontsizeselect indent outdent code forecolor backcolor",
"cut copy paste pastetext  undo redo | bullist numlist link image anchor preview table | spellchecker"
]
});</script>
<script>tinymce.init({selector:'textarea'});</script>
</head>
<body onload="javascript:TestSearch();">
<h1>Add a generic issue</h1>
<form>
<p>
<label for="searchBox">Filter tests by keyword:</label>
<input type="text" id="searchBox" onkeyup="DelayFunction(TestSearch);" />
<span id="msg" aria-live="assertive" class="hidden"></span>
</p>

<p>
<label for="resultsList">Test</label>
<select name="test_id" id="resultsList"></select>
</p>

<p>
<label for="title">Short title</label>
<input type="text" name="title" id="title" />
</p>

<p>
<label for="generic">Generic issue (preferably no placeholders)</label>
<br />
<textarea name="generic" id="generic" rows="5" cols="80">[Insert generic issue]</textarea>
</p>

<p>
<label for="specific">Specifics</label>
<br />
<textarea name="specific" id="specific" rows="5" cols="80">[Insert specifics]</textarea>
</p>

<p>
<label for="impact">Impact on users</label>
<br />
<textarea name="impact" id="impact" rows="5" cols="80">[Insert impact]</textarea>
</p>

<p>
<label for="solution">Suggested solution</label>
<br />
<textarea name="solution" id="solution" rows="5" cols="80">[Insert solution]</textarea>
</p>

<p>
<input type="submit" value="Save this generic issue" />
</p>
</form>
</body>
</html>