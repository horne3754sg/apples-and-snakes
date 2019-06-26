var menuToggle = document.querySelector('.menu-toggle');
var slideover = document.querySelector('.slideover');
var slideoverClose = document.querySelector('.slideover .close');
if (menuToggle && slideover) {
	menuToggle.addEventListener('click', function() {
		slideover.classList.add('animating');
		slideover.classList.add('open');
		setTimeout(function() {
			slideover.classList.remove('animating');
		}, 500);
	});
}

if (slideoverClose) {
	slideoverClose.addEventListener('click', function() {
		slideover.classList.remove('open');
		slideover.classList.add('animating');
		setTimeout(function() {
			slideover.classList.remove('animating');
		}, 500);
	});
}

function fluid_videos() {
	var iframes = document.getElementsByTagName('iframe');
	if (iframes) {
		for (var i = 0; i < iframes.length; i++) {
			var iframe = iframes[i],
				players = /www.youtube.com|player.vimeo.com/;
			if (iframe.src.search(players) > 0) {
				var videoRatio = (iframe.height / iframe.width) * 100;
				iframe.style.position = 'absolute';
				iframe.style.top = '0';
				iframe.style.left = '0';
				iframe.width = '100%';
				iframe.height = '100%';
				var wrap = document.createElement('div');
				wrap.className = 'fluid-vids';
				wrap.style.width = '100%';
				wrap.style.position = 'relative';
				wrap.style.paddingTop = videoRatio + '%';
				var iframeParent = iframe.parentNode;
				iframeParent.insertBefore(wrap, iframe);
				wrap.appendChild(iframe);
			}
		}
	}
}

var primaryMenu = document.querySelectorAll('#primary-menu li.menu-item-has-children > a');
if (primaryMenu) {
	primaryMenu.forEach(function(obj) {
		var toggleEl = document.createElement('div');
		toggleEl.innerHTML = '<?xml version="1.0" ?><!DOCTYPE svg  PUBLIC \'-//W3C//DTD SVG 1.1//EN\'  \'http://www.w3.org/Graphics/SVG/1.1/DTD/svg11.dtd\'><svg enable-background="new 0 0 50 50" height="50px" id="Layer_1" version="1.1" viewBox="0 0 50 50" width="50px" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><rect fill="none" height="50" width="50"/><polygon points="47.25,15 45.164,12.914 25,33.078 4.836,12.914 2.75,15 25,37.25 "/></svg>';
		toggleEl.classList.add('toggle');
		obj.insertAdjacentElement('beforeend', toggleEl);
		toggleEl.addEventListener('click', function(e) {
			e.preventDefault();
			this.classList.toggle('open');
			this.parentElement.nextElementSibling.classList.toggle('open');
		});
	});
}

/**
 * File navigation.js.
 *
 * Handles toggling the navigation menu for small screens and enables TAB key
 * navigation support for dropdown menus.
 */
(function() {
	var container, button, menu, links, i, len;
	
	container = document.getElementById('site-navigation');
	if (!container) {
		return;
	}
	
	button = container.getElementsByTagName('button')[0];
	if ('undefined' === typeof button) {
		return;
	}
	
	menu = container.getElementsByTagName('ul')[0];
	
	// Hide menu toggle button if menu is empty and return early.
	if ('undefined' === typeof menu) {
		button.style.display = 'none';
		return;
	}
	
	menu.setAttribute('aria-expanded', 'false');
	if (-1 === menu.className.indexOf('nav-menu')) {
		menu.className += ' nav-menu';
	}
	
	button.onclick = function() {
		if (-1 !== container.className.indexOf('toggled')) {
			container.className = container.className.replace(' toggled', '');
			button.setAttribute('aria-expanded', 'false');
			menu.setAttribute('aria-expanded', 'false');
		} else {
			container.className += ' toggled';
			button.setAttribute('aria-expanded', 'true');
			menu.setAttribute('aria-expanded', 'true');
		}
	};
	
	// Get all the link elements within the menu.
	links = menu.getElementsByTagName('a');
	
	// Each time a menu link is focused or blurred, toggle focus.
	for (i = 0, len = links.length; i < len; i++) {
		links[i].addEventListener('focus', toggleFocus, true);
		links[i].addEventListener('blur', toggleFocus, true);
	}
	
	/**
	 * Sets or removes .focus class on an element.
	 */
	function toggleFocus() {
		var self = this;
		
		// Move up through the ancestors of the current link until we hit .nav-menu.
		while(-1 === self.className.indexOf('nav-menu')) {
			
			// On li elements toggle the class .focus.
			if ('li' === self.tagName.toLowerCase()) {
				if (-1 !== self.className.indexOf('focus')) {
					self.className = self.className.replace(' focus', '');
				} else {
					self.className += ' focus';
				}
			}
			
			self = self.parentElement;
		}
	}
	
	/**
	 * Toggles `focus` class to allow submenu access on tablets.
	 */
	(function(container) {
		var touchStartFn, i,
			parentLink = container.querySelectorAll('.menu-item-has-children > a, .page_item_has_children > a');
		
		if ('ontouchstart' in window) {
			touchStartFn = function(e) {
				var menuItem = this.parentNode, i;
				
				if (!menuItem.classList.contains('focus')) {
					e.preventDefault();
					for (i = 0; i < menuItem.parentNode.children.length; ++i) {
						if (menuItem === menuItem.parentNode.children[i]) {
							continue;
						}
						menuItem.parentNode.children[i].classList.remove('focus');
					}
					menuItem.classList.add('focus');
				} else {
					menuItem.classList.remove('focus');
				}
			};
			
			for (i = 0; i < parentLink.length; ++i) {
				parentLink[i].addEventListener('touchstart', touchStartFn, false);
			}
		}
	}(container));
})();

if (typeof slick == 'function') {
	jQuery('#slider').slick({
		autoplay: true,
		arrows: false,
		dots: true,
		autoplaySpeed: 5000,
		speed: 1000
	});
}
