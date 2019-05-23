var EventAdmin = (function($) {
	
	var $c = {};
	
	var init = function() {
		$c.eventList = document.getElementById('event_list');
		$c.addNewEvent = document.getElementById('add_new_event');
		if ($c.addNewEvent && $c.eventList) {
			$c.addNewEvent.addEventListener('click', function(e) {
				e.preventDefault();
				addNew();
			});
			$c.addNewEvent.disabled = false;
		}
	};
	
	var addNew = function() {
		console.log('adding new');
		
		var i = $c.eventList.childElementCount;
		
		var frag = document.createDocumentFragment();
		var li = document.createElement('li');
		frag.appendChild(li);
		
		// event header
		var eventHeader = document.createElement('div');
		eventHeader.classList.add('event_header');
		eventHeader.innerHTML = '<h4>Event ' + (i + 1) + '</h4>';
		li.appendChild(eventHeader);
		
		var eventContent = document.createElement('div');
		eventContent.classList.add('event_content');
		eventContent.innerHTML =
			'<div class="option_row">' +
			'<label>When (Used to Order Content and must be a valid date format)</label>' +
			'<input type="date" name="events[event][' + i + '][when_order]" value="" class="widefat" placeholder="When? format: dd/mm/yyyy">' +
			'</div>' +
			'<div class="option_row">' +
			'<label>Time (Sidebar)</label>' +
			'<input type="text" name="events[event][' + i + '][time]" value="" class="widefat" placeholder="time">' +
			'</div>' +
			'<div class="option_row">' +
			'<label>When (Sidebar - optional free text to give you flexibility, otherwise it will use the when date)</label>' +
			'<input type="text" name="events[event][' + i + '][when]" value="" class="widefat" placeholder="When?">' +
			'</div>' +
			'<div>' +
			'<label>When (Featured - optional free text to give you flexibility, otherwise it will use the when date)</label>' +
			'<input type="text" name="events[event][' + i + '][when_featured]" value="" class="widefat" placeholder="eg. Thurs 26 - Sun 28 Oct 2018">' +
			'</div>' +
			'<div class="option_row">' +
			'<label>Where</label>' +
			'<input type="text" name="events[event][' + i + '][where]" value="" class="widefat" placeholder="Where?">' +
			'</div>' +
			'<div class="option_row">' +
			'<label>Address</label>' +
			'<input type="text" name="events[event][' + i + '][address]" value="" class="widefat" placeholder="Address">' +
			'</div>' +
			'<div class="option_row">' +
			'<label>Tickets</label>' +
			'<input type="text" name="events[event][' + i + '][tickets]" value="" class="widefat" placeholder="Tickets">' +
			'</div>' +
			'<div class="option_row">' +
			'<label>Get tickets button text</label>' +
			'<input type="text" name="events[event][' + i + '][tickets_text]" value="" class="widefat" placeholder="Get Tickets">' +
			'</div>' +
			'<div class="option_row">' +
			'<label>Get tickets button link</label>' +
			'<input type="text" name="events[event][' + i + '][tickets_link]" value="" class="widefat" placeholder="Link to where the tickets are sold">' +
			'</div>';
		li.appendChild(eventContent);
		
		$c.eventList.appendChild(frag);
	};
	
	return {
		init: init
	};
	
})(jQuery);

document.addEventListener('DOMContentLoaded', function(event) {
	EventAdmin.init();
});
