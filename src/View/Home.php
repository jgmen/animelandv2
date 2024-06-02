<?php

$content = <<<EOD
<div class="columns is-multiline is-mobile">

EOD;

foreach($animes as $anime) {
 $content .= <<<EOD
<div class="column is-8"clas="card"  style="width: 220px">
  <div class="card"  style="width: 200px">
  <div style="text-align: center; height: 50px; overflow: hidden" class="p-1">
    <div>
        <p class="title is-6"> $anime[title]</p>
        <p class="subtitle is-6"></p>
      </div>
  </div>

  <div class="card">
    <div class="card-image">
      <figure class="is-4by3">
        <img src="https://cdn.myanimelist.net/images/anime/1224/113092.jpg"/>
      </figure>
    </div>
  </div>

  <div>
    <div class="p-2" class="content" style="text-align: center;"> 
      <a href="#">#Adventure</a>
      <a href="#">#Suspense</a>
      <br />
      <time datetime="2016-1-1"> - $anime[release_date]</time>
    </div>
  </div>
  </div>
</div>
EOD;
}

$content .= <<<EOD
</div>
EOD;

include '_layout.php';
