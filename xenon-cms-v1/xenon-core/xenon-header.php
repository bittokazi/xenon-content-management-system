<?php
function xenon_header() {
global $headervaluei;
global $headervalue;
foreach ( $headervalue as $value ) {
echo $value;
}
}
function xenon_header_admin_panel() {
global $headervalueiap;
global $headervalueap;
foreach ( $headervalueap as $value ) {
echo $value;
}
}
function xenon_footer() {
global $headervalueif;
global $headervaluef;
foreach ( $headervaluef as $valuef ) {
echo $valuef;
}
}
function xenon_footer_admin_panel() {
global $headervalueifap;
global $headervaluefap;
foreach ( $headervaluefap as $valuef ) {
echo $valuef;
}
}
function get_image_xenon($ii,$loc) {
$url=$ii;
$i=0;
if(!isset($loc) || $loc=='') { $loc=home_url().'/xenon.png'; } else { $loc=home_url().'/xenon-themes/'.current_theme_name().$loc; }
$doc = new DOMDocument();
@$doc->loadHTML($url);

$tags = $doc->getElementsByTagName('img');
foreach ($tags as $tag) {
       $arr['$i']=$tag->getAttribute('src');
	   $i=$i+1;
}
$i=0;
if ( $arr['$i'] != "" ) {
return $arr['$i'];
}
else {
return $loc;
}
}
?>