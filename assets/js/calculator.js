let quantities = document.getElementsByClassName('quantities');
quantities = Array.from(quantities);
let arrayQuantities = [];

for (let quantity of quantities) {
    arrayQuantities.push(parseInt(quantity.innerHTML))
}

const calculator = document.getElementById('calculate');
let totaux = document.getElementsByClassName('total')

calculator.onclick = () => {
    let multiplicator = document.getElementById('multiplicatorInput').value;
    arrayQuantities.forEach((value, index) => {
        arrayQuantities[index] *= multiplicator;
    });

    for(let i=0; i < arrayQuantities.length; i++)
    {
        totaux[i].innerHTML = arrayQuantities[i];
    }
    arrayQuantities.forEach((value, index) => {
        arrayQuantities[index] /= multiplicator;
    });
}
