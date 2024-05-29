<?php
$content = <<<EOD

<div class="box">
<h1>Login in Animeland </h1>
</div>
<div class="box">
  <form hx-post="/login" hx-target="#response" hx-swap="innerHTML">
    <div class="field">
      <label class="label">Email</label>
      <input class="input" type="text" placeholder="email" name="email" />
    </div>    

    <div class="field">
      <label class="label">Password</label>
      <input class="input" type="text" placeholder="password" name="password" />
    </div>

    <div class="field">
      <button class="button" type="submit">Submit</button>
    </div>
  </form>

  <div class="field">
    <div class="control" class="message is-success">
      <div class="message-body" id="response">
      </div>
    </div>
  </div>
<div>

EOD;
include '_layout.php';
?>
