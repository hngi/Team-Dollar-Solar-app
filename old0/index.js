const addButton = document.querySelector('#addButton');
const selectDisplay = document.querySelector('#display');
const calculateButton = document.querySelector('#calculateButton');
const itemDisplay = document.querySelector('#item-display');
const toolTip = document.querySelector('#item-display .tooltiptext');
const displayModal = document.querySelector('.display-modal');
const display2 = document.querySelector('.display2');

let electronics = [];

addButton.addEventListener('click', () => {
	const name = document.querySelector('.name-input input');
	const quantity = document.querySelector('.quantity-watt input:nth-child(1)');
	const watt = document.querySelector('.quantity-watt input:nth-child(2)');
	const days = document.querySelector('.quantity-watt input:nth-child(3)');
	const itemDisplaySpan = document.querySelector('#item-display > span:nth-child(2)');


	if(name.value != "" && quantity.value != "" && watt.value != ""){
		electronics.push([name.value, quantity.value, watt.value, days.value]);

		selectDisplay.value = "";
		name.value = "";
		quantity.value = "";
		watt.value = "";
		days.value = "";

		electronics.forEach(item => {
			let div = document.createElement('div');
			div.innerHTML = item[0] + " " + "(" + item[1] + ")";
			div.classList.add('bg-tone-blue');
			selectDisplay.appendChild(div);
		});

		itemDisplaySpan.innerText = electronics.length;
	}else{ 
	    alert("fields must not be empty");
	}

	selectDisplay.classList.replace('show', 'hidden');

	toolTip.classList.replace('hidden', 'show');
	setTimeout(() => {
		toolTip.classList.replace('show', 'hidden');
	}, 1000);

});

calculateButton.addEventListener('click',() => {

	selectDisplay.classList.replace('show', 'hidden');


	const productArray = [];
	let sum = 0;
	let sumDays = 0;
	electronics.forEach(item => {
		let product = item[1] * item[2];
		productArray.push(product);

		if(item[3] > sumDays){
			sumDays += item[3];
		}
	});

	for (let i = 0; i < productArray.length; i++) {
		sum += productArray[i];
	}

	let val = document.querySelector('.val');
	let val1 = document.querySelector('.val1');
	let val2 = document.querySelector('.val2');

	val.innerText = ((sum / 1000) * 24).toFixed(2) + "kWh Per day";
	val1.innerText = ((sum / 1000) * 24 * 7).toFixed(2) + "kWh Per Week";
	val2.innerText = ((sum / 1000) * 24 * 30).toFixed(2) + "kWh Per Month";

	display2.classList.replace('hidden', 'shown');
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

});

itemDisplay.addEventListener('click', () => {
	if (selectDisplay.className == 'hidden'){
		selectDisplay.classList.replace('hidden', 'show');
	}else{
		selectDisplay.classList.replace('show', 'hidden');
	}
});

display2.addEventListener('click', () => {
	display2.classList.replace('shown', 'hidden');
});