<?php

$attributes = array();

if (($html_title = get_field('html_title'))) {
  $attributes['htmlTitle'] = $html_title;
}

if (!get_field('show_datasets_panel')) {
  $attributes['showDatasetsPanel'] = 'false';
}

$initial_bounds = get_field('initial_bounds');

if (isset($initial_bounds['lat_1']) && isset($initial_bounds['lat_2']) && isset($initial_bounds['lng_1']) && isset($initial_bounds['lng_2'])) {
  $attributes['initialBounds'] = array(
    array($initial_bounds['lat_1'], $initial_bounds['lng_1']),
    array($initial_bounds['lat_2'], $initial_bounds['lng_2'])
  );
}

$default_lat_lng = get_field('default_lat_lng');
if ($default_lat_lng['lat'] && $default_lat_lng['lng']) {
  $attributes['defaultLatLng'] = array(
    $default_lat_lng['lat'],
    $default_lat_lng['lng']
  );
}

if (($filterable_fields = get_field('filterable_fields'))) {
  $attributes['filterableFields'] = esc_attr($filterable_fields);
}

if (!get_field('does_directory_have_colours')) {
  $attributes['doesDirectoryHaveColours'] = 'false';
}

if (($disable_clustering_at_zoom = get_field('disable_clustering_at_zoom'))) {
  $attributes['disableClusteringAtZoom'] = $disable_clustering_at_zoom;
}

if (($searched_fields = get_field('searched_fields'))) {
  $attributes['searchedFields'] = esc_attr($searched_fields);
}

if (($max_zoom_on_group = get_field('max_zoom_on_group'))) {
  $attributes['maxZoomOnGroup'] = $max_zoom_on_group;
}

if (($max_zoom_on_one = get_field('max_zoom_on_one'))) {
  $attributes['maxZoomOnOne'] = $max_zoom_on_one;
}

if (($max_zoom_on_search = get_field('max_zoom_on_search'))) {
  $attributes['maxZoomOnSearch'] = $max_zoom_on_search;
}

if (($logo = get_field('logo'))) {
  $attributes['logo'] = $logo;
}

$map_url = get_field('map_url') . '?' . http_build_query($attributes, '', '&');

?>
<div id="sea-iframe-container">
  <div id="sea-iframe-box" class="iframe-box-normal">
    <iframe id="sea-map-iframe" src="<?= $map_url ?>"></iframe>
    <div class="cover"></div>

    <span id="sea-map-fullscreen-control" class="dashicons dashicons-fullscreen-alt" ></span>
  </div>
</div>

<div class="wp-block-buttons">
  <div class="wp-block-button"><a class="wp-block-button__link" href="<?= $map_url ?>" target="_blank">View Map In Full-screen</a></div>
</div>

<style type="text/css">

#sea-iframe-container{
  height: <?= (get_field('height') ?: '500') . 'px'; ?>;
  width:100%;
}

#sea-iframe-box{
  width: 100%;
  height: 100%;
}

#sea-map-iframe{
  width: 100%;
  height: 100%;
}

.iframe-box-fullscreen{
  position: absolute;
  /*top: 0;*/
  left: 0;
  z-index: 1000;
}

.iframe-box-normal{
  position: relative;
}

#sea-map-fullscreen-control{
  cursor: pointer;
  position: absolute;
  top: 10px;
  right: 40px;
  font-size:50px;
  opacity: 0.9;
}

</style>

<script type="text/javascript">

var iframeControl = document.getElementById('sea-map-fullscreen-control');

iframeControl.onclick = function(){
  var iframeBox = document.getElementById('sea-iframe-box');
  //iframeBox.requestFullscreen();
  if(iframeBox.className == "iframe-box-normal"){
    iframeBox.className = "iframe-box-fullscreen";
    iframeControl.className = "dashicons dashicons-fullscreen-exit-alt";
    document.body.style.overflow = "hidden";
    iframeBox.style.top = window.pageYOffset+"px";
    console.log("Yoffset: "+window.pageYOffset);
    //window.scrollTo(0,0);
  }else{
    iframeBox.className = "iframe-box-normal";
    iframeControl.className = "dashicons dashicons-fullscreen-alt";
    document.body.style.overflow = "auto";
    iframeBox.style.top = "";
  }
}
</script>
