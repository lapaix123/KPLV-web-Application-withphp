<!-- Add this script before the closing </body> tag -->
<script>
  // Function to display a popup message
  function displayPopupMessage(message, type) {
    var popupElement = document.getElementById('popup-message');
    popupElement.innerText = message;
    popupElement.className = 'popup-message ' + type;
    popupElement.style.display = 'block';
    setTimeout(function() {
      popupElement.style.display = 'none';
    }, 3000); // Hide after 3 seconds
  }

  // Check if session variables are set and display appropriate popup messages
  <?php
  if (isset($_SESSION['save'])) {
      echo "displayPopupMessage('" . $_SESSION['save'] . "', 'success');";
      unset($_SESSION['save']);
  }
  if (isset($_SESSION['error'])) {
      echo "displayPopupMessage('" . $_SESSION['error'] . "', 'error');";
      unset($_SESSION['error']);
  }
  ?>
</script>
