let divSuperman = document.getElementById('divImg');
// console.log(divSuperman);

// divSuperman.addEventListener('click', function()
// {
//     // let posLeft = 
    
//     divSuperman.style.left= '100px';

//     // if( ())

// });

divSuperman = setInterval(frame, 5);

function frame() {
  if (divSuperman.style.left == 0) {
    clearInterval(id);
  } else {
    divSuperman.style.left= '100px'; 
  }
}