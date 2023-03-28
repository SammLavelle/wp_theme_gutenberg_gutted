(function() {
	const accordionToggle = document.querySelectorAll('.accordion__label');
	accordionToggle.forEach(function(e){
		e.classList.add('closed');
	});
	accordionToggle.forEach(function(e){
		e.addEventListener("click", function(){
			this.classList.toggle('closed');
		})
	});
}) ();