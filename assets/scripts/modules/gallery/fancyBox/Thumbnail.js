/*
 *  Thumbnail helper. Disable animations, hide close button, arrows and slide to next gallery item if clicked
 */

$('.fancybox-thumbs').fancybox({
	prevEffect : 'none',
	nextEffect : 'none',

	closeBtn  : false,
	arrows    : false,
	nextClick : true,

	helpers : {
		thumbs : {
			width  : 50,
			height : 50
		}
	}
});