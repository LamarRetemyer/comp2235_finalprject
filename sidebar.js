document.addEventListener("DOMContentLoaded", function () {
  // Add event listeners when the DOM is fully loaded
  var usersLabel = document.querySelector(".Users");
  var homeLabel = document.querySelector(".Home");
  var newContactLabel = document.querySelector(".NewContact");
  var logoutLabel = document.querySelector(".Logout");

  var allLabel = document.querySelector(".All");
  var salesLeadsLabel = document.querySelector(".SalesLeads");
  var supportLabel = document.querySelector(".Support");
  var assignedToMeLabel = document.querySelector(".AssignedToMe");

  usersLabel.addEventListener("click", function () {
      redirectTo("userlist.php");
  });

  homeLabel.addEventListener("click", function () {
      redirectTo("dashboard.php");
  });

  newContactLabel.addEventListener("click", function () {
      redirectTo("newcontact.php");
  });

  logoutLabel.addEventListener("click", function () {
      // Send an AJAX request to logout when the Logout button is clicked
      var xhr = new XMLHttpRequest();
      xhr.open("GET", "logout.php", true);
      xhr.onreadystatechange = function () {
          if (xhr.readyState == 4 && xhr.status == 200) {
              // Redirect to the login page after successful logout
              window.location.href = "login.html";
          }
      };
      xhr.send();
  });

  // Add click event listeners for filter labels
  allLabel.addEventListener("click", function () {
      toggleLabelColor(allLabel);
  });

  salesLeadsLabel.addEventListener("click", function () {
      toggleLabelColor(salesLeadsLabel);
  });

  supportLabel.addEventListener("click", function () {
      toggleLabelColor(supportLabel);
  });

  assignedToMeLabel.addEventListener("click", function () {
      toggleLabelColor(assignedToMeLabel);
  });

  // Add hover effect for all labels
  var labels = document.querySelectorAll(".Users, .Home, .NewContact, .NewContactB, .Logout, .All, .SalesLeads, .Support, .AssignedToMe");

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

  function toggleLabelColor(label) {
      label.classList.toggle("active");
  }
});
