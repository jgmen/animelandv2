
<?php

$content = <<<EOD
<div class="box">
  <form hx-post="/signup" hx-target="#response" hx-swap="innerHTML">
    <label class="label">Email</label>
    <input class="input" type="text" placeholder="email" name="email" />

    <label class="label">Password</label>
    <input class="input" type="text" placeholder="password" name="password" />

    <button class="button" type="submit">Submit</button>
  </form>

  <article class="message is-success">
    <div class="message-body" id="response">
    </div>
  </article>
<div>

EOD;

include '_layout.php';
