<?php
    use Illuminate\Support\Facades\Auth;
    $roote = '';
    if($user->user_role=='admin'){
        $roote = "admin.";
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>All Books</title>
    <link href="{{ asset('storage/css/navbar_styles.css') }}" rel="stylesheet">
</head>

<body>
    <div class="content-container" id = "content-container" >
    <div  class='header'>
        <nav class="navbar" >
            <ul class="navbar-menu">
                <li class="navbar-item active"><a href="{{ route($roote.'books.index') }}"><img src="{{ asset('storage/images/buttons/site-logo.jpg') }}" alt="Site Icon" height="40"></a></li>
                <li class="navbar-item active" style="margin-left: 10px"><a href="{{ route($roote.'books.index') }}">Home</a></li>

                <li class="navbar-item active" style="margin-left: 10px"><a href="{{ route($roote.'users.index') }}">Users</a></li>


            </ul>
            <ul class="navbar-menu">
                <li>
                    <div class="filter-dropdown">
                        <img src="storage/images/buttons/filter.png" alt="Filter" class="filter-icon">
                      <select id="filter-select" onchange="filterResults(this.value)" onmouseover="showOptions()">
                        <option value="both">Search by Both</option>
                        <option value="users">Search by Users</option>
                        <option value="books">Search by Books</option>
                      </select>
                    </div>
                </li>
                <li>
                    <input type="text" class="search__input" id="search-input" placeholder="Search...">
                </li>
                  
                  
                  
            </ul>
            
            @if (Auth::check())
            <div class="navbar-profile">
                <img src="{{ asset('storage/images/profile_picture/'. $user->profile_picture) }}" alt="Profile Picture" class="navbar-profile-picture">
                <div class="navbar-profile-hover">
                    <ul class="navbar-profile-options">
                        <li>
                          <div style="display: flex;align-items: center;">
                            <img src="{{ asset('storage/images/profile_picture/'. $user->profile_picture) }}" style="display: block;border-radius: 50%; overflow: hidden; width: 40%;height: 40%;">
                            <span style="margin-left:10%;color: #7a7c7f; font-size: 130%;  font-family: 'Libre Baskerville';"> {{$user->name}}  </span>
                          </div>
                          <div style="height: 5px;width: auto;background-color: #7a7c7f; margin-top: 10%; border-radius: 10px;"></div>

                        </li><a href="{{ route('profile.edit') }}">
                        <li style='font-family: Calibri !important'> 
                          <img src="{{ asset('storage/images/drop_down_icons/profile.png') }}" style="max-width: 10%; margin-right:10%; position:relative; top:0.3em;">
                          
                            Profile
                        </li></a> 
                        <a href="{{ route('about') }}">
                        <li style='font-family: Calibri !important'>
                          <img src="{{ asset('storage/images/drop_down_icons/help.png') }}" style=" max-width: 10%; margin-right:10%; position:relative; top:0.3em;">
                          About
                        </li>
                        </a>
                        
                          <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <a href="#" onclick="event.preventDefault(); this.closest('form').submit();">
                              <li style='font-family: Calibri !important'>
                                <img src="{{ asset('storage/images/drop_down_icons/logout.png') }}" style="max-width: 10%;margin-right:10%; position:relative; top:0.3em;">
                                Log Out
                              </li>
                            </a>
                          </form>
                        
                    </ul>
                </div>
            </div>
            
            @else()
            <div class="navbar-connextion">
                <a href="{{ route('user.login') }}">Connect</a>
                <a href="{{ route('user.register') }}">Register</a>
            </div>
            @endif

        </nav>
    </div>
    
    

    <!--div class="search-results" id="search-results">
        
    </!--div-->

    <div class="search-results-container" id="search-results-container">
      <div class="search-results" id="search-results">
          
      </div>
    </div>

    </div>
    
<script>
        document.getElementById("search-input").addEventListener("input", function() {
            filterResults(document.getElementById("filter-select").value);
        });
    
        function filterResults(filterBy) {
  var input = document.getElementById("search-input").value.toLowerCase().trim();

  var userBoxes = document.getElementsByClassName("navbar_user-box");
  var bookBoxes = document.getElementsByClassName("navbar_book-box");
  var resultGrid = document.getElementsByClassName("result-grid")[0];
  var results = [];

  Array.prototype.forEach.call(userBoxes, function(userBox) {
    var userName = userBox.getElementsByClassName("user-name")[0].textContent.toLowerCase();
    if ((filterBy === "both" || filterBy === "users") && userName.includes(input)) {
      results.push({
        element: userBox,
        title: userName
      });
    }
  });

  Array.prototype.forEach.call(bookBoxes, function(bookBox) {
    var bookTitle = bookBox.getElementsByClassName("navbar-book-title")[0].textContent.toLowerCase();
    if ((filterBy === "both" || filterBy === "books") && bookTitle.includes(input)) {
      results.push({
        element: bookBox,
        title: bookTitle
      });
    }
  });

  results.sort(function(a, b) {
    if (a.title < b.title) {
      return -1;
    }
    if (a.title > b.title) {
      return 1;
    }
    return 0;
  });

  Array.prototype.forEach.call(userBoxes, function(userBox) {
    userBox.style.display = "none";
  });

  Array.prototype.forEach.call(bookBoxes, function(bookBox) {
    bookBox.style.display = "none";
  });

  var maxResults = 5; // Maximum number of results to display
  var displayedResults = results.slice(0, maxResults); // Slice the array to get the desired number of results

  displayedResults.forEach(function(result) {
    result.element.style.display = "block";
    resultGrid.appendChild(result.element);
  });

  if (input !== "") {
    resultGrid.style.display = "block";
    resultGrid.scrollTop = 0; // Scroll to the top of the results
    resultGrid.style.height = "auto"; // Reset the height
  } else {
    resultGrid.style.display = "none";
    resultGrid.style.height = "auto"; // Reset the height
  }
}

    </script>
    <script>
        var prevScrollPos = window.pageYOffset;
var header = document.querySelector(".header");
var isNavbarHidden = false;

window.onscroll = function() {
  var currentScrollPos = window.pageYOffset;

  if (prevScrollPos > currentScrollPos) {
    if (isNavbarHidden) {
      header.style.transform = "translateY(0)";
      header.style.opacity = "1";
      isNavbarHidden = false;
    }
  } else {
    if (!isNavbarHidden) {
      header.style.transform = "translateY(-100%)";
      header.style.opacity = "0";
      isNavbarHidden = true;
    }
  }
  prevScrollPos = currentScrollPos;
};
    </script>

<script>
    window.addEventListener('DOMContentLoaded', function() {
  showOptions();
});

function showOptions() {
  const filterSelect = document.getElementById('filter-select');
  filterSelect.size = filterSelect.options.length;
}
</script>

<script>
    document.addEventListener("click", function(event) {
    var target = event.target;
    var isSearchInput = target.matches(".search__input");

    if (!isSearchInput) {
        var searchResults = document.getElementById("search-results");
        searchResults.style.display = "none";
    }
});

document.getElementById("search-input").addEventListener("click", function() {
    var searchResults = document.getElementById("search-results");
    searchResults.style.display = "block";
});

</script>

</body>

</html>
