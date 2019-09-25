const addButton = document.querySelector('#addButton');
const selectDisplay = document.querySelector('#display');
const calculateButton = document.querySelector('#calculateButton');

let electronics = [];

addButton.addEventListener('click', () => {
    const name = document.querySelector('.name-input input');
    const quantity = document.querySelector('.quantity-watt input:first-of-type');
    const watt = document.querySelector('.quantity-watt input:last-of-type');

    electronics.push([name.value, quantity.value, watt.value]);

    selectDisplay.innerHTML = "";

    electronics.forEach(element => {
        let span = document.createElement('span');
        span.innerHTML = element[0] + " " + "(" + element[1] + ")";
        span.classList.add('bg-tone-blue');
        selectDisplay.appendChild(span);
    });
    
});

calculateButton.addEventListener('click', () => {
    fetch()
});
