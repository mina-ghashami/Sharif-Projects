function loadscript(scriptURL)
{
	var newScript = document.createElement("script");
	newScript.src = scriptURL;
	document.body.appendChild(newScript);
}

function putContentInPage(str)
{
	document.getElementById('form').innerHTML = str;
}
function add(str)
{
	document.getElementById('form').innerHTML = str;
}

function show(){
	
	dg('form').style.display = 'block';	
}
function hide(){
		dg('form').style.display = 'none';
}
function dg(x){
	return document.getElementById(x);
}


