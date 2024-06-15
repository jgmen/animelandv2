<link rel="stylesheet" href="https://cdn.plyr.io/3.7.8/plyr.css" />
<script src="https://cdn.plyr.io/3.6.12/plyr.js"></script>

<script>

document.addEventListener('DOMContentLoaded', () => {
      const player = new Plyr('#player');
      window.player = player;
});



document.addEventListener('DOMContentLoaded', function () {
  let synopsis = document.getElementById('synopsis');
  let textContent = synopsis.textContent;
  let textContentSliced = textContent.slice(0, 354).concat("...");
  

  synopsis.textContent = textContentSliced;

  let button = document.getElementById('show-more-button');
  let buttonActive = false;
  
  button.addEventListener('click', function (event) {
    buttonActive = !buttonActive;

    if (buttonActive == true) {
      synopsis.textContent = textContent;
      button.textContent = "Mostrar menos"
    } else {
      synopsis.textContent = textContentSliced;
      button.textContent = "Mostrar mais";
    }
  });

});

</script>
