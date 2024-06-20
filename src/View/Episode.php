<?php

include __DIR__ .'/css/' . basename(__FILE__);
include __DIR__ .'/js/' . basename(__FILE__);


$data = new DateTime($episode['aired']);
setlocale(LC_TIME, 'pt_BR.UTF-8');
$formatedDate = strftime("%d de %B de %Y", $data->getTimestamp());

$content = <<<EOD

<div>
  <div class="container">
      <video id="player" controls playsinline name="media" poster="https://toigingiuvedep.vn/wp-content/uploads/2021/04/hinh-anh-anime-toc-xanh-de-thuong.jpg">
        <source src="https://rr4---sn-gpv7knee.googlevideo.com/videoplayback?expire=1718515390&ei=PgZuZpqOI-WMy_sP0ZelgAc&ip=2a02:4780:13:905:0:6c1:5655:2&id=3049474e77f8d8b0&itag=22&source=blogger&xpc=Egho7Zf3LnoBAQ%3D%3D&susc=bl&eaua=pPBo9J5J0jc&mime=video/mp4&vprv=1&dur=1450.922&lmt=1665769782930611&txp=1311224&sparams=expire,ei,ip,id,itag,source,xpc,susc,eaua,mime,vprv,dur,lmt&sig=AJfQdSswRQIhAIJcy8TbOCexo9P50aQvqDpflKGznnJH0SI4gqlkAqPTAiBxrb-UTTxmZ7ZJToyp37rX_de345TAQBiGsMiKHhVk_A%3D%3D&rm=sn-uphcg51pa-bpbl7l,sn-uphcg51pa-bpbe76,sn-bg0ks7l&fexp=24350485&req_id=a3163eda068ba3ee&redirect_counter=3&cms_redirect=yes&cmsv=e&ipbypass=yes&mh=wl&mip=45.170.113.162&mm=30&mn=sn-gpv7knee&ms=nxu&mt=1718486426&mv=m&mvi=4&pl=24&lsparams=ipbypass,mh,mip,mm,mn,ms,mv,mvi,pl&lsig=AHlkHjAwRQIgaiwcAGY5AFhYF11LiTSD8Z1023lnW58OLMGXNgZwyy0CIQDIxjGdK4Nq-6ApjKV7SREvd7Srn7FHNUrH0xY0XQ8Snw%3D%3D" type="video/mp4">
      </video>
  </div>




  <div class="episode-info">
    <div class="columns p-6">
        <div class="column is-half content">
          <div class="is-flex m-0">
            <h1 class="title is-5 has-text-primary">$anime[title]</h1>
            <i>. $anime[score] <i class="fas fa-star"></i></i>
          </div>

          <h1 class="title is-4 m-0"> E$episode[episode_number] - $episode[title] </h1>
          <p class="subtitle"> Lançado em $formatedDate </p>
          <p id="synopsis" >$episode[synopsis]</p>
          <a id="show-more-button" class="show-more-button">Mostrar mais</a>
      </div>
    </div>
  </div>


</div>
 
EOD;

require '_layout.php';
