let array = [];
let arrayPath = [];
let count = 0;
const formulario = document.querySelector('.inputFiles');
const divImage = document.querySelector('.slideshow-container');
const divDots = document.querySelector('.dots');
let countDot = document.querySelector('.countDot').id;
let dotcount = 1;

function readURL(input) {
    count++;
    array.push(input.files[0]);

    input.style.display = 'none';

    const inputTwo = `<input type="file" class="inputfile" id="file${count}" name="images[]" onchange="readURL(this);" />`;
    inputTwo.files = input.files[0];

    formulario.insertAdjacentHTML('beforeend', inputTwo);

    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            divImage.insertAdjacentHTML('beforeend', `<div class="mySlides fade">
                                                        <img src="${e.target.result}" id="blah${count}" class="image img">
                                                        </div>`);
            divDots.insertAdjacentHTML('beforeend', `<span class="dot" onclick="currentSlide(${countDot++})"></span>`);
        };
        reader.readAsDataURL(input.files[0]);
    }
}
