/*
	Class:    	ScrollSidebar
	Author:   	David Walsh
	Website:    http://davidwalsh.name
	Version:  	1.0
	Date:     	07/03/2008
	Built For:  MooTools 1.2.0
	
	SAMPLE USAGE AT BOTTOM OF THIS FILE
	
*/

var ScrollSidebar = new Class({
	
	Implements: [Options],
	
	options: {
		offsets: { x:0, y:0 },
		mode: 'vertical',
		positionVertical: 'top',
		positionHorizontal: 'right',
		speed: 400
	},
	
	initialize: function(menu,options) {
		/* initial options */
		this.setOptions(options);
		this.menu = $(menu);
		this.move = this.options.mode == 'vertical' ? 'y' : 'x';
		this.property = this.move == 'y' ? 'positionVertical' : 'positionHorizontal';
		/* ensure a few things */
		var css = { position: 'absolute'};
		css[this.options.positionVertical] = this.options.offsets.y;
		css[this.options.positionHorizontal] = this.options.offsets.x;
		this.menu.setStyles(css).set('tween',{ duration: this.options.speed });
		/* start listening */
		this.startListeners();
	},
	
	startListeners: function() {
		var action = function() {
			this.setPosition($(document.body).getScroll()[this.move] + this.options.offsets[this.move]);
		}.bind(this);
		window.addEvent('scroll',action);
		window.addEvent('load',action);
	},
	
	setPosition: function(move) {
		this.menu.tween(this.options[this.property],move);
		return this;
	}
});

/*
window.addEvent('domready',function() {
	$('sidebar-menu').set('opacity',0.8); //opacity effect for fun
	var sidebar = new ScrollSidebar('sidebar-menu',{
		offsets: {
			x: 20,
			y: 20
		}
	});
});*/