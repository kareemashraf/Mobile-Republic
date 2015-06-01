// EXECUTE PLUGIN ON DOM READY - START    
$(function () {
	$('#Button').formValidator({
		scope   : '#InputForm',
		errorDiv  : '#errorDiv1',
		errorTarget : 'div ul li'
	});
});    // EXECUTE PLUGIN ON DOM READY - END

//counter
jQuery(document).ready(function($) {
    $(function(){
        // Initialize counter
        var myCounter = new flipCounter('flip-counter', {value:Math.floor(Math.random() * (2000 - 1000) + 1000), inc:13, pace:7000, auto:true});
    });
});