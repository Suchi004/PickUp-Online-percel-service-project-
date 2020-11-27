mapboxgl.accessToken = 'pk.eyJ1IjoibmFoaWQ1OTciLCJhIjoiY2syMzQwZThqMHNnODNnbnIwZTYxbXptciJ9.pCJVXu5d-k1CDRZ9qJsFJQ';


var map;
style = 'mapbox://styles/mapbox/streets-v10';

var putUrl = 'http://localhost/PU/public/user/show/{id}';

var p = 0;
var popup = [];
var marker = [];
var ratingBarCheck = 0;

var lng = 88.70;
var lat = 24.70;


// active user information from database
var user_Lat =  88.6376;
var user_Lng = 24.3683;

var start = [lng, lat];

var success = 0;



// active user information from database
const user_id = document.location.search.replace(/^.*?\=/, '');

console.log('user id ' + user_id);


// if we want to show arrival time without domain
//getRoute(start);


// read data from database

var HttpClient = function() {
    this.get = function(aUrl, aCallback) {
        var anHttpRequest = new XMLHttpRequest();
        anHttpRequest.onreadystatechange = function() {
            //console.log(anHttpRequest.status);
            if (anHttpRequest.readyState == 4 && anHttpRequest.status == 200)
                aCallback(anHttpRequest.responseText);
        };

        anHttpRequest.open("GET", aUrl, true);
        anHttpRequest.send(null);
    };
};

// var data = httpGet('http://127.0.0.1:4444/admin/workers');
// console.log(data);

var dbElementsCount = 0;
var storeDbElements;

var client = new HttpClient();

function userDataFromDatabase() {
    this.client.get('http://127.0.0.1:8000/users?_id=' + user_id, function(response) {
        // do something with response
        var dbElement = JSON.parse(response);
        //console.log(store[1].Coordinate.x);
        var dbElementCount = dbElement.length;

        console.log(dbElement);

        var lng;
        var lat;

        for (var i = 0; i < dbElementCount; i++) {
            user_Lng = dbElement[i].coordinate_y;
            user_Lat = dbElement[i].coordinate_x;

            console.log("user lng checdk " + user_Lng);
            console.log("user lat  check " + user_Lat);
        }

        // setTimeout(() => {
        //     //this.userMarker();
        // }, 5 * 1000);






    });
}




this.initializeMap();

userDataFromDatabase();

  this.userMarker();

function getWorkerFormDatabase() {

    this.client.get('http://127.0.0.1:4444/users?Active_status=true', function(response) {
        // do something with response
        this.storeDbElements = JSON.parse(response);
        console.log(storeDbElements);
        //console.log(store[1].Coordinate.x);
        this.dbElementsCount = this.storeDbElements.length;
        console.log("hello anhid " + this.dbElementsCount);

        this.showMarkersFromDatabase(this.dbElementsCount);

    });
}

// initial query from database
this.getWorkerFormDatabase();

// query after fixed time
setInterval(function() {

    if (this.selcetCheck == 1) {
        this.singleSelectChangeText();
        this.conformWorkerCheck = 0;
    } else if (this.conformWorkerCheck == 1) {
        this.confirmToWorker(this.storeIdofRating);
        this.selcetCheck = 0;
    } else {
        this.getWorkerFormDatabase();
        this.selcetCheck = 0;
        this.conformWorkerCheck = 0;
    }

}, 10 * 1000);



// create check worker aray that indicate worker already exists in map or not

var userOnMapCheck;

// for (var i = 0; i < 10; i++) {
//     console.log(workerOnMapCheck[i]);
// }

function showMarkersFromDatabase(numbers) {
    console.log("user: " + numbers);



    for (var i = 0; i < numbers; i++) {
        //console.log("here " + this.storeDbElements[i].Name);
        //if(this.storeDbElements[i].Active_status

        if (typeof marker[this.storeDbElements[i]._id] === 'undefined') {
            console.log("chekc id");
            console.log("check lat of user" + this.storeDbElements[i].coordinate_y)
            this.userMarker(this.storeDbElements[i].coordinate_y, this.storeDbElements[i].coordinate_x, this.storeDbElements[i]._id, this.storeDbElements[i].Name);
        }

    }
}


var canvas = map.getCanvasContainer();

// for (var i = 1; i <= this.dbElementsCount; i++) {
//   this.workerMarker(88.60580 + p, 24.366079199999998, i, 'nahid', 'Engineer', '01783272160');
//   p += 0.01;
// }

function initializeMap() {
    /// locate the user
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(position => {
            //console.log(lat);
            lat = position.coords.latitude;
            lng = position.coords.longitude;

            console.log(lat, lng);
            map.flyTo({
                center: [lng, lat]
            });
        });
    } else {
        alert("please turn on your location...");
    }

    this.buildMap();

}

function buildMap() {
    map = new mapboxgl.Map({
        container: 'map',
        style: this.style,
        zoom: 13,
        center: [lng, lat]

    });

    //this.createMarker();
    // this.markerAnimation();
    // this.userMarker();

    /// Add map controls
    map.addControl(new mapboxgl.NavigationControl());
}


function userMarker() {

    // alert('please click on marker to get details of worker');

    navigator.geolocation.getCurrentPosition(function (response){

         var size = 120;

    console.log("Afroza sultana");

    var lat = response.coords.latitude;
    var lng = response.coords.longitude;

    var pulsingDot = {
        width: size,
        height: size,
        data: new Uint8Array(size * size * 4),

        onAdd: function() {
            var canvas = document.createElement('canvas');
            canvas.width = this.width;
            canvas.height = this.height;
            this.context = canvas.getContext('2d');
        },

        render: function() {
            var duration = 1000;
            var t = (performance.now() % duration) / duration;

            var radius = size / 2 * 0.3;
            var outerRadius = size / 2 * 0.7 * t + radius;
            var context = this.context;

            // draw outer circle
            context.clearRect(0, 0, this.width, this.height);
            context.beginPath();
            context.arc(this.width / 2, this.height / 2, outerRadius, 0, Math.PI * 2);
            context.fillStyle = 'rgba(30, 139, 195,' + (1 - t) + ')';
            //rgba(30, 139, 195, 1)
            // rgba(31, 58, 147, 1)
            context.fill();

            // draw inner circle
            context.beginPath();
            context.arc(this.width / 2, this.height / 2, radius, 0, Math.PI * 2);
            context.fillStyle = 'rgba(31, 58, 147, 1)';
            context.strokeStyle = 'white';
            context.lineWidth = 2 + 4 * (1 - t);
            context.fill();
            context.stroke();

            // update this image's data with data from the canvas
            this.data = context.getImageData(0, 0, this.width, this.height).data;

            // keep the map repainting
            map.triggerRepaint();

            // return `true` to let the map know that the image was updated
            return true;
        }
    };


    map.on('load', function() {

        // getRoute(start);
        // navigator.geolocation.getCurrentPosition(position => {
        // lat = position.coords.latitude;
        // lng = position.coords.longitude;
        console.log("lat user " + user_Lat);
        console.log("lng user " + user_Lng);

        // call route function for ruting...
        getRoute(start);

        map.addImage('pulsing-dot', pulsingDot, { pixelRatio: 2 });

        map.addLayer({
            "id": "points",
            "type": "symbol",
            "source": {
                "type": "geojson",
                "data": {
                    "type": "FeatureCollection",
                    "features": [{
                        "type": "Feature",
                        "geometry": {
                            "type": "Point",
                            "coordinates": [lng, lat]
                        }
                    }]
                }
            },
            "layout": {
                "icon-image": "pulsing-dot"
            }
        });

        // });
    });


    })


}


// create a function to make a directions request
function getRoute(end) {
    // make a directions request using cycling profile
    // an arbitrary start will always be the same
    // only the end or destination will change
    //console.log("end data" + end);

    // here we need data from user database

    var start = [user_Lng, user_Lat];

    // console.log("start data" + start);
    var url = 'https://api.mapbox.com/directions/v5/mapbox/cycling/' + start[0] + ',' + start[1] + ';' + end[0] + ',' + end[1] + '?steps=true&geometries=geojson&access_token=' + mapboxgl.accessToken;

    // make an XHR request https://developer.mozilla.org/en-US/docs/Web/API/XMLHttpRequest
    var req = new XMLHttpRequest();
    req.responseType = 'json';
    req.open('GET', url, true);
    req.onload = function() {
        var data = req.response.routes[0];
        var route = data.geometry.coordinates;
        //console.log(route);
        var geojson = {
            type: 'Feature',
            properties: {},
            geometry: {
                type: 'LineString',
                coordinates: route
            }
        };
        // if the route already exists on the map, reset it using setData



        if (map.getSource('route')) {
            map.getSource('route').setData(geojson);
        } else { // otherwise, make a new request
            map.addLayer({
                id: 'route',
                type: 'line',
                source: {
                    type: 'geojson',
                    data: {
                        type: 'Feature',
                        properties: {},
                        geometry: {
                            type: 'LineString',
                            coordinates: geojson
                        }
                    }
                },
                layout: {
                    'line-join': 'round',
                    'line-cap': 'round'
                },
                paint: {
                    'line-color': '#0000FF',
                    'line-width': 10,
                    'line-opacity': 0.85
                }
            });
        }
        // add turn instructions here at the end
        // get the sidebar and add the instructions

        var instructions = document.getElementById('instructions');
        //var finishedWork = document.getElementById('finishedWork');
        // var ratingPopup = document.getElementById("ratingPopup");
        var steps = data.legs[0].steps;
        //$("#instructions").hide();
        //$("#ratingPopup").hide();
        //$('#finishedWork').hide();
        var tripInstructions = [];
        for (var i = 0; i < steps.length; i++) {
            tripInstructions.push('<br><li>' + steps[i].maneuver.instruction) + '</li>';
            instructions.innerHTML = '<span class="duration">Arrival Time: ' + Math.floor((data.duration / 60) / 60) + ' hour ' + Math.floor((data.duration / 60) % 60) + ' min 🚴 </span>' +
                '<button type="button" style = "margin:5px" class="btn btn-primary btn-sm" onClick = "finishedWork()"> Finished Work</button>';

        }

        if (success) {
            // $('#closeButton').show();
            document.getElementById("instructions").style.visibility = 'visible';
            //$('#instructions').show();
            // map.getSource('route').hide();

        }


        // success = 0;

        // ratingPopup.innerHTML = '<h4 style = "color : #000099; font-weight: bold"> please give rating to worker: </h4>' +
        //     '<span class="fa fa-star checked1" id= "1" onClick = "starmark(' + 1 + ')" style = "font-size:30px; cursor: pointer "></span>' +
        //     '<span class="fa fa-star checked1" id= "2" onClick = "starmark(' + 2 + ')" style = "font-size:30px; cursor: pointer "></span>' +
        //     '<span class="fa fa-star checked1" id= "3" onClick = "starmark(' + 3 + ')" style = "font-size:30px; cursor: pointer "></span>' +
        //     '<span class="fa fa-star checked1" id= "4" onClick = "starmark(' + 4 + ')" style = "font-size:30px; cursor: pointer "></span>' +
        //     '<span class="fa fa-star checked1" id= "5" onClick = "starmark(' + 5 + ')" style = "font-size:30px; cursor: pointer "></span>';

        // ratingPopup.innerHTML += '<div>' + '<button style = "margin:5px" class = "btn btn-primary" onClick = "submitStars()"> submit </button>' + '</div>';

    };

    req.send();

}
