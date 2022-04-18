// let divSuperman = document.getElementById('divImg');
// console.log(divSuperman);

// divSuperman.addEventListener('click', function()
// { 
     
//     let posLeft = divSuperman.style.left;
//     let posRight = divSuperman.style.right;

//     console.log(posLeft);
//     console.log(posRight);

//     // if(posLeft == false )
//     // {
//     //       console.log('here');
//     // }

//     if( (posRight == false && posLeft == 0) || posLeft == '1000px')
//     {
//       console.log("toleft");

//       divSuperman.style.left = '-500px';
//       divSuperman.style.transition = "all 10s ease ";

//       // $("#divImg").css({
//       //   display: "block",
//       //   visibility: "visible"
//       // }),

//       // TEST 1 ANIMATE JQUERY

//       // $("#divImg").animate(
//       //   { 
//       //     left : "-500px",
//       //     // visibility: "visible",
//       //     // display: "block"
          
//       //   },
//       //   {
//       //     duration: 1000,
//       //     easing: "linear", function()
//       //     {
//       //       console.log('movetoLeftComplete')

//       //     }
//       //   }
        
//       //   );

//       // TEST 2 ANIMATE JQUERY

//       // $("#divImg").animate(
//       //   {
//       //     left: "-500px"
//       //   }, 1000, "linear" , function()
//       //   {
//       //     console.log('movetoLeftComplete')
//       //   }
//       // );
//     }
//     else if(posLeft == '-500px')
//     {
//       console.log("toRights");

//       divSuperman.style.left = '1000px';
//       divSuperman.style.transition = "all 0.1s";
//       divSuperman.style.display = "none";
//       divSuperman.style.visibility = 'hidden';

      // $("#divImg").css({
      //     display: "none",
      //     visibility: "hidden"
      //   }),

      // $("#divImg").animate(
      //   { 
      //     left : "1000px",
      //     // display: "none",
      //     // visibility: "hidden"
    
      //   },
      //   {
      //     duration: 1000,
      //     easing: "linear", function()
      //     {
      //       console.log('movetoRightComplete')

      //     }
      //   }
        
      //   );

        // $("#divImg").css({
        //   display: "block",
        //   visibility: "visible"
        // });
//     }
     
// });

// TEST 3 FONCTION avec interval:

// let divSuperman = document.getElementById('divImg');
// console.log(divSuperman);
  


// function superman ()
// {

//   let posLeft = divSuperman.style.left;
//   let posRight = divSuperman.style.right;

//   console.log(posLeft);
//   console.log(posRight);

//   if( (posRight == false && posLeft == 0) || posLeft == '1000px')
//   {
//     console.log("toleft");
  
//     divSuperman.style.left = '-500px';
//     divSuperman.style.transition = "all 10s ease ";
  
//   }
//   else if(posLeft == '-500px')
//   {
//     console.log("toRights");
  
//     divSuperman.style.left = '1000px';
//     divSuperman.style.transition = "all 0.1s";
//     // divSuperman.style.display = "none";
//     // divSuperman.style.visibility = 'hidden';
  
//   }
  
// }

// function supermanBack()
// {
//   $("#divImg").animate(
//         { 
//           left : "1000px",
//           display: "none",
//           visibility: "hidden"
    
//         },
//         {
//           duration: 1000,
//           easing: "linear"
//         }
        
//         );

  // divSuperman.style.visibility = "hidden";
  // divSuperman.style.transition = "all 0.1s";
  // divSuperman.style.left = '1500px';  
// }

// function moveSuperman()
// {
//   divSuperman.style.visibility = 'visible';
//   divSuperman.style.transition = "all 10s ease ";
//    setTimeout(supermanBack, 12000);
//   divSuperman.style.left = '-500px';
  
//   // divSuperman.style.display = "block";
// }

// setInterval(moveSuperman, 13000);
 







// divSuperman = setInterval(frame, 5);

// function frame() {
//   if (divSuperman.style.left == 0) {
//     clearInterval(id);
//   } else {
//     divSuperman.style.left= '100px'; 
//   }
// }

// function superman()
// {
//   let posLeft = divSuperman.style.left;
//      let posRight = divSuperman.style.right;

//   if(posLeft = false )
//   {
//         console.log(here);
//     divSuperman.style.left= '0px';
//   }
//   else if(divSuperman.style.left == '-250px' )
//   {
//     // clearInterval(divSuperman);
//   }
//   else
//   {

//     // divSuperman.style.left= '-250px';
//   }

// let posLeft = divSuperman.style.left;
// let posRight = divSuperman.style.right;

// console.log(posLeft);
// console.log(posRight);

// if(posLeft == false )
// {
//       console.log('here');
// }

// if(posRight == false && posLeft == 0)
// {
//   console.log("toleft");

//   $("#divImg").animate(
//     { 
//       left : "-100px",
//       visibility : 'visible',
//       display: 'block'
//     },
//     {
//       duration: 1000,
//       easing: "linear"
//     }
    
//     );

    
// }
// else if(posLeft == '-100px')
// {
//   console.log("toRights");

//   // divSuperman.style.left = '1000px';


//   $("#divImg").hide(
//     { 
//       left : "100px"
//     },
//     {
//       duration: 1000,
//       easing: "linear"
//     }
    
//     );

// }


  
// }

// setInterval(superman, 5);



