let xshow = 0;



// Making the map and tiles
var map = L.map('map').setView([0, 0], 1);

L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
}).addTo(map);

// Making the marker and give it icon
const myIcon = L.icon({
    iconUrl: 'icon.png',
    iconSize: [50, 32],
    iconAnchor: [25, 16],
});

let marker = L.marker([0, 0], {icon: myIcon}).addTo(map)
.bindPopup('ISS')
.openPopup();








let url = 'https://api.wheretheiss.at/v1/satellites/25544';
let lat = document.getElementById("lat");
let lon = document.getElementById("lon");
let myloader = document.querySelector(".load");
let ShowLat = document.querySelector(".latitude")
let ShowLan = document.querySelector(".longitude")



let t = 0;
let firstTime = true;


async function getISS(){
    const response = await fetch(url);
    const data = await response.json();
    const {latitude, longitude} = data;


    marker.setLatLng([latitude, longitude]);

    if(firstTime){
        map.setView([latitude, longitude], 2)
    firstTime = false;
    }
    lat.textContent = latitude;
    lon.textContent = longitude;
    t++;
}

function load(){    
const issInterval = setInterval( ()=>{
    getISS(); 
    }, 2000);


        setTimeout(() => {
            load();
            myloader.style.display = "none";
            ShowLat.style.display = "block";
            ShowLan.style.display = "block";
            xshow = 0;
        }, 3500);
        


 };

//  function start(){

//     setTimeout(() => {
//         load();
//         myloader.style.display = "none";
//         ShowLat.style.display = "block";
//         ShowLan.style.display = "block";
//     }, 500);
    
//  }

 load();
// const Ftime = setTimeout(() => {
//     myloader.style.display = "none";
//     program.style.display = "block";
//     load();
// }, 2000);



