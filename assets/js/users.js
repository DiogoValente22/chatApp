const searchBar = document.querySelector(".users .search input");
searchBtn = document.querySelector(".users .search button");

function searchToggle(){
    searchBar.classList.toggle("active");
    searchBar.focus();
    searchBtn.classList.toggle("active");
}

searchBtn.addEventListener("click", searchToggle);