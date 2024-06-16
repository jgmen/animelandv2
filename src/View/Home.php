<?php

$content = <<<EOD
<div class="container p-4">
<div class="columns is-multiline is-mobile">

EOD;

foreach($animes as $anime) {
  $content .= <<<EOD
<a href="/anime/$anime[mal_id]">
<div class="column is-8"clas="card"  style="width: 220px">
  <div class="card"  style="width: 200px">
 
  <div class="card">
    <div class="card-image">
    <figure class="is-4by3">
      <div style="background-image: url($anime[cover_url]); width: 192px; height: 287px; background-size: cover; background-position: center;"></div>
    </figure>
    </div>
  </div>

  <div style="text-align: center; height: 50px; overflow: hidden"  class="p-1">
      <div>
          <p class="title is-6"> $anime[title]</p>
      </div>
  </div>


  </div>
  </div>
</a>
EOD;
}

$content .= <<<EOD
</div>
</div>
EOD;

include '_layout.php';
