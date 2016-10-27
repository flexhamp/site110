/*Часы*/
function myclock(){
	ndata=new Date;
	hours=ndata.getHours();
	if (hours > 24) {
		hours = 0 + hours - 24
	}
	mins=ndata.getMinutes();
	secs=ndata.getSeconds();

	if (hours < 10) {hours="0" + hours};
	if (mins < 10) {mins="0" + mins};

	dataStr=hours+":"+mins;
	
	$('.clock>p').text(dataStr);
	setTimeout("myclock()", 1000);
}

window.onload = myclock;