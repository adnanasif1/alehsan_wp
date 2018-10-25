jQuery(document).ready(function($){
    // anchor delete conifm dialog
    $('a.zem-confirm').on('click', function () {
        return confirm('Are you sure to delete ?');
    });

    // Reload page after specific time code
	// var time = new Date().getTime();
	// $(document.body).bind("mousemove keypress", function(e) {
	//     time = new Date().getTime();

	// });

	// function refresh() {
	//     if(new Date().getTime() - time >= 30000) 
	//         window.location.reload(true);
	//     else 
	//         setTimeout(refresh, 5000);
	// }
	// setTimeout(refresh, 5000);
});
