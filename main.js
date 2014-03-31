// wow
function muchrandom(arr) { return arr[Math.floor(Math.random() * arr.length)]; }
var doge = $('body').css('font-family', 'Comic Sans MS, Comic Sans, Chalkboard, Helvetica, Arial, sans-serif');
var dogefix = ['wow', 'such', 'very', 'much', 'so'];
var suchcolors = [
	"#0066FF", "#FF3399", "#33CC33", "#FFFF99", "#FFFF75", "#8533FF", 
	"#33D6FF", "#FF5CFF", "#19D1A3", "#FF4719", "#197519", "#6699FF", "#4747D1",
	"#D1D1E0", "#FF5050", "#FFFFF0", "#CC99FF", "#66E0C2", "#FF4DFF", "#00CCFF",
];

// such json
var suchjson  = $("#suchsecrets").text();
var veryparse = $.parseJSON(suchjson);

// very img
var veryimg  = veryparse.img;
var doge_img = "url(./img/doge/" + veryimg + ")";
var bg_img   = "url(./img/bg/" + veryimg + ")";
$('.doge-image').css('background-image', doge_img);
$('.bg').css('background-image', bg_img);

// much words
var muchwords = veryparse.type;
var day   = parseInt(veryparse.day);
var avg   = parseFloat(veryparse.avg);
$('#cycle-desc').text(muchrandom(dogefix) + ' ' + muchwords);
if      (day == -3) $('#cycle-day').text(muchrandom(dogefix));
else if (day == -2) $('#cycle-day').text('menstrual cycle tracker');
else if (day == -1) $('#cycle-day').text('no periods wow');
else if (day > 40)  $('#cycle-day').text(muchrandom(dogefix) + ' pain cycle day ' + day + ' much impress');
else                $('#cycle-day').text('cycle day ' + day);
if (avg > 0.0)      $('#cycle-avg').text('average cycle ' + avg + ' days');

$(".suchlikes").show();
$(".ourinfo").show();

// so text
if (veryimg == '01.png') {
	var sofirst   = "joy";
	var sosecond  = "relief";
	var sothird   = "lovely";
	var sofourth  = "flowers";
	var sofifth   = "period conqueror";
	var sosixth   = "festive";
	var soseventh = "wonderful";
} else if (veryimg == '02.png') {
	var sofirst   = "blood";
	var sosecond  = "waterfall";
	var sothird   = "yuck";
	var sofourth  = "dying";
	var sofifth   = "suffer";
	var sosixth   = "period";
	var soseventh = "flow";
} else if (veryimg == '03.png') {
	var sofirst   = "pretty";
	var sosecond  = "flowers";
	var sothird   = "flowing hair";
	var sofourth  = "okay";
	var sofifth   = "ovulation";
	var sosixth   = "estrogen";
	var soseventh = "femininity";
} else if (veryimg == '04.png') {
	var sofirst   = "horny";
	var sosecond  = "flowers";
	var sothird   = "bra";
	var sofourth  = "sex";
	var sofifth   = "hormones";
	var sosixth   = "libido";
	var soseventh = "fertility";
} else if (veryimg == '05.png') {
	var sofirst   = "PMS";
	var sosecond  = "cramps";
	var sothird   = "mood swings";
	var sofourth  = "unstable";
	var sofifth   = "feels";
	var sosixth   = "terrify";
	var soseventh = "emotions";
} else {
	if (day == -1) {  // no cycles
		var sofirst   = "concern";
		var sosecond  = "uh oh";
		var sothird   = "not okay";
		var sofourth  = "man";
		var sofifth   = "danger";
		var sosixth   = "ridiculous";
		var soseventh = "confuse";
	} else {  // not logged in
		var sofirst   = "doge";
		var sosecond  = "secure";
		var sothird   = "cycle";
		var sofourth  = "privacy";
		var sofifth   = "female reproductive system";
		var sosixth   = "blood";
		var soseventh = "periods";
	}
}
var tings = [sofirst, sosecond, sothird, sofourth, sofifth, sosixth, soseventh];

var very = doge.append('<div class="such overlay" />').children('.such.overlay').css({
	position: 'fixed',
	left: 0,
	right: 0,
	top: 0,
	bottom: 0,
	pointerEvents: 'none'
});

interval = setInterval(function() {
	
$('.such.overlay').append(
	'<span style="position: absolute; left: ' + Math.random()  *100 + '%;top: ' + Math.random()  *100 + '%;font-size: ' + Math.max(20, (Math.random() * 50 + 24)) + 'px; color:' + muchrandom(suchcolors) + ';">'
		+ muchrandom(dogefix) + ' ' + muchrandom(tings) + 
	'</span>');
	var suchnumber = $("span").length;
	if (suchnumber > 6)
		$('.such span:nth-child(1)').remove();
}, 2300);
