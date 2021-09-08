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
    const place = this.getPlace();
    console.log(place);
    if (!place.geometry || !place.geometry.location) {
        // User entered the name of a Place that was not suggested and
        // pressed the Enter key, or the Place Details request failed.
        window.alert("No GPS location available for input: '" + place.name + "'");
        return;
    }
    document.getElementById("Assoc_longitude").value = place.geometry.location.lng();
    document.getElementById("Assoc_latitude").value = place.geometry.location.lat();

}

google.maps.event.addDomListener(window, 'load', function () {
    // initializeAutocompleteByClass('map-input');
    initializeAutocompleteById('Assoc_adresse');
});