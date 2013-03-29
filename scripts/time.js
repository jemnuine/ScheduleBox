function fill(num) {
	var s = num+"";
    if(num < 10)
	{
		s =  "0" + num;
	}
    return s;
}

function clock() {
	var now = new Date();
	if(now.getHours()>12)
	{
		var outStr = fill((now.getHours() - 12))+':'+fill(now.getMinutes())+':'+fill(now.getSeconds())+' PM';
	}
	else
		var outStr = fill(now.getHours())+':'+fill(now.getMinutes())+':'+fill(now.getSeconds())+' AM';
	document.getElementById('current').innerHTML=outStr;
	setTimeout('clock()',1000);
}
clock();