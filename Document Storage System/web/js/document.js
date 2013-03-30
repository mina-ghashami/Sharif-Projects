function checkRange(val , min , max ){
	//
	//document.getElementById('mehran').innerHTML =;
	if (val < min ){
		x = confirm("salam");
		val = min ; 
	}
	else if (val > max)
		val = max; 
 	document.getElementById('1').value = val;
}