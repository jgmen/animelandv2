<?php

$editAnimeTab = <<<EOD
console.log("editing anime tab");
EOD;

$editEpisodeTab = <<<EOD
console.log("editing episode tab");
EOD;

$newAnimeTab = <<<EOD
  let importAnime = document.getElementById('new-anime-tab');
  let confirmAnime = document.querySelector("#confirm-anime");
  let inputAnimeId = document.querySelector('input[name="imported-animeanime-id"]');

  // setup
  confirmAnime.style.display = "none";
  document.getElementsByName('answer')[1].checked = true;

  // inputs
  let malId = document.querySelector('input[name="mal_id"]');
  let title = document.querySelector('input[name="title"]');
  let urlMal = document.querySelector('input[name="url"]');
  let titleJp = document.querySelector('input[name="title_japanese"]');
  let synopsis = document.querySelector('textarea[name="synopsis"]');
  let episodes = document.querySelector('input[name="episodes"]');
  let duration = document.querySelector('input[name="duration"]');
  let airing = document.querySelector('input[name="answer"]');
  let year = document.querySelector('input[name="year"]');
  let rating = document.querySelector('input[name="rating"]');
  let score = document.querySelector('input[name="score"]');
  let season = document.querySelector('input[name="season"]');
  let status = document.querySelector('input[name="status"]');
  let studios = document.querySelector('input[name="studios"]');
  let images = document.querySelector('input[name="images"]');
  let type = document.querySelector('input[name="type"]');
  let coverUrl = document.querySelector('input[name="cover_url"]');
  let trailerUrl = document.querySelector('input[name="trailer_url"]');
  let genres = document.querySelector('input[name="genres"]');

  function getAnimeById(id) {
    const url = "https://api.jikan.moe/v4/anime";
    fetch(url + "/" + encodeURIComponent(id))
      .then(response => {
        if (!response.ok) {
          throw new Error('Network response was not ok ' + response.statusText);
        }
        return response.json();
      })
      .then(data => {
        data = data.data;
        malId.value = data.mal_id;
        urlMal.value = data.url; 
        title.value = data.title;
        titleJp.value = data.title_japanese;
        synopsis.value = data.synopsis;
        episodes.value = data.episodes;
        duration.value = data.duration;
        //Airing
        data.airing == true ?  airing.checked = true :  airing.checked = false;

        year.value = data.year;
        rating.value = data.rating;
        score.value = data.score;
        season.value = data.season;
        status.value = data.status;
        studios.value = JSON.stringify(data.studios);
        images.value = JSON.stringify(data.images.jpg);
        type.value = data.type;
        coverUrl.value = data.images.webp.image_url;
        trailerUrl.value =  data.trailer.embed_url;
        genres.value = JSON.stringify(data.genres);
      })
      .catch(error => {
        console.error('There has been a problem with your fetch operation:', error);
      });
  }


  // Events
  function showConfirm() {
    confirmAnime.style.display = "block";
    importAnime.style.display = "none";
    document.getElementById('content').style.display = "none";
    getAnimeById(inputAnimeId.value);
  }
EOD;


$js = <<<EOD

<script>

function showContent(tab) {
  let contents = document.getElementsByClassName('tab-content');
  for (let i = 0; i < contents.length; i++) {
      contents[i].style.display = 'none';
  }
  document.getElementById('content').style.display = "block"
  document.getElementById('content').innerHTML = document.getElementById(tab).innerHTML;

  // load js files
  switch (tab) {
    case 'new-anime-tab':
      addScriptToPage(`$newAnimeTab`);
      break;
    
    case 'edit-anime-tab':
      addScriptToPage(`$editAnimeTab`);
    break;

    case 'edit-episode-tab':
      addScriptToPage(`$editEpisodeTab`);
      break;

    default:
      break;
  }
}

function removeAllDynamicScripts() {
    const scripts = document.querySelectorAll('script[data-dynamic]');
    scripts.forEach(script => {
      script.parentNode.removeChild(script);
    });
  }
  
  function addScriptToPage(scriptContent) {
    removeAllDynamicScripts();
  
    var script = document.createElement('script');
    script.type = 'text/javascript';
    script.text = scriptContent;
    script.setAttribute('data-dynamic', '');
  
    document.body.appendChild(script);
}

 showContent('edit-anime-tab');

</script>
EOD;
