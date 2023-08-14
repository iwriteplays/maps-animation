<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDb7-u_nwhHHoJwy11hbygAHFkV9Y9rt5Q">


</script>


<script>
    var overlay;
    NOCOOverlay.prototype = new google.maps.OverlayView();

    // Initialize the map and the custom overlay.

    function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {

            zoom: 9,
            center: {
                lat: 40.4368664,
                lng: -105.8266014
            },
            scrollwheel: false,
            disableDefaultUI: true,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        });

        var bounds = new google.maps.LatLngBounds(
            new google.maps.LatLng(36.1215, -115.1739),
            new google.maps.LatLng(43.5364, -96.7317)
        );


        var myTitle = document.createElement('h1');
        var myText = document.createElement('p');
        myTitle.style.color = 'white';
        myTitle.innerHTML = 'Communities';
        myText.className = 'blurb';
        myText.innerHTML = '<?php the_field("communities_blurb","options"); ?>';
        var myTextDiv = document.createElement('div');
        myTextDiv.className = 'intro-div'
        myTextDiv.appendChild(myTitle);
        myTextDiv.appendChild(myText);

        map.controls[google.maps.ControlPosition.LEFT_CENTER].push(myTextDiv);

        var srcImage = '<?php echo get_template_directory_uri(); ?>/img/maps/map-green-large2.svg';

        overlay = new NOCOOverlay(bounds, srcImage, map);
        setMarkers(map);
    }

    function NOCOOverlay(bounds, image, map) {

        this.bounds_ = bounds;
        this.image_ = image;
        this.map_ = map;
        this.div_ = null;
        this.setMap(map);
    }

    NOCOOverlay.prototype.onAdd = function() {

        var div = document.createElement('div');
        div.style.borderStyle = 'none';
        div.style.borderWidth = '0px';
        div.style.position = 'absolute';

        var img = document.createElement('img');
        img.src = this.image_;
        img.style.width = '100%';
        img.style.height = '100%';
        img.style.position = 'absolute';
        div.appendChild(img);

        this.div_ = div;

        var panes = this.getPanes();
        panes.overlayLayer.appendChild(div);
    };

    NOCOOverlay.prototype.draw = function() {

        var overlayProjection = this.getProjection();

        var sw = overlayProjection.fromLatLngToDivPixel(this.bounds_.getSouthWest());
        var ne = overlayProjection.fromLatLngToDivPixel(this.bounds_.getNorthEast());

        var div = this.div_;
        div.style.left = sw.x + 'px';
        div.style.top = ne.y + 'px';
        div.style.width = (ne.x - sw.x) + 'px';
        div.style.height = (sw.y - ne.y) + 'px';
    };

    NOCOOverlay.prototype.onRemove = function() {
        this.div_.parentNode.removeChild(this.div_);
        this.div_ = null;
    };

    <?php

$args = array(
    'post_type' => 'communities',
    'posts_per_page' => -1,
    'meta_key'    => 'lat',
    'orderby'    => 'meta_value_num',
	'order'      => 'DESC',


);
// The Query
$the_query = new WP_Query( $args );

// The Loop
if ( $the_query->have_posts() ) { $i = 0;
	echo 'var cities = [';
	while ( $the_query->have_posts() ) {

		$the_query->the_post(); $i++;
		if((get_field('lat')) && (get_field('long'))) { echo "['" . get_the_title() . "', " . get_field('lat') . ", ". get_field('long') .",". $i .", '<div class=\"info text-bold\"><span class=\"\">".get_the_title()."</span></div>']," ;}
	}
	echo '];';
}
/* Restore original Post Data */
wp_reset_postdata();

  ?>


    function setMarkers(map) {
        var image = {
            url: '<?php echo get_template_directory_uri(); ?>/img/maps/pin-green.svg',
            size: new google.maps.Size(48, 50),
            scaledSize: new google.maps.Size(48, 50),
            origin: new google.maps.Point(0, 0),
            anchor: new google.maps.Point(23, 45)
        };
        var image2 = {
            url: '<?php echo get_template_directory_uri(); ?>/img/maps/pin-white.svg',
            size: new google.maps.Size(48, 50),
            scaledSize: new google.maps.Size(48, 50),
            origin: new google.maps.Point(0, 0),
            anchor: new google.maps.Point(23, 45)
        };

        var infowindow = new google.maps.InfoWindow();

        for (var i = 0; i < cities.length; i++) {
            var city = cities[i];
            var marker = new google.maps.Marker({
                position: {
                    lat: city[1],
                    lng: city[2]
                },
                map: map,
                icon: image,
                title: city[0],
                zIndex: city[3]
            });
            var infowindow;
            google.maps.event.addListener(marker, 'mouseover', function() {
                this.setIcon(image2);
            });
            google.maps.event.addListener(marker, 'mouseout', function() {
                this.setIcon(image);
                infowindow.close(map, marker);
            });


            google.maps.event.addListener(marker, 'mouseover', (function(marker, i) {
                return function() {
                    infowindow.setContent(cities[i][4]);
                    infowindow.setOptions({
                        maxWidth: 300
                    });

                    infowindow.open(map, marker);


                }
            })(marker, i));

        }





    }



    google.maps.event.addDomListener(window, 'load', initMap);

</script>


<div id="map"></div>
