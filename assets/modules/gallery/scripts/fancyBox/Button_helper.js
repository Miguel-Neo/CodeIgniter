/*
 *  Button helper. Disable animations, hide close button, change title type and content
 */

$('.fancybox-buttons').fancybox({
	openEffect  : 'none',
	closeEffect : 'none',

	prevEffect : 'none',
	nextEffect : 'none',

	closeBtn  : false,

	helpers : {
		title : {
			type : 'inside'
		},
		buttons	: {}
	},

	afterLoad : function() {
		this.title = 'Image ' + (this.index + 1) + ' of ' + this.group.length + (this.title ? ' - ' + this.title : '');
	}
});