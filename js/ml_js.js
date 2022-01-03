// Category showing
function category(cate) {
    // console.log(cate);
    if (cate=="organic") {
        document.getElementById('organic').style.display = 'block';
        document.getElementById('fishery').style.display = 'none';
        document.getElementById('content-main').style.display = 'none';
    }

    else if (cate="fishery") {
        document.getElementById('organic').style.display = 'none';
        document.getElementById('fishery').style.display = 'block';
        document.getElementById('content-main').style.display = 'none';
    }
}


// Check box selection (For Cart)
// function selectAll(main) {
//     var element = document.getElementsByName('check');
//     for(var i=0;i<element.length;i++) {
//       element[i].checked = main.checked; //set the state of checkboxes
//     }
// }

// Checkbox Select > Display SubTotal
// function displaySubTotal() {
    
// }

// function displayAllTotal() {

// }


// // // PLUS & MINUS Button
// // // ----------------------
// // // cite: https://www.youtube.com/watch?v=2purijiQrf4
// var plusButton = document.getElementsByClassName('plus-btn');
// var minusButton = document.getElementsByClassName('minus-btn');
//     // console.log(plusButton, minusButton)

// for (var i = 0; i < plusButton.length; i++) {
//     var button = plusButton[i];
//     button.addEventListener('click', function(event) {
//         var buttonClicked = event.target;
//             // console.log(buttonClicked);
//         var input = buttonClicked.parentElement.children[2];
//             // console.log(input); 
//         var inputValue = input.value;
//             // console.log(inputValue);
//         var newValue = parseInt(inputValue)+1;
//             // console.log(newValue);

//         var findID = buttonClicked.parentElement.parentElement.children[0].value;
//             console.log(findID);
//         //update quantity into database and show it
//         updateQty(newValue,findID);
//         input.value = newValue;
//     })
// }

// for (var i = 0; i < minusButton.length; i++) {
//     var button = minusButton[i];
//     button.addEventListener('click', function(event) {
//         var buttonClicked = event.target;
//             // console.log(buttonClicked);
//         var input = buttonClicked.parentElement.children[2];
//             // console.log(input);
//         var inputValue = input.value;
//             // console.log(inputValue);

//         // set condition to prevent quantity become negative
//         if (inputValue <= 1) {
//             input.setAttribute("disabled","disabled");
//         }
//         else if (inputValue > 1) {
//             var newValue = parseInt(inputValue)-1;
//                 // console.log(newValue);

//             var findID = buttonClicked.parentElement.parentElement.children[0].value;
//             console.log(findID);

//             //update quantity into database and show it
//             updateQty(newValue,findID);
//             input.value = newValue;
//         }
//     })
// }

// function updateQty(newValue, idValue) {
//     var xmlhttp = new XMLHttpRequest(); //no need refresh entire page, only a part
//     // xmlhttp.onreadystatechange = function() {
//     //     if (this.readyState == 4 && this.status == 200) {
            
//     //     }
//     // }

//     xmlhttp.open("GET", "updateQty.php?quantity=" + newValue + "&id=" + idValue, true);
//     xmlhttp.send();
// }

// function updateQty(newValue, idValue) {
//     var xmlhttp = new XMLHttpRequest(); //no need refresh entire page, only a part
//     // xmlhttp.onreadystatechange = function() {
//     //     if (this.readyState == 4 && this.status == 200) {
            
//     //     }
//     // }
//     // var idArray = document.getElementsByClassName('id');
//     // for (var i = 0; i < idArray.length; i++) {
//     //     var idParrent = idArray[i];
//     //     var idValue = idParrent.value;
//     // }
//     // var idParent = idArray[0];
//     // console.log(idParent);
//     // // var idValue = parseInt(idParent.value);
//     // var idValue = idParent.value;
//     // console.log(idValue);
//     xmlhttp.open("GET", "updateQty.php?quantity=" + newValue + "&id=" + idValue, true);
//     xmlhttp.send();
// }
