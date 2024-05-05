/* https://www.w3schools.com/howto/howto_js_redirect_webpage.asp 
https://www.w3schools.com/howto/howto_js_dropdown.asp, https://pagedart.com/blog/how-to-add-a-search-bar-in-html/ and https://javascript.plainenglish.io/how-to-build-a-search-bar-7d8a8a3d9d00*/
// https://stackoverflow.com/questions/503093/how-do-i-redirect-to-another-webpage
function redirectTo(page) {
  window.location.href = page;
}

// https://www.w3schools.com/howto/howto_js_dropdown.asp
function toggleDropdown() {
  var dropdownContent = document.querySelector('.dropdown-content');
  dropdownContent.classList.toggle('show');
}

// Close  dropdown menu if user clicks outside of it
window.onclick = function (event) {
  if (!event.target.matches('.dropbtn')) {
    var dropdowns = document.getElementsByClassName("dropdown-content");
    for (var i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
};

// https://masteringjs.io/tutorials/fundamentals/filter-array-of-objects
// https://masteringjs.io/tutorials/fundamentals/arrow
const pages = [
  { title: 'Home', url: 'index.html' },
  { title: 'About', url: 'about.html' },
  { title: 'Contact', url: 'contact.php' },
  { title: 'Login', url: 'login.html' },
  { title: 'Books', url: 'books.html' },
  { title: 'Journals', url: 'journals.html' },
  { title: 'Dissertations', url: 'dissertations.html' },
  { title: 'Images', url: 'images.html' },
  { title: 'Videos', url: 'videos.html' },
];

// https://medium.com/@vmaineng/filtering-results-in-react-using-a-search-bar-327c92c93d94
// Function filter search items
function filterPages(searchTerm) {
  return pages.filter(page => {
    return page.title.toLowerCase().includes(searchTerm.toLowerCase());
  });
}

// https://stackoverflow.com/questions/42043803/javascript-simple-search-how-to-display-result-on-new-page
// https://www.w3schools.com/js/js_window_location.asp
// https://medium.com/@ianflurkey/using-foreach-and-innerhtml-to-create-search-results-6b11b9985d6b and https://forum.freecodecamp.org/t/adding-an-event-listener-to-dynamically-created-elements/185906/2
// https://www.w3schools.com/jsref/prop_node_textcontent.asp
// Function for search results
function displayResults(results) {
  const searchResults = document.getElementById('searchResults');
  searchResults.innerHTML = 'empty';
  results.forEach(result => {
    const div = document.createElement('div');
    div.textContent = result.title;
    div.addEventListener('click', () => {
      window.location.href = result.url;
    });
    searchResults.appendChild(div);
  });
}

// https://developer.mozilla.org/en-US/docs/Web/API/Document/DOMContentLoaded_event
// Event listener for search input
document.addEventListener('DOMContentLoaded', function () {
  const searchInput = document.getElementById('searchInput');
  searchInput.addEventListener('input', () => {
    const searchTerm = searchInput.value;
    const filteredPages = filterPages(searchTerm);
    displayResults(filteredPages);
  });
});


