let map, infoWindow;

async function initMap() {
    map = new google.maps.Map(document.getElementById("map"), {
        center: {lat: -34.397, lng: 150.644}, zoom: 6,
    });
    infoWindow = new google.maps.InfoWindow();
    // get places auto-complete when user type in location-text-box
    let input = document.getElementById("autocomplete")


    var autocomplete = new google.maps.places.Autocomplete(input);
    autocomplete.bindTo('bounds', map);

    var infowindow = new google.maps.InfoWindow();
    marker = new google.maps.Marker({
        map: map, anchorPoint: new google.maps.Point(0, -29), draggable: true
    });

    google.maps.event.addListener(autocomplete, 'place_changed', async function () {
        infowindow.close();
        marker.setVisible(false);
        var place = autocomplete.getPlace();
        if (!place.geometry) {
            return;
        }

        // If the place has a geometry, then present it on a map.
        if (place.geometry.viewport) {
            map.fitBounds(place.geometry.viewport);
        } else {
            map.setCenter(place.geometry.location);
            map.setZoom(17); // Why 17? Because it looks good.
        }
        marker.setIcon(({
            url: place.icon,
            size: new google.maps.Size(71, 71),
            origin: new google.maps.Point(0, 0),
            anchor: new google.maps.Point(17, 34),
            scaledSize: new google.maps.Size(35, 35)
        }));
        marker.setPosition(place.geometry.location);
        marker.setVisible(true);

        var address = '';
        if (place.address_components) {
            address = [(place.address_components[0] && place.address_components[0].short_name || ''), (place.address_components[1] && place.address_components[1].short_name || ''), (place.address_components[2] && place.address_components[2].short_name || '')].join(' ');
        }
        await saveHistory();
    });
    const locationButton = document.createElement("button");

    locationButton.textContent = "Pan to Current Location";
    locationButton.classList.add("custom-map-control-button");
    map.controls[google.maps.ControlPosition.TOP_CENTER].push(locationButton);
    locationButton.addEventListener("click", () => {
        // Try HTML5 geolocation.
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition((position) => {
                const pos = {
                    lat: position.coords.latitude, lng: position.coords.longitude,
                };
                infoWindow.open(map);
                marker.setPosition(pos);
                marker.setVisible(true);
                map.setCenter(pos);

            }, () => {
                handleLocationError(true, infoWindow, map.getCenter());
            });
        } else {
            // Browser doesn't support Geolocation
            handleLocationError(false, infoWindow, map.getCenter());
        }
    });
}

function handleLocationError(browserHasGeolocation, infoWindow, pos) {
    infoWindow.setPosition(pos);
    infoWindow.setContent(browserHasGeolocation ? "Error: The Geolocation service failed." : "Error: Your browser doesn't support geolocation.");
    infoWindow.open(map);
}

document.getElementById('search').addEventListener('submit', async function (e) {
    e.preventDefault();
});

async function saveHistory() {
    let formData = new FormData();
    formData.append('address', document.querySelector('#autocomplete').value);
    await fetch('/address/saveHistory', {
        method: 'post', body: formData
    }).then((response) => {
        if (response.status === 200) {
            console.log('save success');
        }
    });
}


window.initMap = initMap;
