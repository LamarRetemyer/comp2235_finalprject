document.addEventListener("DOMContentLoaded", function () {
    // Add event listeners when the DOM is fully loaded
  
    var usersLabel = document.querySelector(".Users");
    var homeLabel = document.querySelector(".Home");
    var newContactLabel = document.querySelector(".NewContact");
    var logoutLabel = document.querySelector(".Logout");
  
    usersLabel.addEventListener("click", function () {
      redirectTo("users.html");
    });
  
    homeLabel.addEventListener("click", function () {
      redirectTo("dashboard.php");
    });
  
    newContactLabel.addEventListener("click", function () {
      redirectTo("newcontact.html");
    });
  
    logoutLabel.addEventListener("click", function () {
      redirectTo("login.html");
    });
  
    // Add hover effect
    var labels = document.querySelectorAll(".Users, .Home, .NewContact, .Logout");
  
    labels.forEach(function (label) {
      label.addEventListener("mouseover", function () {
        label.style.backgroundColor = "#F3F4F6";
        label.style.cursor = "pointer";
      });
  
      label.addEventListener("mouseout", function () {
        label.style.backgroundColor = "";
      });
    });
  
    function redirectTo(url) {
      window.location.href = url;
    }
  });
  