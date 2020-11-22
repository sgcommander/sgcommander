/**
* @desc Session - MorhpTabs Class.
* @author Shaun Freeman <shaun@shaunfreeman.co.uk>
* @date Mon Oct 8 17:12:51 BST 2007
* @version 1.0 - Mon June 9 2008
*     - 1st release
* @version 1.1 - Mon Sep 22 2008
*     - New Options:
*         - added activateTabFunction
*         - added evalScripts
* @version 1.2 - Wed Oct 8 2008
*    - New Methods:
*         - added start
*         - added stop
*     - New Options:
*         - added slideShow
*         - added slideShowDelay
* @version 1.3 - Web Nov 19 2008
*    - bug fix:
*        - line 87 : issue with IE and NaN fix by Rob Verzera
* @version 1.4 - Fri Dec 12 2008
*    - bug fix:
*        - line 59 : issue with lists in panel fixed.
*/
var MorphTabs = new Class({
	Implements: [Options, Chain],
 
	version: '1.4',
 
	options: {
		width: '300px',
		height: '200px',
		/*changeTransition: {
			transition: 'linear',
			duration: 100
		},*/
		changeTransition:null,
		panelStartFx: 'fade',
		panelEndFx: 'appear',
		mouseOverClass: 'over',
		activateOnLoad: 'first',
  		activateTabFunction: $empty,
		evalScripts: false,
		useAjax: false,
		ajaxUrl: '',
		ajaxOptions: {},
		ajaxParams: '',
		ajaxLoadingText: '',
		slideShow: false,
		slideShowDelay: 3,
		central: true
	},
 
	initialize: function(element, options) {
		
		this.setOptions(options);
		this.el = $(element);
		this.elid = element;
		
		this.el.setStyles({
			'height': this.options.height,
			'width': this.options.width
		});
		 
		this.titles = $$('#' + this.elid + ' ul.morphtabs_title li');
		
		this.panelHeight = this.options.height;
		this.panelWidth = this.el.getSize().x+' px';
			
		//this.el.getSize().y
		/*this.panel = new Element('div', {
			'id': 'morphPanel',
			'class': 'morphtabs_panel',
			'styles': {
				'width': this.panelWidth + 'px',
				'height': this.panelHeight + 'px'
			}
		}).inject(this.el.getFirst(), 'after');*/
		this.panel = new Element('div', {
			'id': 'morphPanel',
			'class': 'morphtabs_panel',
			'styles': {
				'width': this.panelWidth,
				'height': this.panelHeight
			}
		});
		
		//Si es una pestaa central
		if(this.options.central)
			this.panel.inject($('contenido'));
		else
			this.panel.inject(this.el.getFirst(), 'after');
		
		this.panelWrapBorder = this.panel.getStyle('border-width').toInt() * 2;
		
		this.panelWrap = new Element('div', {
			'id': 'morphPanelWrap',
			'class': 'morphtabs_panelwrap',
			'styles': {
				'height': this.panelHeight,
				'width': this.panelWidth
			}
		}).wraps(this.panel);
		
		this.panelTop = this.panelWrap.getStyle('top').toInt();
		
		//if (this.panelTop == 'NaN') this.panelTop = 0;
		if (isNaN(this.panelTop)) this.panelTop = 0; // fix by Rob Verzera.
		
		this.panelWrap.setStyle('top', (Browser.Engine.trident5) ? (this.panelTop + 4) + 'px' : this.panelTop + 'px'); // fix for ie7.
		
		this.attach(this.titles);
		
		if(this.options.activateOnLoad != 'none') {
			this.firstRun = true;
			if(this.options.activateOnLoad == 'first') {
				this.activate(this.titles[0]);
			} else {
				this.activate(this.options.activateOnLoad);
			}
		}
		
		if (this.options.slideShow) this.start();
	},
 
	attach: function(elements) {
		
		$$(elements).each(function(element) {
			
			var enter = element.retrieve('tab:enter', this.elementEnter.bindWithEvent(this, element));
			
			var leave = element.retrieve('tab:leave', this.elementLeave.bindWithEvent(this, element));
			
			var mouseclick = element.retrieve('tab:click', this.elementClick.bindWithEvent(this, element));
			
			element.addEvents({
				mouseenter: enter,
				mouseleave: leave,
				click: mouseclick
			});
			
			var el = $(element.get('title'));
			element.store('panel:html', el.get('title'));
			element.store('panel:id', el.id);
			$(element.get('title')).setStyle('display','none');
			//var elementDispose = $(element.get('title')).dispose();
			
		}, this);
		
		return this;
	},
 
	detach: function(elements) {
		
		$$(elements).each(function(element){
			
			element.removeEvent('mouseenter', element.retrieve('tab:enter') || $empty);
			
			element.removeEvent('mouseleave', element.retrieve('tab:leave') || $empty);
			
			element.removeEvent('mouseclick', element.retrieve('tab:click') || $empty);
			
			element.eliminate('tab:enter').eliminate('tab:leave').eliminate('tab:click').eliminate('panel:html').eliminate('panel:id');
			
			var elementDispose = element.dispose();
		});
		
		return this;
	},
 
	activate: function(tab) {
		if($type(tab) == 'string') {
			myTab = $$('#' + this.elid + ' ul li').filter('[title=' + tab + ']')[0];
			tab = myTab;
		}
		
		if($type(tab) == 'element') {
			if(!this.firstRun && !this.options.useAjax){
				$(this.activeTitle.get('title')).setStyle('display','none');
			}
			var html = $(tab.get('title'));
			if(this.options.central)
				this.panel.id = tab.retrieve('panel:id');
			else
				this.panel.id = 'contenido'+tab.retrieve('panel:id');
			this.titles.removeClass('active');
			tab.addClass('active');
			this.activeTitle = tab;
			this.panel.setStyle('overflow', 'hidden');
			
			if ($type(this.options.changeTransition) == 'object' && !this.firstRun) {
				this.getPanelFx(this.options.panelStartFx).chain(function() {
					
					this.fill(this.panel, html);
					
					this.getPanelFx(this.options.panelEndFx).chain(function() {
						
						this.options.activateTabFunction(this.panel.id);
						this.panel.setStyle('overflow', 'auto');
						this.panel.scrollTo(0,0);
						
					}.bind(this));
				}.bind(this));
				
			} else if ($type(this.options.changeTransition) == 'object' && this.firstRun) {
				this.fill(this.panel, html);
				
				this.panel.store('flag', 'end');
				
				this.getPanelFx(this.options.panelEndFx).chain(function() {
					
					this.options.activateTabFunction(this.panel.id);
					this.panel.setStyle('overflow', 'auto');
					this.panel.scrollTo(0,0);
					
				}.bind(this));
			} else {
				//Si es la primera carga se desactiva el ajax
				if(this.firstRun && this.options.useAjax){
					this.options.useAjax=false;
					this.fill(this.panel, html);
					this.options.useAjax=true;
				}
				else
					this.fill(this.panel, html);
				
				this.firstRun = false;
				this.options.activateTabFunction(this.panel.id);
				//this.panel.setStyle('overflow', 'auto');
				this.panel.scrollTo(0,0);
			}
		}
		
	},
 
	elementEnter: function(event, element) {
		
		if(element != this.activeTitle) {
			element.addClass(this.options.mouseOverClass);
		}
	},
 
	elementLeave: function(event, element) {
		
		if(element != this.activeTitle) {
			element.removeClass(this.options.mouseOverClass);
		}
	},
 
	elementClick: function(event, element) {
		
		if(element != this.activeTitle) {
			element.removeClass(this.options.mouseOverClass);
			this.activate(element);
		}
		
		if (this.slideShow) {
			this.setOptions(this.slideShow, false);
			this.clearChain();
			this.stop();
			this.panel.store('fxEffect:flag', 'show');
		}
		
	},
 
	fill: function(element, contents) {
		if(this.options.useAjax) {
			this.getContent();
		} else {
			contents.setStyle('display','inline');
			element.adopt(contents);
			if (this.options.evalScripts) {
				element.get('html').stripScripts(true);
			}
		}
	},
 
	getContent: function() {
		var pestana=this.activeTitle.getProperty('title');
		//this.panel.set('html', this.options.ajaxLoadingText);
		var newOptions = {
			url: this.options.ajaxUrl + pestana,
			update: this.panel,
			evalScripts: true,
			onRequest: function(){
				//Mostramos la precarga
				$('preloader').setStyle('display','inline');
			},
			onComplete: function(html) {
				//Incluimos el archivo js de la pestana
				//con include_once para que se ejecute con ASSET
				include_once('/js/'+controlador+'/'+pestana.split('&')[0]+'.js','jspestana');	
			
				//Ocultamos el mensaje de precarga
				$('preloader').setStyle('display','none');
			},
			onFailure: function() {
				this.panel.set('text', 'Error al cargar.');
				
				//Ocultamos el mensaje de carga
				$('preloader').setStyle('display','none');
			}
		};
		this.options.ajaxOptions = $merge(this.options.ajaxOptions, newOptions);
		var tabRequest = new Request.HTML(this.options.ajaxOptions);
		
		if(this.options.ajaxParams=='')
			tabRequest.send();
		else
			tabRequest.post(this.options.ajaxUrl + pestana + '&' + this.options.ajaxParams);
	},
 
	addTab: function(title, label, content) {
		
		var newTitle = new Element('li', {
			'title': title
		});
		
		newTitle.appendText(label);
		
		this.titles.include(newTitle);
		
		$$('#' + this.elid + ' ul').adopt(newTitle);
		
		var newPanel = new Element('div', {
			'id': title,
			'class': 'mootabs_panel'
		});
		
		if(!this.options.useAjax) {
			newPanel.set('html',content);
		}
		
		this.el.adopt(newPanel);
		this.attach(newTitle);
	},
 
	removeTab: function(title){
		
		if(this.activeTitle.title == title) {
			this.activate(this.titles[0]);
		}
		
		var tab = $$('#' + this.elid + ' ul li').filter('[title=' + title + ']')[0];
		this.detach(tab);
	},
 
	start: function() {
		this.slideShow = this.next.periodical(this.options.slideShowDelay * 1000, this);
	},
 
	stop: function() {
		$clear(this.slideShow);
	},
 
	next: function() {
		var nextTab = this.activeTitle.getNext();
		
		if(!nextTab) {
			nextTab = this.titles[0];
		}
		
		this.activate(nextTab);
	},
 
	previous: function() {
		var previousTab = this.activeTitle.getPrevious();
		
		if(!previousTab) {
			previousTab = this.titles[this.titles.length - 1];
		}
		
		this.activate(previousTab);
	},
	
	getPanelFx: function(fx) {
		
		this.flag = (this.firstRun) ? this.panel.retrieve('fxEffect:flag', 'show') : this.panel.retrieve('fxEffect:flag');
		
		var styles = {
			'margin-top': [0, 0],
			'margin-left': [0, 0],
			'width': [this.panelWidth, this.panelWidth],
			'height': [this.panelHeight, this.panelHeight],
			'opacity': [1, 1]
		};
		
		fxEffect = this.panel.get('morph', this.options.changeTransition);
		
		switch(fx) {
			case 'blind:up':
					if (this.flag == 'hide') {
				
						styles = fxEffect.start($merge(styles, {
							'height': [this.panelHeight, 0]
						}));
					} else {
						
						styles = fxEffect.start($merge(styles, {
							'margin-top': [this.panelHeight, 0],
							'height': [0, this.panelHeight]
						}));
					}
					break;
			case 'blind:down':
					
					if (this.flag == 'hide') {
				
						styles = fxEffect.start($merge(styles, {
							'margin-top': [this.panelHeight],
							'height': [0]
						}));	
					} else {
						
						styles = fxEffect.start($merge(styles, {
							'height': [0, this.panelHeight]
						}));
					}
					break;
			case 'blind:left':
					if (this.flag == 'hide') {
				
						styles = fxEffect.start($merge(styles, {
							'width': [this.panelWidth, 0]
						}));
					} else {
						
						styles = fxEffect.start($merge(styles, {
							'margin-left': [this.panelWidth, 0],
							'width': [0, this.panelWidth]
						}));
					}
					break;
			case 'blind:right':
					if (this.flag == 'hide') {
				
						styles = fxEffect.start($merge(styles, {
							'margin-left': [this.panelWidth],
							'width': [0]
						}));
					} else {
						styles = fxEffect.start($merge(styles, {
							'width': [0, this.panelWidth]
						}));
					}
					break;
			case 'slide:up':
					if (this.flag == 'hide') {
					
						styles = fxEffect.start($merge(styles, {
							'margin-top': [0, -this.panelHeight],
							'width': [this.panelWidth],
							'height': [this.panelHeight]
						}));
					} else {
						
						styles = fxEffect.start($merge(styles, {
							'margin-top': [this.panelHeight, 0]
						}));
					}
					break;
			case 'slide:down':
					
					if (this.flag == 'hide') {
				
						styles = fxEffect.start($merge(styles, {
							'margin-top': [0, this.panelHeight],
							'width': [this.panelWidth],
							'height': [this.panelHeight]
						}));
					} else {
						
						styles = fxEffect.start($merge(styles, {
							'margin-top': [-this.panelHeight, 0]
						}));
					}
					break;
			case 'slide:left':
					if (this.flag == 'hide') {
				
						styles = fxEffect.start($merge(styles, {
							'margin-left': [0, -this.panelWidth],
							'width': [this.panelWidth],
							'height': [this.panelHeight]
						}));
					} else {
						
						styles = fxEffect.start($merge(styles, {
							'margin-left': [this.panelWidth, 0]
						}));
					}
					break;
			case 'slide:right':
					if (this.flag == 'hide') {
				
						styles = fxEffect.start($merge(styles, {
							'margin-left': [0, this.panelWidth],
							'width': [this.panelWidth],
							'height': [this.panelHeight]
						}));
					} else {
						
						styles = fxEffect.start($merge(styles, {
							'margin-left': [-this.panelWidth, 0]
						}));
					}
					break;
			case 'fade':
					if (this.flag == 'hide') {
				
						styles = fxEffect.start($merge(styles, {
							'opacity': [1, 0]
						}));
					}
					break;
			case 'appear':
					if (this.flag == 'show') {
						
						styles = fxEffect.start($merge(styles, {
							'opacity': [0, 1]
						}));
					}
					break;
		}
		
		this.panel.store('fxEffect:flag', (this.flag == 'hide') ? 'show' : 'hide');
		
		if (this.firstRun) this.firstRun = false;
		
		return styles;
	}
});
