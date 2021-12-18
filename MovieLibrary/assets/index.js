// -------------------------------------------- SignUp -------------------------------------------
function signUp(test) {
  if (test == "signUp") {
    document.getElementById("login-tableContent").className = "nav-link btl";
    document.getElementById("login").className = "tab-pane fade";
    document.getElementById("signUp-tableContent").className =
      "nav-link active btr";
    document.getElementById("signUp").className = "tab-pane fade show active";
  }
}
// -------------------------------------------- Alert Animation -------------------------------------------

$(document).ready(function () {
  setTimeout(function () {
    $(".alert").hide(800);
  }, 3000);
});

// -------------------------------------------- search form -------------------------------------------

$(document).ready(() => {
  $("#searchForm").on("submit", (event) => {
    let searchText = $("#searchText").val();
    getMovies(searchText);
    event.preventDefault();
  });
});

// -------------------------------------------- Search result -------------------------------------------

function getMovies(searchText) {
  let loader = `<div class="loader"></div>`;
  $("#movies").html(loader);
  axios
    .get(`http://www.omdbapi.com/?i=tt3896198&apikey=3a43dcb5&s=${searchText}`)
    .then((response) => {
      let result = response.data.Response;
      console.log(result);
      if (result == "True") {
        let movies = response.data.Search;
        let output = "";
        $.each(movies, (index, movie) => {
          output += `
                <div class="col-md-3">
                    <div class="card my-card card-01 height-fix" >
                        <img class="card-img-top" src="${movie.Poster}"/>
                        <div class="card-img-overlay">
                            <h5 class="card-title"><strong>${movie.Title}</strong></h5>
                            <p class="card-text">${movie.Year}</p>                         
                            <p class="card-text" ><a class="save" href="#" onclick="addList('${movie.Poster}','${movie.Title}','${movie.imdbID}')" data-toggle="modal" data-target="#addList"> <i class="fa fa-list"></i> SAVE</a></p>
                            <a onclick="movieSelected('${movie.imdbID}')" class="btn btn-outline-light" href="#">Movie Details</a>
                        </div>
                       
                    </div>
                </div>`;
        });
        $("#movies").html(output);
      } else {
        output = `<div class="container text-center">
                    <h4 class="font-weight-bold text-light"> No Movies Present with name ${searchText} </h4>
                </div>`;
        $("#movies").html(output);
      }
    })
    .catch((error) => {
      console.log(error);
    });
}

// -------------------------------------------- Add List -------------------------------------------

function addList(poster, title, imdbID) {
  document.getElementById("addPoster").value = poster;
  document.getElementById("addTitle").value = title;
  document.getElementById("addimdbID").value = imdbID;
  document.getElementById("movieName").innerHTML = title;
  return false;
}

function toggle() {
  if (document.getElementById("hide1").style.display == "none") {
    document.getElementById("hide1").style.display = "block";
    document.getElementById("addListName1").setAttribute("required", "");
    document.getElementById("addListName1").name = "addListName";
    document.getElementById("hide2").style.display = "none";
    document.getElementById("addListName2").name = "";
    document.getElementById("addListName2").removeAttribute("required");
    document.getElementById("access").style.display = "block";
  } else {
    document.getElementById("hide1").style.display = "none";
    document.getElementById("addListName1").removeAttribute("required");
    document.getElementById("addListName1").name = "";
    document.getElementById("hide2").style.display = "block";
    document.getElementById("addListName2").setAttribute("required", "");
    document.getElementById("addListName2").name = "addListName";
    document.getElementById("access").style.display = "none";
  }
}

function toggle1() {
  document.getElementById("hide1").style.display = "block";
  document.getElementById("addListName1").setAttribute("required", "");
  document.getElementById("addListName1").name = "addListName";
  document.getElementById("hide2").style.display = "none";
  document.getElementById("addListName2").name = "";
  document.getElementById("addListName2").removeAttribute("required");
  document.getElementById("access").style.display = "block";
}

// -------------------------------------------- Get Movie -------------------------------------------

function movieSelected(id) {
  sessionStorage.setItem("movieId", id);
  window.location = "movie.php";
  return false;
}

function getMovie() {
  let movieId = sessionStorage.getItem("movieId");
  let loader = `<div class="loader"></div>`;
  $("#loader").html(loader);

  axios
    .get(`http://www.omdbapi.com/?i=${movieId}&apikey=3a43dcb5`)
    .then((response) => {
      let movie = response.data;

      let output = `
                <div class="row">
                    <div class="col-md-4">
                        <img src="${movie.Poster}" class="img-thumbnail">
                    </div>
                    <div class="col-md-8 text-light mt-3">
                        <h2>${movie.Title}</h2>
                        <ul class="list-group list-group-flush">
                        <li class="list-group-item"><strong>Genre: </strong> ${movie.Genre}</li>
                        <li class="list-group-item"><strong>Released: </strong> ${movie.Released}</li>
                        <li class="list-group-item"><strong>Rated: </strong> ${movie.Rated}</li>
                        <li class="list-group-item"><strong>IMDB Rating: </strong> ${movie.imdbRating}</li>
                        <li class="list-group-item"><strong>Director: </strong> ${movie.Director}</li>
                        <li class="list-group-item"><strong>Writer: </strong> ${movie.Writer}</li>
                        <li class="list-group-item"><strong>Actors: </strong> ${movie.Actors}</li>
                        <li class="list-group-item"></li>
                        </ul>
                    </div>
                </div>
                <div class="row pt-4">
                    <div class="container text-light">
                        <div class=" p-3">
                        <h3>Plot</h3>
                        ${movie.Plot}
                        <hr>
                        <a href="http://imdb.com/title/${movie.imdbID}" target="_blank" class="btn btn-light">View IMDB</a>
                       
                    </div>
                    </div>
                </div>
            `;
      loader = ``;
      $("#loader").html(loader);
      $("#movie").html(output);
    })
    .catch((err) => {
      console.log(err);
    });
}
