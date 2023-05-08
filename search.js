document.getElementById("search-form").addEventListener("submit", search);

function search(event) {
  event.preventDefault();

  // Extract search query
  const query = document.getElementById("search-query").value;

  // Send data to the server
  fetch("server.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/x-www-form-urlencoded",
    },
    body: new URLSearchParams({
      action: "search",
      query: query,
    }),
  })
    .then((response) => response.json())
    .then((data) => {
      console.log("Server response:", data);
      // Display search results
      // Update the search-results div with the data received from the server
    })
    .catch((error) => {
      console.error("Error:", error);
    });
}
