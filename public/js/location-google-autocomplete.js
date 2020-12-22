function initializeAutocompleteByClass(id) {
    const elements = document.getElementsByClassName(id);
    for (let i = 0; i < elements.length; i++) {
        let autocomplete = new google.maps.places.Autocomplete(elements[i], {types: ['geocode']});
        google.maps.event.addListener(autocomplete, 'place_changed', onPlaceChanged);
    }
}

function initializeAutocompleteById(id) {
    const element = document.getElementById(id);
    let autocomplete = new google.maps.places.Autocomplete(element, {types: ['geocode']});
    google.maps.event.addListener(autocomplete, 'place_changed', onPlaceChanged);
}

function onPlaceChanged() {
    // var place = this.getPlace();
    // console.log(place);  // Uncomment this line to view the full object returned by Google API.
}

google.maps.event.addDomListener(window, 'load', function () {
    // initializeAutocompleteByClass('map-input');
    initializeAutocompleteById('Assoc_adresse');
});