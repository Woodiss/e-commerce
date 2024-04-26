let map = L.map('map').setView([48.86055605437785, 2.3446300176453168], 13);

// stadiamaps stamenterrain
let mapLayer = L.tileLayer('https://tiles.stadiamaps.com/tiles/stamen_terrain/{z}/{x}/{y}{r}.{ext}', {
	minZoom: 4,
	maxZoom: 17,
	attribution: '&copy; <a href="https://www.stadiamaps.com/" target="_blank">Stadia Maps</a> &copy; <a href="https://www.stamen.com/" target="_blank">Stamen Design</a> &copy; <a href="https://openmaptiles.org/" target="_blank">OpenMapTiles</a> &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
	ext: 'png'
});

mapLayer.addTo(map);
let cardVoyages = document.querySelectorAll('.a-card');

cardVoyages.forEach(function(cardVoyage) {
    // récupérer les data des voyages via les attributs
	let id = parseFloat(cardVoyage.getAttribute('data-id'))
    let latitude = parseFloat(cardVoyage.getAttribute('data-lat'));
    let longitude = parseFloat(cardVoyage.getAttribute('data-long'));
	let price = parseFloat(cardVoyage.getAttribute('data-price'));

	console.log(latitude + " " + longitude + " " + price);

	// création du marker
	let customIcon = L.divIcon({
	className: '',
	html: '<a class="custom-marker card' + id + '" href="/' + id + '">' + price + ' €</a>',
	iconSize: [null, null],
	iconAnchor: [15, 30],
	})

	console.log(customIcon);

    // ajoute de "customIcon" sur la carte
    L.marker([longitude, latitude], { icon: customIcon }).addTo(map);

	// souris entre dans la card
	cardVoyage.addEventListener("mouseenter", function()  {
		document.querySelector('.card' + id).classList.toggle("marker-hover")
	})

	// souris sors de la card
	cardVoyage.addEventListener("mouseleave", function()  {
		document.querySelector('.card' + id).classList.toggle("marker-hover")
	})
});
