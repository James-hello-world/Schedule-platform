// script.js

// Add event listeners for form submissions
document.getElementById("registration-form").addEventListener("submit", register);
document.getElementById("login-form").addEventListener("submit", login);
document.getElementById("schedule-form").addEventListener("submit", schedule);

function register(event) {
  event.preventDefault();

  // Extract user inputs
  const name = document.getElementById("reg-name").value;
  const email = document.getElementById("reg-email").value;
  const password = document.getElementById("reg-password").value;

  // Send data to the server
  fetch("server.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/x-www-form-urlencoded",
    },
    body: new URLSearchParams({
      action: "register",
      name: name,
      email: email,
      password: password,
    }),
  })
    .then((response) => response.json())
    .then((data) => {
      console.log("Server response:", data);
    })
    .catch((error) => {
      console.error("Error:", error);
    });
}

function login(event) {
  event.preventDefault();

  // Extract user inputs
  const email = document.getElementById("login-email").value;
  const password = document.getElementById("login-password").value;

  // Send data to the server
  fetch("server.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/x-www-form-urlencoded",
    },
    body: new URLSearchParams({
      action: "login",
      email: email,
      password: password,
    }),
  })
    .then((response) => response.json())
    .then((data) => {
      console.log("Server response:", data);
      if (data.message === "Login successful") {
        // Navigate to search.html after successful client login
        window.location.href = "search.html";
      } else {
        alert("Invalid email or password");
      }
    })
    .catch((error) => {
      console.error("Error:", error);
    });
}

function schedule(event) {
  event.preventDefault();

  // Extract user inputs
  const date = document.getElementById("schedule-date").value;
  const time = document.getElementById("schedule-time").value;
  const location = document.getElementById("schedule-location").value;
  const food = document.getElementById("schedule-food").value;

  // Send data to the server
  fetch("server.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/x-www-form-urlencoded",
    },
    body: new URLSearchParams({
      action: "schedule",
      date: date,
      time: time,
      location: location,
      food: food,
    }),
  })
    .then((response) => response.json())
    .then((data) => {
      console.log("Server response:", data);
    })
    .catch((error) => {
      console.error("Error:", error);
    });
}
