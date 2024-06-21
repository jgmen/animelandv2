<?php

include __DIR__ .'/js/' . basename(__FILE__);
include __DIR__ .'/css/' . basename(__FILE__);

$content = <<<EOD

<!-- Main menu -->
<div class="columns p-4"> 
  <div class="bd-menu column is-one-fifth">
    <aside class="menu p-5">
       <p class="menu-label">General</p>
      <ul class="menu-list">
        <li> <button onclick="showContent('new-anime-tab')"> <a><i class="fas fa-plus has-text-primary"></i> New Anime</a> </button></li>
        <li> <button onclick="showContent('edit-anime-tab')"> <a><i class="fas fa-pencil-alt has-text-primary"></i> Edit Anime</a> </button> </li>
        <li> <button onclick="showContent('edit-episode-tab')"> <a><i class="fas fa-pencil-alt has-text-primary"></i> Edit Episode</a> </button> </li>
      </ul>
    </aside>
  </div>  


 <div id="content" class="container box p-6" column>
    <!-- The content will be loaded here -->
  </div>
  
  <!-- Edit Episode -->
  <div class="tab-content" id="edit-episode-tab">
    <h1>Edit Episode</h1>
  </div>

<!-- Edit Anime -->
  <div class="tab-content" id="edit-anime-tab">
    <div id="edit-anime-tab-search">
      <h1 class="title"> <i class="fas fa-plus-square"></i> Edit the information of an anime</h1>

      <div class="field">
        <label class="label">Anime id</label>
        <div class="control">
          <input class="input" type="text" name="imported-animeanime-id" placeholder="insert mal_id from an existing anime in database">
        </div>
      </div>

      <div class="field">
        <div class="control">
          <button class="button is-link" onclick="showConfirm()">Edit</button>
        </div>
      </div>
    </div>
  </div>



  <!-- New Anime -->
  <div class="tab-content" id='new-anime-tab'>
    <div id="import-anime">
    <h1 class="title"> <i class="fas fa-plus-square"></i> Import a New Anime</h1>

    <div class="field">
      <label class="label">Anime id</label>
      <div class="control">
        <input class="input" type="text" name="imported-animeanime-id" placeholder="insert anime id from my anime list">
      </div>
    </div>

    <div class="field">
      <div class="control">
        <button class="button is-link" onclick="showConfirm()">Import</button>
      </div>
    </div>
    </div>
  </div>


  <!-- New Anime: Confimation -->
  <form class="tab-content container box p-6" id="confirm-anime" hx-post="/anime"  hx-swap="innerHTML" >
  
    <h1 class="title"> <i class="fas fa-plus-square"></i> Import a New Anime</h1>

    <div class="field">
      <label class="label">Anime ID (MAL ID)</label>
      <div class="control">
        <input class="input" type="text" placeholder="Enter MAL ID" name="mal_id">
      </div>
    </div>

    <div class="field">
      <label class="label">URL</label>
      <div class="control">
        <input class="input" type="text" placeholder="Enter URL" name="url">
      </div>
    </div>

    <div class="field">
      <label class="label">Title</label>
      <div class="control">
        <input class="input" type="text" placeholder="Enter anime title" name="title">
      </div>
    </div>

    <div class="field">
      <label class="label">Japanese Title</label>
      <div class="control">
        <input class="input" type="text" placeholder="Enter anime Japanese title" name="title_japanese">
      </div>
    </div>

    <div class="field">
      <label class="label">Synopsis</label>
      <div class="control">
        <textarea class="textarea" placeholder="Enter anime synopsis" name="synopsis"></textarea>
      </div>
    </div>

    <div class="field">
      <label class="label">Episodes</label>
      <div class="control">
        <input class="input" type="number" placeholder="Enter number of episodes" name="episodes">
      </div>
    </div>

    <div class="field">
      <label class="label">Duration</label>
      <div class="control">
        <input class="input" type="text" placeholder="Enter duration" name="duration">
      </div>
    </div>

    <div class="field">
      <div class="control">
         <label class="label">Airing</label>
        <label class="radio">
          <input type="radio" name="answer" value="true" />
          Yes
        </label>
        <label class="radio">
          <input type="radio" name="answer" value="false"/>
          No
        </label>
      </div>
    </div>

    <div class="field">
      <label class="label">Year</label>
      <div class="control">
        <input class="input" type="number" placeholder="Enter release year" name="year">
      </div>
    </div>

    <div class="field">
      <label class="label">Rating</label>
      <div class="control">
        <input class="input" type="text" placeholder="Enter anime rating" name="rating">
      </div>
    </div>

    <div class="field">
      <label class="label">Score</label>
      <div class="control">
        <input class="input" type="number" step="0.01" placeholder="Enter anime score" name="score">
      </div>
    </div>

    <div class="field">
      <label class="label">Season</label>
      <div class="control">
        <input class="input" type="text" placeholder="Enter season" name="season">
      </div>
    </div>

    <div class="field">
      <label class="label">Status</label>
      <div class="control">
        <input class="input" type="text" placeholder="Enter anime status" name="status">
      </div>
    </div>

    <div class="field">
      <label class="label">Studios (JSONB)</label>
      <div class="control">
        <input class="input" type="text" placeholder="Enter studios" name="studios">
      </div>
    </div>

    <div class="field">
      <label class="label">Images (JSONB)</label>
      <div class="control">
        <input class="input" type="text" placeholder="Enter images" name="images">
      </div>
    </div>

    <div class="field">
      <label class="label">Type</label>
      <div class="control">
        <input class="input" type="text" placeholder="Enter type" name="type">
      </div>
    </div>

    <div class="field">
      <label class="label">Cover URL</label>
      <div class="control">
        <input class="input" type="text" placeholder="Enter cover URL" name="cover_url">
      </div>
    </div>

    <div class="field">
      <label class="label">Trailer URL</label>
      <div class="control">
        <input class="input" type="text" placeholder="Enter trailer URL" name="trailer_url">
      </div>
    </div>

    <div class="field">
      <label class="label">Genres (JSONB)</label>
      <div class="control">
        <input class="input" type="text" placeholder="Enter genres" name="genres">
      </div>
    </div>

    <div class="field">
      <div class="control">
        <button class="button is-link" type="submit">
          Import
        </button>
        <div id="search-results"></div>
      </div>
    </div>
  </form>
</div>

$js

EOD;

include '_layout.php';
