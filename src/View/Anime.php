<?php
$content = <<<EOD
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

<div class="container card p-6">
  <div class="columns">
    <div class="column">
      <div style="width: 225px; height: 320px; background-image: url('https://cdn.myanimelist.net/images/anime/1758/141268.jpg'); background-size: 100% 100%;"></div>
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
          <a href="#">#Adventure</a>
          <a href="#">#Action</a>
          <a href="#">#Hentai</a>
        </div>
        <div class="mt-4">
          <p><strong>Status</strong>: $anime[status]</p>
        </div>
        <div>
          <p> <strong>Age</strong>: $anime[age_rating]</p>
        </div>
        <div class="mb-4">
          <p> <strong>Year</strong>: $anime[release_date]</p>
        </div>
      </div>
    </div>
  </div>
  <div class="columns">
    <div class="column">
      <strong>About: </strong>
      <p>
      $anime[description] Lorem ipsum leo risus, porta ac consectetur ac, vestibulum at eros. Donec id elit non mi porta gravida at eget metus. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Cras mattis consectetur purus sit amet fermentum.
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
      <tr>
        <th>1</th>
        <td> Episódio 01 </td>
      </tr>
      <tr>
        <th>2</th>
        <td> Episódio 02 </td>
      </tr>

    </tbody>
  </table>
</div>
EOD;

include '_layout.php';
