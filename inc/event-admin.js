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
		
		$c.eventDeletes = document.querySelectorAll('#event_list .event_header .delete');
		if ($c.eventDeletes) {
			for (var i = 0; i < $c.eventDeletes.length; i++) {
				$c.eventDeletes[i].addEventListener('click', function(e) {
					e.preventDefault();
					removeEvent(this);
				});
			}
		}
	};
	
	var addNew = function() {
		var i = $c.eventList.childElementCount;
		
		var frag = document.createDocumentFragment();
		var li = document.createElement('li');
		li.classList.add('event_item');
		frag.appendChild(li);
		
		// event header
		var eventHeader = document.createElement('div');
		eventHeader.classList.add('event_header');
		eventHeader.innerHTML = '<h4>Event ' + (i + 1) + '</h4>';
		li.appendChild(eventHeader);
		
		var eventDelete = document.createElement('a');
		eventDelete.href = '#';
		eventDelete.classList.add('delete');
		eventDelete.innerHTML = 'delete';
		eventDelete.addEventListener('click', function(e) {
			e.preventDefault();
			removeEvent(this);
		});
		eventHeader.appendChild(eventDelete);
		
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
	
	var removeEvent = function(obj) {
		var event_item = obj.closest('li.event_item');
		if (event_item) {
			event_item.remove();
		}
	};
	
	return {
		init: init
	};
	
})(jQuery);

document.addEventListener('DOMContentLoaded', function(event) {
	EventAdmin.init();
});
