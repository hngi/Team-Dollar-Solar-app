const addButton = document.querySelector('#addButton');
const selectDisplay = document.querySelector('#display');
const calculateButton = document.querySelector('#calculateButton');

let electronics = [];

addButton.addEventListener('click', () => {
	const name = document.querySelector('.name-input input');
	const quantity = document.querySelector('.quantity-watt input:first-of-type');
	const watt = document.querySelector('.quantity-watt input:last-of-type');

        if(name.value != "" && quantity.value != "" && watt.value != ""){
	    electronics.push([name.value, quantity.value, watt.value]);
            selectDisplay.innerHTML = "";
	    name.innerHTML = "";
	    quantity.innerHTML = "";
	    watt.innerHTML = "";

	    electronics.forEach(item => {
		let span = document.createElement('span');
		span.innerHTML = item[0] + " " + "(" + item[1] + ")";
		span.classList.add('bg-tone-blue');
		selectDisplay.appendChild(span);
	    });
        }else{ 
            alert("fields must not be empty");
        }

	
   
	
});

<<<<<<< HEAD
calculateButton.addEventListener('click', () => {
    fetch()
    alert("<?php echo "Hello"; ?>")
=======
calculateButton.addEventListener('click',() => {

	const productArray = [];
	let sum = 0;
	electronics.forEach(item => {
		let product = item[1] * item[2];
		productArray.push(product);
	});

	for (let i = 0; i < productArray.length; i++) {
		sum += productArray[i];
	}

	alert((sum / 1000) * 24 + "kWh Per day");
	alert((sum / 1000) * 24 * 7 + "kWh Per Week");
	alert((sum / 1000) * 24 * 30 + "kWh Per Month");
	
	// var params = typeof electronics == 'string' ? electronics : Object.keys(electronics).map(
	// 	function (k) { return encodeURIComponent(k) + '=' + encodeURIComponent(electronics[k]) }
	// 	).join('&');
			
	// 	var xhr = new XMLHttpRequest();
	// xhr.open('POST', "database/validate.php");
	// xhr.onreadystatechange = function () {
	// 	if (xhr.readyState > 3 && xhr.status == 200) {
	// 		console.log(xhr.response);
	// 	}
	// };
	// xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	// xhr.send(params);	
>>>>>>> 602236a349a7b2210eb14bc7bee6418d41b5ca45
});
