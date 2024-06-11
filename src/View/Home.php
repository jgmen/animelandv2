<?php

$content = <<<EOD
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
        <img src="$anime[cover_url]"/>
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
EOD;

include '_layout.php';
