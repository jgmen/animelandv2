<?php

function getTags(array $genres) {
  $a = [];
  foreach ($genres as $g) {
    $string = '<a href="#">#' . $g->name . '</a>';
    array_push($a, $string);
  }
  return implode(' ', $a);
}

function getEpisodes(int $episodesNum) {
  $a = [];
  for ($i=1; $i <= $episodesNum; $i++) {
    $string = '<tr>' . "<th>$i</th>" . "<td>Episodeo: $i</td>" . '</tr>';
    array_push($a, $string);
  }
  return implode(' ', $a);
}

$tags = getTags(json_decode($anime['genres']));
$episodes = getEpisodes($anime['episodes']);


$content = <<<EOD
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<div class="container card p-6">
  <div class="columns">
    <div class="column">
      <div style="width: 225px; height: 320px; background-image: url('$anime[cover_url]'); background-size: 100% 100%;"></div>
    </div>
    <div class="column"> 
      <div class="box is-shadowless">
        <div>
          <h1 class="title">$anime[title]</h1>
        </div>
        <div>
          <p class="subtitle">Ep. 11/12</p>
        </div>
        <div>
          $tags
        </div>
        <div class="mt-4">
          <p><strong>Status</strong>: $anime[status]</p>
        </div>
        <div>
          <p> <strong>Age</strong>: $anime[rating]</p>
        </div>
        <div class="mb-4">
          <p> <strong>Year</strong>: $anime[year]</p>
        </div>
      </div>
    </div>
  </div>
  <div class="columns">
    <div class="column">
      <strong>About: </strong>
      <p>
      $anime[synopsis]
      </p>
    </div>
    <div class="column">
      <div>
        <div class="p-6">
          <button class="button is-fullwidth is-primary is-outlined">Watch</button>
        </div>
      </div>
    </div>
  </div>
  <table class="table">
    <tbody>     
      $episodes
    </tbody>
  </table>
</div>
EOD;

include '_layout.php';
