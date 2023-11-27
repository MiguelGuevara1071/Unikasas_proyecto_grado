let array = [];
let arrayPath = [];
let count = 0;
const formulario = document.querySelector('.inputFiles');
const divImage = document.querySelector('.slideshow-container');
const divDots = document.querySelector('.dots');
let dotcount = 2;

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
            $('#blah')
                .attr('src', e.target.result);
                arrayPath.push(e.target.result);
        };
        reader.readAsDataURL(input.files[0]);
    }
    insertImage(arrayPath[arrayPath.length - 1]);
}

function insertImage (data) {
    if(array.length > 1) {

        const img = `
            <div class="mySlides fade">
                <img src="${data}" id="blah${count}" class="image img">
            </div>
        `
        const dot = `<span class="dot" onclick="currentSlide(${dotcount++})"></span>`;

        divImage.insertAdjacentHTML('beforeend', img);
        divDots.insertAdjacentHTML('beforeend', dot);
    }
}

function removeImage () {
}
