<?php
include 'vfunc.php';
$title = 'Free Downloads Music and Video'; 
$description ='Maxmp3.pw Free Downloads Music and Video - Selamat Datang di Maxmp3.pw, disini anda dapat mencari Lagu, Video, Wallpaper, dan Lirik Lagu tanpa Batas. dengan tampilan yang nyaman dan simple, anda dapat menjelajah secara cepat. coba sekarang!';
$keywords ='download mp3, download lagu , gratis, mp3 gratis, 3gp, download full album';
 
include'head.php';


echo'<h2 class="bmenu1" align="center">Trending Topic This Week</h2><div class="list2"><table width="100%"><tbody>';

if(strlen($_GET['page']) >1)
{
 $yesPage = $_GET['page'];
}
else
{
 $yesPage='';
}

// YouTube Grab Top Videos

$grab = ngegrab('https://www.googleapis.com/youtube/v3/videos?key='.$devkey.'&part=snippet,contentDetails,statistics&chart=mostPopular&maxResults=20&regionCode=id');

$json = json_decode($grab);

if($json)
{
foreach ($json->items as $hasil)
{
$link= $hasil->id->videoId;
$id= $hasil->id;
$name= $hasil->snippet->title;
$desc = $hasil->snippet->description;
$chtitle = $hasil->snippet->channelTitle;
$chid = $hasil->snippet->channelId;
$date = dateyt($hasil->snippet->publishedAt);
$time=$dta->contentDetails->duration;
$duration= format_time($time);
$views= $dta->statistics->viewCount;

// Html Page

echo '<tr><td class="vithumb" width="100px"><img src="http://i.ytimg.com/vi/'.$id.'/hqdefault.jpg" title="'.$name.'" width="100px"></a></td> 
<td class="videsc"><a href="/watch?v='.$id.'">'.$name.'</a><br />
<span class="labels"> '.$date.'</span>
</td></tr>';
}
}
else
{
echo 'Result Not Found, please contact arsntx@gmail.com </font> 
<br> &raquo; <a href="#"> Download fast with uc browser </a>';
}

echo '</tbody></table></div></div>';

echo '<h2 class="bmenu1"><align="center"> Top Songs </h2><div class="list2">';

$grab = strstr(tmgrab('https://www.apple.com/id/itunes/charts/songs/'),'class="section chart-grid');
$tfkid = explode('</strong>',$grab);
for($i=1; $i<=11; $i++){
$file = cut($tfkid[$i],'l=en">','</a>');
$artis = cut($tfkid[$i],'&amp;l=en">','</a></h4>');
$imgz = cut($tfkid[$i],'src="','"');
$img = explode('">',$file); 
$img = str_replace('width="100" height="100"','width="60" height="60"',$file);
$bajingan = explode('">',$file);
$judul = cut($bajingan[0].'">','alt="','">');
$link=$artis.'-'.$judul;
$link=str_replace(' ', '-', $link);
$link=strtolower($link);
if(!empty($img[0])){
echo '<table width="100%" class="otable"><tbody><tr><td width="60px"><img src="https://www.apple.com/'.$imgz.'" alt="'.$artis.' - '.$judul.'" width="60" height="60"></td><td><a href="/video?q='.$link.'"> '.$artis.' - '.$judul.' </a></td></tr></tbody></table>';
}}

function cut($content,$start,$end){
if($content && $start && $end) {
$r = explode($start, $content);
if (isset($r[1])){
$r = explode($end, $r[1]);
return $r[0];
}return '';}}
echo '<div class="page_item"><a href="/music"> Next More.. </a></div></div>';
 
include 'category.php';
include 'foot.php';

?>
