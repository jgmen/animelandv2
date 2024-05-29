
<?php

$content = <<<EOD
<div class="content">
  <form hx-post="/forms" hx-target="#response" hx-swap="innerHTML">
    <label class="label">Name</label>
    <input class="input" type="text" placeholder="name" name="name" />

    <label class="label">email</label>
    <input class="input" type="text" placeholder="email" name="email" />

    <button class="button" type="submit">Submit</button>
  </form>

  <article class="message is-success">
    <div class="message-body" id="response">
    </div>
  </article>
<div>

EOD;

include '_layout.php';
