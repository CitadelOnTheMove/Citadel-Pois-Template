<?php include_once 'Config.php'; ?>
<!DOCTYPE html>
<html>
    <head> 
        <title>POIs Template</title> 
        <!--------------- Metatags ------------------->   
        <meta charset="utf-8" />
        <!-- Not allowing the user to zoom -->    
        <meta name="viewport" content="width=device-width,user-scalable=no,initial-scale=1.0,maximum-scale=1.0, minimum-scale=1.0"/>
        <!-- iphone-related meta tags to allow the page to be bookmarked -->
        <meta name="apple-mobile-web-app-capable" content="yes" />
        <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />

        <!--------------- CSS files ------------------->    
        <link rel="stylesheet" href="css/my.css" />
        
        <!--------------- Javascript dependencies -------------------> 
            
        <!-- Google Maps JavaScript API v3 -->    
        <script type="text/javascript"
                src="https://maps.googleapis.com/maps/api/js?sensor=false">
        </script>
        <!-- Google Maps Utility Library - Infobubble -->     
        <script type="text/javascript"
                src = "http://google-maps-utility-library-v3.googlecode.com/svn/trunk/infobubble/src/infobubble.js">
        </script>
        <!-- Overlapping markers Library: Deals with overlapping markers in Google Maps -->
        <script src="http://jawj.github.com/OverlappingMarkerSpiderfier/bin/oms.min.js"></script>  
        <!-- jQuery Library --> 
        <script src="js/jquery-1.8.2.min.js"></script>
<!--         jQuery Mobile Library -->
        <link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jquerymobile/1.4.2/jquery.mobile.min.css" />
        <script src="//ajax.googleapis.com/ajax/libs/jquerymobile/1.4.2/jquery.mobile.min.js"></script>
        <!-- Page params Library: Used to pass query params to embedded/internal pages of jQuery Mobile -->    
        <script src="js/jqm.page.params.js"></script>
        <!-- Template specific functions and handlers -->    
        <script src="js/pois-lib.js"></script>            
     
    </head> 

    <body>
         <!-- Home Page: Contains the Map -->
        <div data-role="page" id="page1" class="page">
            
            
<div data-role="popup" id="popupMenu" data-theme="a">
        <ul data-role="listview" data-inset="true" style="min-width:210px;">
            <li data-role="list-divider">How do you want to get there?</li>
<!--            <li><a href="#">View details</a></li>-->
            <li><a  onclick="initStartingPoint('DRIVING')" ><img class="ui-li-icon" src='css/images/car-black.png' />Car</a></li>
            <li><a  onclick="initStartingPoint('WALKING')" ><img  class="ui-li-icon"  src='css/images/walk2-black.png' />Walk</a></li>
              <li><a  onclick="initStartingPoint('TRANSIT')"><img  class="ui-li-icon"  src='css/images/bus-black.png'  />Public transportation</a></li>
<!--            <li><a href="#">Edit</a></li>
            <li><a href="#">Disable</a></li>
            <li><a href="#">Delete</a></li>-->
        </ul>
</div>
            
<!--            data-position="fixed" -->
            <header data-role="header"  data-tap-toggle="false" data-id="constantNav" data-fullscreen="true">
                <h1>Points of Interest - POIs</h1>
                <a href="" id="filter" data-icon="filter" data-iconpos="notext" data-theme="a" title="Settings" class="ui-btn-left">&nbsp;</a>
                <a href="#info" data-rel="dialog" data-icon="info" data-iconpos="notext" data-theme="a" title="Info" class="ui-btn-right">&nbsp;</a>
                <div data-role="navbar" class="navbar">
                    <ul>
                        <li><a href="#" class="pois-nearme" data-theme="a">Near me</a></li>
                        <li><a href="#" class="pois-showall ui-btn-active" data-theme="a">Show all</a></li>
                        <li><a href="#page2" class="pois-list" data-theme="a">List</a></li>
                    </ul>
                </div><!-- /navbar -->
            </header>
            
            <div data-role="content" id="map-filter">
                <div class="filters-list" id="mapFilterList">
                    <fieldset data-role="controlgroup" data-mini="true" data-theme="a">
                        <!-- dynamically filled with data -->
                    </fieldset>
                </div>
                <footer data-role="footer" data-posistion="fixed" data-fullscreen="true" class="filter-footer">
                    <a href="" id="apply" data-icon="gear" data-theme="a" title="Apply" class="ui-btn-right">Apply</a>
                </footer>
            </div><!--map-filter-->

            <div data-role="content" id="map-container">
                <div id="map_canvas" class="map_canvas"></div>
            </div>

        </div>

        <!-- List Page: Contains a list with the results -->
        <div data-role="page" id="page2" class="page">

            <header data-role="header" data-posistion="fixed" data-id="constantNav">
                <span class="ui-title"> Points of Interest - POIs </span>
                <fieldset data-role="controlgroup" class="favourites-button">
                    <input type="checkbox" name="favourites" id="favourites" class="custom" />
                    <label for="favourites">Favourites</label>
                </fieldset>
                <a href="" data-icon="back" data-iconpos="notext" data-theme="a" title="Back" data-rel="back" class="ui-btn-right">&nbsp;</a>
                <div data-role="navbar" class="navbar">
                    <ul>
                        <li><a href="#" class="pois-nearme" data-theme="a">Near me</a></li>
                        <li><a href="#" class="pois-showall" data-theme="a">Show all</a></li>
                        <li><a href="#page2" class="pois-list ui-btn-active" data-theme="a">List</a></li>
                    </ul>
                </div><!-- /navbar -->
            </header>

            <div class="list-container">
                <div class="list-scroll-container">
                    <div data-role="content" id="list" class="poi">
                        <ul data-role='listview' data-filter='true' data-theme='a'>
                        <!-- dynamically filled with data -->
                        </ul>
                    </div><!--list-->
                     <div class="list-pagination-container">
                         
                         <div class="ui-grid-b">
    <div class="ui-block-a"><div class="ui-bar ui-bar-a" style="height:40px"><a id="list-pagination-previous" class="ui-btn ui-shadow ui-corner-all ui-icon-arrow-l ui-btn-icon-notext ui-btn-right">Previous page</a></div></div>
    <div class="ui-block-b"><div class="ui-bar ui-bar-a" style="height:40px"><span id="list-pagination-text"><!-- dynamically filled with data --></span></div></div>
    <div class="ui-block-c"><div class="ui-bar ui-bar-a" style="height:40px"><a id="list-pagination-next" class="ui-btn ui-shadow ui-corner-all ui-icon-arrow-r ui-btn-icon-notext ui-btn-left">Next page</a></div></div>
</div>
                         
                         
<!--<a id="list-pagination-previous" class="ui-icon ui-icon-arrow-l ui-icon-shadow">&nbsp;</a>-->

<!--<button id="list-pagination-previous" class="ui-btn ui-shadow ui-corner-all ui-btn-icon-left ui-icon-arrow-l">arrow-l</button>-->


<!--<a id="list-pagination-next" class="ui-icon ui-icon-arrow-r ui-icon-shadow">&nbsp;</a>-->
</div>
                </div><!--list-scroll-container-->
            </div><!--list-container-->
        </div><!-- /page -->
        
        <!-- Details Page: Contains the details of a selected element -->
        <div data-role="page" id="page3" data-title="Event fullstory page title" class="page">
            <header data-role="header" data-posistion="fixed" data-fullscreen="true">
                <span class="ui-title"> Points of Interest - Events </span>
                <a href="" data-icon="back" data-iconpos="notext" data-theme="a" title="Back" data-rel="back" class="ui-btn-right">&nbsp;</a>
                <div data-role="navbar" class="navbar">
                    <ul>
                        <li><a href="#" class="pois-nearme" data-theme="a">Near me</a></li>
                        <li><a href="#" class="pois-showall" data-theme="a">Show all</a></li>
                        <li><a href="#page2" class="pois-list" data-theme="a">List</a></li>
                    </ul>
                </div><!-- /navbar --> 
            </header>
            
            <div class="list-container">
                <div class="list-scroll-container">
                    <div data-role="content">
                         <a onclick='seeOnMap(); return false;'  class="ui-btn ui-shadow ui-corner-all ui-icon-location ui-btn-icon-notext">See on map</a>
               
                        <span id="item"></span>
                        <!-- dynamically filled with data -->
                    </div><!--item-->
                </div><!--list-scroll-container-->
            </div><!--list-container-->
                
            <footer data-role="footer" data-posistion="fixed" data-fullscreen="true">
                <a href="" id="addFav" data-icon="star" data-theme="a" title="Add to favourites" data-rel="star" class="ui-btn-center">Add to favourites</a>
                <a href="" id="removeFav" data-icon="star" data-theme="a" title="Remove from favourites" data-rel="star" class="ui-btn-center">Remove from favourites</a>
            </footer>
                
        </div><!-- /page -->
            
            
        <!-- Info Page: Contains info of the currently used dataset -->  
        <div data-role="dialog" id="info">
            <header data-role="header">
                <span class="ui-title">Dataset Metadata</span>	
            </header>
            <article data-role="content">
                <ul data-role="listview">
                    <!-- dynamically filled with data -->
                </ul> 
            </article> 
        </div> 
            
      
        <script type="text/javascript">
                    /****************** Global js vars ************************/
                    
                    /* GLobal map object */
                    var map;  
                    /* List of pois read from json object */
                    var pois = {};
                    /* List of dataset metadata read from json object */
                    var meta = {};
                    /* Holds all markers */
                    var markersArray = [];
                    /* Define filters - get them from db */
                    var filters = <?php include_once CLASSES.'filters.php'; printFilters(); ?>;
                    /* Remember if a page has been opened at least once */
                    var lastLoaded = '';
                    /* Remember if 'near me' marker is loaded */
                    var isNearMeMarkerLoaded = false;
                    /* 
                     * Remember if map was initialy loaded. If not
                     * it means we loaded list page
                     */
                    var isMapLoaded = false;
                    /*
                     * Keeps page id to emulate full url using querystring
                     */
                    var pageId = 0;
                    /* Set infoBubble global variable */
                    var infoBubble;
                    
                    /* The coordinates of the center of the map */
                    //Issy
                    var mapLat = <?php echo MAP_CENTER_LATITUDE; ?>;
                    var mapLon = <?php echo MAP_CENTER_LONGITUDE; ?>;
                    var mapZoom = <?php echo MAP_ZOOM; ?>;
                    
                    /* The url of the dataset */    
                    var datasetUrl = "<?php echo DATASET_URL; ?>";

                    /* Just call the initialization function when the page loads */
                    $(window).load(function() {
                        globalInit();
                    });     
                    
        </script>
    </body>
</html>