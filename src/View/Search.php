<?php

$content = <<<EOD

<div class="container p-4">
  
  <div>
    <form id="searchForm" action="/search" method="get" class="is-flex">
      <input
        id="searchInput"
        class="input is-medium"
        type="text"
        name="q"
        placeholder="Search..."
      />
      <button type="submit">
        <span class="icon p-5">
          <i class="fas fa-search fa-lg"></i>
        </span>
      </button>
    </form>
  </div>


<script>
  document.getElementById('searchForm').addEventListener('submit', function(event) {
    event.preventDefault(); // Evita o envio do formulário padrão

    var searchTerm = document.getElementById('searchInput').value.trim();
    if (searchTerm) {
      var url = '/search/' + encodeURIComponent(searchTerm);
      window.location.href = url; // Redireciona para a página de pesquisa com o termo
    }
  });
</script>


<div class="columns is-multiline is-mobile p-4">
EOD;

foreach($results as $result) {
  $anime =  $result['_source'];
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

require '_layout.php';
