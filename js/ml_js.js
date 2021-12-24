function category(cate) {
    console.log(cate);
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
function selectAll(main) {
    var element = document.getElementsByName('check');
    for(var i=0;i<element.length;i++) {
      element[i].checked = main.checked; //set the state of checkbox or to read it's state to see whether it is already checked or not
    }
  }


// ADD MINUS Button
// -----------------
var plusButton = document.getElementsByClassName('plus-btn');
var minusButton = document.getElementsByClassName('minus-btn');
// console.log(plusButton, minusButton)

for (var i = 0; i < plusButton.length; i++) {
    var button = plusButton[i];
    button.addEventListener('click', function(event) {

        var buttonClicked = event.target;
        // console.log(buttonClicked);
        var input = buttonClicked.parentElement.children[2];
        // console.log(input);
        var inputValue = input.value;
        // console.log(inputValue);
        var newValue = parseInt(inputValue)+1;
        // console.log(newValue);
        input.value = newValue;
    })
}

for (var i = 0; i < minusButton.length; i++) {
    var button = minusButton[i];
    button.addEventListener('click', function(event) {

        var buttonClicked = event.target;
        // console.log(buttonClicked);
        var input = buttonClicked.parentElement.children[2];
        // console.log(input);
        var inputValue = input.value;
        // console.log(inputValue);
        if (inputValue <= 1) {
            input.setAttribute("disabled","disabled");
        }
        else if (inputValue > 1) {
            var newValue = parseInt(inputValue)-1;
            // console.log(newValue);
            input.value = newValue;
        }
    })
}




