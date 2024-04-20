$(document).ready(function() {
  // Handle form submission using AJAX
  $('#search-form').submit(function(event) {
    event.preventDefault(); // Prevent the default form submission
    var query = $('#search-input').val(); // Get the search query
    fetchSearchResults(query); // Call the function to fetch and display search results
  });

  // Fetch and display search results
  function fetchSearchResults(query) {
    $.ajax({
      url: "{{ route('books.search') }}",
      type: "GET",
      data: { query: query },
      success: function(response) {
        $('#search-results').html(response); // Update the search results container
      },
      error: function(xhr, status, error) {
        console.log(error); // Log any errors to the console
      }
    });
  }
});
