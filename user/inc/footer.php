<script>
// Get the Sidebar
var mySidebar = document.getElementById("mySidebar");

// Get the DIV with overlay effect
var overlayBg = document.getElementById("myOverlay");

// Toggle between showing and hiding the sidebar, and add overlay effect
function w3_open() {
  if (mySidebar.style.display === 'block') {
    mySidebar.style.display = 'none';
    overlayBg.style.display = "none";
  } else {
    mySidebar.style.display = 'block';
    overlayBg.style.display = "block";
  }
}

// Close the sidebar with the close button
function w3_close() {
  mySidebar.style.display = "none";
  overlayBg.style.display = "none";
}
</script>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@tarekraafat/autocomplete.js@10.1.4/dist/autoComplete.min.js"></script>

<script>
$(document).ready(function() {
    $('#customerListTable').DataTable();
} );
$(document).ready(function() {
    $('#historyTable').DataTable({
      "order": [[ 3, "desc" ]]
    });
} );

</script>
<script>
if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}

</script>

</body>
</html>