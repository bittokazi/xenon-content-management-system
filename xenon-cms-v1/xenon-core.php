<?php
header('Content-Type: text/html; charset=UTF-8');
date_default_timezone_set("Asia/Dhaka");
//installetion location
function home_url() {
$install='';
$result = @mysql_query("SELECT * FROM frndzk_title
WHERE title = 'install_loc'");
if ( @mysql_num_rows($result) > 0 ) {
while($general = @mysql_fetch_array($result)) {
$install=$general['tagline'];
}
}
return $install;
}
global $results,$post_title, $post_count, $post_index,$posts,$postc;
$postc=1;
global $theme_details,$filter_page_title;
global $addon_details;
global $lolzzc,$homexco,$ghjghyhf,$homexcop;
global $widgetn,$addontitle;
global $xenonwidget;
global $themefile;
global $themepage;
global $addonfile;
global $addonpage;
global $menupage;
global $headervalue;
global $headervaluei;
global $headervaluef;
global $headervalueif;
global $addwitem;
global $addwitemi;
global $menupost;
global $menuuser;
global $menutheme;
global $menuaddon;
global $menusettings;
global $menutop;
global $menusidetop;
global $admintitle;
global $accessrol;
global $xenon12345home;
global $headervalueiap;
global $headervalueap;
global $headervaluefap;
global $headervalueifap;
$xenon12345home="not home";
global $i;
$lolzzc=0;
$widgeti=0;
 $headervaluef=array();
$headervalue=array();
$$headervalueap=array();
$$headervaluefap=array();
$i=0;
$headervaluei=0;
$addwitemi=0;
$headervalueif=0;
$headervalueifap=0;
global $customlink;
global $customlinkview;
global $customlinki;
$customlinki=0;
if ( isset($_GET['addon']) ) {
$addonfile=$_GET['addon'];
}
if ( isset($_GET['theme']) ) {
$themefile=$_GET['theme'];
}
function defence_sql_injection($strings) {
$string = stripslashes($strings);
$string = @mysql_real_escape_string($string);
return $string;
}
function admin_panel_folder() {
$loc="xenon-admin";
return $loc;
}
function addon_folder() {
$loc="xenon-addons";
return $loc;
}
function theme_folder() {
$loc="xenon-themes";
return $loc;
}
function upload_folder() {
$loc="xenon-upload";
return $loc;
}
function core_folder() {
$loc="xenon-core";
return $loc;
}

function xenon_core($component, $fname) {
if ( $component == "xenon_add_menu" )
{
$fname();
}
if ( $component == "xenon_title_filter" )
{
global $filter_page_title,$posts,$lolzzc,$postc;
while ( $lolzzc < $postc ) {
$posts[$lolzzc]['page']=$fname($posts[$lolzzc]['page']);
$posts[$lolzzc]['post']=$fname($posts[$lolzzc]['post']);
$lolzzc=$lolzzc+1;
}
$lolzzc=0;
}
if ( $component == "xenon_content_filter" )
{
global $filter_page_title,$posts,$lolzzc,$postc;
while ( $lolzzc < $postc ) {
$posts[$lolzzc]['postcontent']=$fname($posts[$lolzzc]['postcontent']);
$posts[$lolzzc]['pagecontent']=$fname($posts[$lolzzc]['pagecontent']);
$lolzzc=$lolzzc+1;
}
$lolzzc=0;
}
if ( $component == "xenon_time_filter" )
{
global $filter_page_title,$posts,$lolzzc,$postc;
while ( $lolzzc < $postc ) {
$posts[$lolzzc]['time']=$fname($posts[$lolzzc]['time']);
$lolzzc=$lolzzc+1;
}
$lolzzc=0;
}
if ( $component == "xenon_date_filter" )
{
global $filter_page_title,$posts,$lolzzc,$postc;
while ( $lolzzc < $postc ) {
$posts[$lolzzc]['date']=$fname($posts[$lolzzc]['date']);
$lolzzc=$lolzzc+1;
}
$lolzzc=0;
}
if ( $component == "xenon_postedby_filter" )
{
global $filter_page_title,$posts,$lolzzc,$postc;
while ( $lolzzc < $postc ) {
$posts[$lolzzc]['postedby']=$fname($posts[$lolzzc]['postedby']);
$lolzzc=$lolzzc+1;
}
$lolzzc=0;
}
if ( $component == "xenon_summery_filter" )
{
global $filter_page_title,$posts,$lolzzc,$postc;
while ( $lolzzc < $postc ) {
$posts[$lolzzc]['comment']=$fname($posts[$lolzzc]['comment']);
$lolzzc=$lolzzc+1;
}
$lolzzc=0;
}
if ( $component == "xenon_header" )
{
global $headervaluei;
global $headervalue;
$headervalue[$headervaluei]=$fname();
$headervaluei=$headervaluei+1;
}
if ( $component == "xenon_header_admin_panel" )
{
global $headervalueiap;
global $headervalueap;
$headervalueap[$headervalueiap]=$fname();
$headervalueiap=$headervalueiap+1;
}
if ( $component == "xenon_footer" )
{
global $headervalueif;
global $headervaluef;
$headervaluef[$headervalueif]=$fname();
$headervalueif=$headervalueif+1;
}
if ( $component == "xenon_footer_admin_panel" )
{
global $headervalueifap;
global $headervaluefap;
$headervaluefap[$headervalueifap]=$fname();
$headervalueifap=$headervalueifap+1;
}
}
function incliude_directory_admin () {
$dir = '../'.core_folder().'/';
$files = glob($dir . "*.php");
foreach ( $files as $file )
{
include($file);
}
}
function incliude_directory_root () {
$dir = core_folder().'/';
$files = glob($dir . "*.php");
foreach ( $files as $file )
{
include($file);
}
}
?>