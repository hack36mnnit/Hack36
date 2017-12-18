
var days = '<div><span>%D</span><span>Days</span></div>';
var hours = '<div><span>%H</span><span>Hours</span></div>';
var minutes = '<div><span>%M</span><span>Minutes</span></div>';
var seconds = '<div><span>%S</span><span>Seconds</span></div>';

//var date = new Date(2017,2,3,9);

$('.countdown').countdown('2017/3/3 9:00:00',
		function(event) {
			var $this = $(this).html(event.strftime('' +
				days + hours + minutes + seconds));
});



























// $(function() {
//     $('.countdown span:first-child').countdown({
//         date: "July 30, 2017 15:03:26"
//     });
// });