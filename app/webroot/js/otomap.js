/* Functions for the search form of Otomap */
var currentSearchForm = null;
function changeSearchForm(tab) {

    $('div.all-search').addClass('invisible');
    $('div.sdvx-search').addClass('invisible');

    $('li.all-tab').removeClass('selected');
    $('li.sdvx-tab').removeClass('selected');

    $("div." + tab + '-search').removeClass('invisible');
    $("li." + tab + '-tab').addClass('selected');
}


/* Functions for map view of Otomap */
function adjustCSS() {
    var h = $(window).height();
    var w = $(window).width();
    var sfm = 0; //parseInt($(".search-form").css("margin-bottom"));
    sfm += $("div#header").outerHeight(true);
    sfm += $("div#page-title").outerHeight(true);
    sfm += $("div.search-form").outerHeight(true);
    $("div#map_canvas").css("height", h - sfm);
    $("iframe#detail_frame").css("height", h - sfm);
    $("div#map_canvas").css("width", w - 300);
    $("body").css("overflow", "hidden");
}


function setMarker(lat, lng, id, info) {
    var opt = {
        position: new google.maps.LatLng(lat, lng),
        map: map,
    };
    var marker = new google.maps.Marker(opt);
    
    var optInfo = {
        position: new google.maps.LatLng(lat, lng),
        content: info,
    };
    
    var infoWindow = new google.maps.InfoWindow(optInfo);
    
    google.maps.event.addListener(marker, "click", function () {
        showDetail(id);
        
        if (currentWindow) {
            currentWindow.close();
        }
        
        infoWindow.open(map, marker);
        currentWindow = infoWindow;
    });
}
