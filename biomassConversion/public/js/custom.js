// Get the modal
var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.getElementsByName("submit-hitung");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

function validateForm() {
    var inputjenispohon = document.forms["inputdata"]["jenis-pohon"].value;
    var inputkadarair = document.forms["inputdata"]["persen-kadarair"].value;
    var jenisdatainput = document.forms["inputdata"]["jenisdata-input"].value;
    var nilaidatainput = document.forms["inputdata"]["nilaidata-input"].value;
    if (nilaidatainput == "" || inputkadarair == "" || inputjenispohon == "" || jenisdatainput == "") {
        modal.style.display = "block";
        return false;
    }
}

  // When the user clicks on <span> (x), close the modal
  span.onclick = function() {
    modal.style.display = "none";
  }

  // When the user clicks anywhere outside of the modal, close it
  window.onclick = function(event) {
    if (event.target == modal) {
      modal.style.display = "none";
    }
  }

  $(document).ready(function(){
    $('[data-toggle="popover"]').popover();
});



$(window).load(function() {
    $(".imgAnimate").src("/public/pic/1.png");
  });

  $(".imgAnimate").mouseover(function() {
    $(this).src("/public/gif/1.gif");
  });

  $(".imgAnimate").mouseout(function() {
    $(this).src("/public/pic/1.png");
  });
