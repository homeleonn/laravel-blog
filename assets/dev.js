function isRoot() {
	return document.location.pathname == '/';
}

function cl(){
	let stack = new Error().stack.split(/\n/);
	console.log(stack[1] + ' ' + stack[2]);
	console.log.apply(console, arguments);return;
}

function fnOnTimeout(callback, delay = 1000){
    let timeout = false;

    return function() {
        if (!timeout) {
            timeout = true;
            setTimeout(() => {
                callback($(window).scrollTop());
                timeout = false;
            }, delay);
        }
    }
}

// (() => {
// 	$(() => {
// 		let $el = $('ul.top-menu')
// 		let menu = {
// 			$el		: $el,
// 			height	: $el.height(),
// 			offset	: $el.offset().top + $el.height(),
// 			fixed	: false
// 		};

// 		let fn = fnOnTimeout((scrollTop) => {
// 	        if (!menu.fixed && scrollTop > menu.offset) {
// 	        	menu.$el.addClass('fixed');
// 	        	menu.fixed = true;
// 	        } else if(menu.fixed && scrollTop <= menu.offset) {
// 	        	menu.$el.removeClass('fixed');
// 	        	menu.fixed = false;
// 	        }
// 	    }, 300);

// 		$('#nav-top').css('height', menu.height);
// 		$(window).scroll(function() {
// 	        fn();
// 	    });
// 	});
// })();
let mobile = false;
$(() => {

	// var mapOptions = {
 //        center: new google.maps.LatLng(46.5107031, 30.7186613),
 //        mapTypeId: google.maps.MapTypeId.ROADMAP,
 //        zoom: 11
 //      };     
	// var map = new google.maps.Map(document.getElementById("map"), mapOptions);

	if ($(window).width() < 575) {
		mobile = true;
		$('body').addClass('mobile');
	}

	setTimeout(() => $(window).trigger('scroll'), 200);
	$('.top-menu ul').parent().addClass('has-sub').append('<span class="sub">');
	// $('.top-menu ul').parent().addClass('sub');
	$('.top-menu').on('click', '.sub', function() {
		$(this).parent().toggleClass('active');
	});

	$('.burger').on('click', function() {
		$(this).toggleClass('toggle');
		$('nav#nav-top').toggleClass('move-hide');
	});

	let useMenu = false;
	$('nav#nav-top, .burger-wrapper').click(function() {
		useMenu = true;
	});

	let fn_useMenu = fnOnTimeout(() => {
		if (!useMenu) {
			$('.burger').removeClass('toggle');
			$('nav#nav-top').addClass('move-hide');
		}

		useMenu = false;
	}, 50);
	$('body').click(function(e) {
		fn_useMenu();

	});

	



	// cencel drag-click effect
	(() => {
		let drag = false;
		let down = false;

		$('.dragscroll > .carousel')
			.mousedown(() => {
				down = true;
			})
			.mousemove(() => {
				if (!drag && down) drag = true;
			})
			.mouseup((e) => {
				down = false;

				if (drag) {
					setTimeout(() => {drag = false}, 1);
				}

				addScrolled();
			})
			.click((e) => {
				if (drag) {
					return false;
				}
			});
	})()

	$('.dragscroll > span').click(function() {
		let scrollLeft = $('.dragscroll > .carousel').scrollLeft() + ($(this).hasClass('right') ? 500 : -500);

		$('.dragscroll > .carousel').animate({scrollLeft: scrollLeft}, addScrolled);
	})

	setTimeout(() => {
		$('.dragscroll > .eclipse-left, .dragscroll > .eclipse-right').css('height', $('.dragscroll > .carousel').height());
	}, 200);

	
});

function addScrolled() {
	let scrollLeft = $('.dragscroll > .carousel').scrollLeft();
	$('.dragscroll')[(scrollLeft > 0 ? 'add' : 'remove') + 'Class']('in-progress');
	if (scrollLeft + $('.dragscroll > .carousel').width() >= $('.dragscroll > .carousel')[0].scrollWidth) {
		$('.dragscroll').addClass('scrolled');
	} else {
		$('.dragscroll').removeClass('scrolled');
	}
}



! function(e, n) {
    "function" == typeof define && define.amd ? define(["exports"], n) : n("undefined" != typeof exports ? exports : e.dragscroll = {})
}(this, function(e) {
    var n, t, o = window,
        l = document,
        c = "mousemove",
        r = "mouseup",
        i = "mousedown",
        m = "EventListener",
        d = "add" + m,
        s = "remove" + m,
        f = [],
        u = function(e, m) {
            for (e = 0; e < f.length;) m = f[e++], m = m.container || m, m[s](i, m.md, 0), o[s](r, m.mu, 0), o[s](c, m.mm, 0);
            for (f = [].slice.call(l.getElementsByClassName("_dragscroll")), e = 0; e < f.length;) ! function(e, m, s, f, u, a) {
                (a = e.container || e)[d](i, a.md = function(n) {
                    e.hasAttribute("nochilddrag") && l.elementFromPoint(n.pageX, n.pageY) != a || (f = 1, m = n.clientX, s = n.clientY, n.preventDefault())
                }, 0), o[d](r, a.mu = function() {
                    f = 0
                }, 0), o[d](c, a.mm = function(o) {
                    f && ((u = e.scroller || e).scrollLeft -= n = -m + (m = o.clientX), u.scrollTop -= t = -s + (s = o.clientY), e == l.body && ((u = l.documentElement).scrollLeft -= n, u.scrollTop -= t))
                }, 0)
            }(f[e++])
        };
    "complete" == l.readyState ? u() : o[d]("load", u, 0), e.reset = u
});


(() => {
	function Shower(cl)
	{
		if(typeof window.showerPluginLoad != "undefined") return false;
		window.showerPluginLoad = true;
		
		$('body').one('click', 'a' + cl, function(e){
			e.preventDefault();
			new Shower1(cl);
			$(this).click();
		});
		
		function Shower1(cl) {
			$('body').append('<div id="shower"><div id="shower-tools"><div id="shower-prev"></div><div id="shower-next"></div></div><span></span><div id="img"><img src="" alt="РџСЂРѕСЃРјРѕС‚СЂ РёР·РѕР±СЂР°Р¶РµРЅРёСЏ"><div id="counter">0 / 0</div><div id="shower-title"></div><div id="close">x</div></div></div>');
			var cl = cl || '.shower';
			
			var $imgs = $('a' + cl);
			var $wrapper = $('#shower');
			var $imgWrap = $('#shower > #img');
			var $img = $imgWrap.children('img');
			var $title = $imgWrap.children('#shower-title');
			var self = this;
			var isChrome = !!window.chrome && (!!window.chrome.webstore || !!window.chrome.runtime);
			
			this.index = 0;
			
			$imgWrap.children('#counter').html((this.index+1)+' / '+$imgs.length);
			
			this.get = function(src){
				var ww = $(window).width();
				var wh = $(window).height();
				
				var showImg = new Image();
				showImg.onload = function() {
					$img.attr({'src':src.href});

					if (!$wrapper.hasClass('block')) {
						$wrapper.addClass('block');
						$wrapper.animate({'opacity': 1}, 500);
					}
					
					var nw = showImg.naturalWidth;
					var nh = showImg.naturalHeight;
					
					$img.animate({'width': 'auto', 'height': 'auto','max-height': wh - 100}, 50, function() {
						$imgWrap.css('visibility','visible');
						$imgWrap.animate({
							'margin-left': ((-$imgWrap.width()/2-20)+'px'), 
							'margin-top': (($imgWrap.height() > wh ? 0 : 20)+'px')
						}, 50);
						
						$img.animate({'opacity': 1}, 300);
					});
				}

				showImg.src = src.href;
				$title.text(src.title);
				self.setCounter();
			}
			
			this.hide = function(){
				self.index = 0;

				$wrapper.animate({'opacity': 0}, 500, function(){
					$wrapper.removeClass('block');
					$imgWrap.css({'visibility':'hidden'});
					self.setCounter();
				})
			}
			
			this.getIndex = function(img1){
				var index = 0;

				$imgs.each(function(i, img){
					if($(img)[0] == $(img1)[0]){
						index = i;
						return false;
					}
				});
				
				return index;
			}
			
			this.setCounter = function(){
				$imgWrap.children('#counter').html((self.index+1)+' / '+$imgs.length);
			}
			
			$('#shower #close, #shower > span').click(function(){
				self.hide();
			});
			
			$('#shower-prev').click(function(){
				self.index--;
				if(self.index < 0){
					self.hide();
					return false;
				}else
					$img.animate({'opacity': 0}, 300, function(){self.get($imgs[self.index])});
					
				
				self.setCounter();
			});
			
			$('#shower-next, #shower img').click(function(){
				self.index++;
				if(self.index >= $imgs.length){
					self.index = 0;
					self.hide();
					return false;
				}else
					$img.animate({'opacity': 0}, 300, function(){self.get($imgs[self.index])});
			});
			
			$('body').on('click', 'a' + cl, function(e){
				e.preventDefault();
				self.index = self.getIndex(this);
				self.get(this);
			});
		}
	}

	$(() => {
		Shower('.shower');
	})
})();
// lazyloading
;(function($){
    var lazyImgs = [];
    let woow = [];
    var prevScrollTop = 0;
    var step = 90;
    var wh = $(window).height()
    var beforeImgStep = wh + 300;
    var find = false;
    var ww = $(window).width();
    var fn = fnOnTimeout((scrollTop) => {

        if(!scrollTop || (scrollTop > prevScrollTop + step) || (scrollTop < prevScrollTop - step))
        {
            prevScrollTop = scrollTop;

            handleLazy();
            handleWoow();

            if (find) {
                find = false;
                setTimeout(() => {
                    recounting(lazyImgs);
                    recounting(woow);
                }, 200);
            }
        }
    }, 500);

    function handleLazy() {
        lazyImgs.forEach((item, i) => {
            if ((item.offset + 300 > prevScrollTop) && (item.offset - beforeImgStep < prevScrollTop)) {
                find = true;
                delete(lazyImgs[i]);
                handleImage(item);
            }
        });
    }

    function recounting(items){
        items.forEach((item, i) => {
            items[i].offset = getOffset(item.$el);
        });
    }

    function handleImage(item) {
        if (item.$el.hasClass('lazy-sprite-block')) {
            item.$el.addClass('sprited');
            return;
        }

        let tagname = item.$el.prop('tagName');

        if (['IFRAME'].includes(tagname)) {
            item.$el.attr('src', item.src);
            return;
        }
        
        if (['IMG'].includes(tagname)) {
            item.$el.attr('src', item.src);
        } else {
            item.$el.css('backgroundImage', `url(${item.src})`);
        }

        // let newImg = new Image();
        
        // newImg.onload = function() {
        //     if (['IMG'].includes(tagname)) {
        //         item.$el.attr('src', item.src);
        //     } else {
        //         item.$el.css('backgroundImage', `url(${item.src})`);
        //     }
        // }

        // newImg.src = item.src;
    }



    function handleWoow() {
        woow.forEach((item, i) => {
            if ((item.offset > prevScrollTop) && (item.offset < prevScrollTop + wh)) {
                find = true;
                delete(woow[i]);
                handleMoveBlock(item);
            }
        });
    }

    function isMoveBlock(item) {
        return $(item).hasClass('woow');
    }

    function handleMoveBlock(item) {
        setItemCss(item.$el, ['transitionDuration', 'transitionDelay']);

        item.$el.addClass('animated');
    }

    function setItemCss($item, cssRules) {
        function upperToHyphenLower(match) {
            return '-' + match.toLowerCase();
        }

        if (!Array.isArray(cssRules)) {
            cssRules = [cssRules];
        }

        cssRules.forEach(cssRule => {
            if ($item.data(cssRule)) {
                $item.css(cssRule.replace(/[A-Z]/g, upperToHyphenLower), $item.data(cssRule) + 's');
            }
        });
    }

    function getOffset(item) {
       $(item)[0].naturalHeight;
       return  $(item).offset().top - ($(item).hasClass('w-from-bottom') ? (wh * 0.3) : -($(item).hasClass('w-from-top') ? wh * 0.3 : 0));
    }


    $(function(){
        setTimeout(() => {
            $('.lazy').each(function(){
                lazyImgs.push({
                    $el: $(this),
                    src: ww < 576 && $(this).data('src-mobile') || $(this).data('src'),
                    offset: getOffset(this)
                });
            });

            // if (!mobile) {
                $('.woow').each(function(){
                    woow.push({
                        $el: $(this),
                        offset: getOffset(this)
                    });
                });
            // }
            
        }, 200);
        
        $(window).scroll(function(){
            fn();
        });
    });
})(jQuery);
function Slider(element){
	var list   = [];
	[].forEach.call($('.'+element+' .item'), function(l1){
		list.push(l1);
	});
	
	this.element = $('.'+element+' .ss');
	this.count = list.length;
	this.list = list;
	this.op = true;
	this.sliderTimer;
	this.sliderProgressBarTimer;
	var self = slider = this;
	let firstImgHandled = false;
	
	delete(list);

	this.run = function(timeout){
		let firstImg = $('.'+element+' .item.active img');
		if (!firstImgHandled && firstImg.data('src')) {
			firstImg.attr('src', firstImg.data('src'));
			firstImgHandled = true;
		}
		var timeout = timeout || 5000;
		this.sliderTimer = setTimeout(function(){
			// self.element.parent().find('.arr-right').click();
			self.next('left', $('.controls > .arr-right'));
			slider.stop();
			slider.run();
		}, timeout);
	}
	
	this.stop = function(){
		clearTimeout(this.sliderTimer);
		clearTimeout(this.sliderProgressBarTimer);
	}

	this.go = function(active, next, mode, type){
		$(next).addClass(mode);
		$(next)[0].offsetWidth;
		$(active).addClass(type);
		$(next).addClass(type);
		setTimeout(function(){
			$(active)
				.removeClass('active')
				.removeClass(type);
			$(next)
				.removeClass(type)
				.removeClass(mode)
				.addClass('active');
				
			slider.opTrue();
		}, 500);
	}
	
	
	this.next = function(type, self){
		//clearTimeout(frontSliderTimer);	
		this.parent(self);
		var active;
		if(!(active = this.oport())) return false;
		var type = type || 'left';
		var mode = type == 'left' ? 'next' : 'prev';
		var next = type == 'left' ? $(active).next() : $(active).prev();
		if(!next.length){
			next = $(this.element).find(' .item:' + (type == 'left' ? 'first' : 'last'));
		}
		var nextImg = next.find('img');
		var src = nextImg.attr('data-src');
		cl(1, nextImg);
		if(src){ 
			nextImg.removeAttr('data-src');
			nextImg.attr('src', src);
		}
		$(this.element).next().find('img').removeClass().eq(next.index()).addClass('active');
		this.go(active, next, mode, type);
	}
	
	this.identNext = function(elem){
		this.element = elem.closest('.thumbs').prev().children('.ss');
		if(elem.hasClass('active')) return;
		var active;
		if(!(active = this.oport())) return false;
		$(this.element).parent().next().find('img').removeClass();
		elem.addClass('active');
		var 
			mode = 'next',
			type = 'left';
			
		
		this.go(active, $(this.element).children('div').eq(elem.index()), mode, type);
	}
	
	this.parent = function(self){
		this.element = $(self).closest('.slider').eq(0);
	}
	
	this.active = function(){
		return $(this.element).find('.active');
	}
	
	this.opTrue = function(){
		this.op = true;
	}
	
	this.oport = function(){
		if(!this.op) return false;
		this.op = false;
		return this.active();
	}
		
	this.nextItem = function(){
		var current = this.count + 1;
		return this.list[current < this.count ? current : 1];
	}
	
	this.previous = function(){
		var current = this.count - 1;
		return this.list[current ? current : this.count];
	}
	
	this.getList = function(){
		return this.list;
	}
	
	this.getActive = function(){
		return $('.slider .ss').find('.item.active').next().css('display','block');
	}
	
	this.goProgress = function(width, $progressbar){
		// if(yout) return;
		var width = width || 0;
		if(!width) clearTimeout(sliderProgressBarTimer);
		sliderProgressBarTimer = setInterval(function(){
			if((width += 0.85) >= 100) {
				clearTimeout(sliderProgressBarTimer);
			}
			$progressbar.css('width', width + '%');
		}, 40);
	}
	
	$(function(){
		$('.thumbs img').click(function(){
			slider.identNext($(this));
		});
		
		$('.controls > .arr-left').click(function(){
			slider.next('right', $(this));
		});
		
		$('.controls > .arr-right').click(function(){
			slider.next('left', $(this));
		});
		
		$('.controls > .arr-right, .controls > .arr-left').click(function(){
			slider.stop();
			if($(window).width() < 480) return;
			var self = this;
			var width = 0;
			var $progressbar = $(self).closest('.slider-wrapper').find('.progressbar');
			$progressbar.css('width', width + '%');
			// yout = false;
			slider.run();
		});
		
		
		$('.slider-wrapper')
		.on('mouseover', '.item',
			function() {
				slider.stop();
			}.bind(this)
		).on('mouseout', '.item',
			function() {
				slider.stop();
				// if(yout) return;
				var currentWidth = $('.main .slider-wrapper').find('.progressbar').width() / $('.main .slider-wrapper').find('.ss').width() * 100;
				slider.run();
			}
		);
	});
}

let slider;
$(() => {
	if (isRoot() && $('.slider-wrapper')) {
		// let sliderImgs = {"3":{"img":"1.jpg","title":"lorem","text":"Lorem ipsum dolor sit amet consectetur adipisicing elit. Eveniet, consectetur facilis tempora, reprehenderit eligendi ab harum,"},"4":{"img":"2.jpg","title":"2","text":" asperiores id, magnam perspiciatis consequuntur sunt. Aut, praesentium ea provident molestias temporibus. Molestias, excepturi cum provident."}};
		// // setTimeout(function(){
			let active = true;
		// 	for (key in sliderImgs) {
		// 		render(sliderImgs[key]['img'], sliderImgs[key]['title'], sliderImgs[key]['text'], active);
		// 		active = false;
		// 	}
		// // }, 500);
		
		// function render(img, title, text, active = false){
		// 	let active1 = '', img1 = 'images/1x1.gif" data-src="images/slider/';
		// 	if (active) {
		// 		active1 = ' active';
		// 		img1 = 'images/slider/';
		// 	}
			
		// 	$('.slider > .ss').append('<div class="item'+(active1)+'"><img src="'+img1+img+'" />'+(title && text ? ('<div class="slider-title"><div>'+title+'</div><div>'+text+'</div></div>') : '')+'</div>');
			
		// }
		let stop = false;
		let fn = fnOnTimeout((scrollTop) => {
			let sliderOffset = $('.slider-wrapper').offset().top + $('.slider-wrapper').height();
			
			if (!stop && scrollTop > sliderOffset) {
				slider.stop();
				stop = true;
			} 

			if (stop && scrollTop <= sliderOffset) {
				slider.run();
				stop = false;
			}
		});

		$(window).scroll(function(){
            fn();
        });

		if ($(window).width() > 576) {
			slider = new Slider('slider');
			slider.run();
			$('.slider-wrapper').removeClass('none');
		}
	}
});