// Contains methods needed prior to window.load
function localizeTime(t, print) {
	print = typeof print !== 'undefined' ? print : false;
	
	var m = moment.utc(t).local();
	var f = m.format('MMMM Do YYYY, h:mm a');
	if (print) {
		document.write(f);
	}
	return f;
}

function localizeTimeAgo(t, print) {
	print = typeof print !== 'undefined' ? print : false;
	var m = moment.utc(t).local();
	var f = m.fromNow();
	if (print) {
		document.write(f);
	}
	return f;
}