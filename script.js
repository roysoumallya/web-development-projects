/* typing animation */

const typingWords = [

"Modern Digital Solutions",

"Creative Web Experiences",

"Professional IT Services"

];

let wordIndex = 0;
let charIndex = 0;

const typingElement =
document.getElementById("typing-text");


function typeWord(){

if(charIndex < typingWords[wordIndex].length){

typingElement.textContent +=
typingWords[wordIndex].charAt(charIndex);

charIndex++;

setTimeout(typeWord,70);

}

else{

setTimeout(deleteWord,1200);

}

}


function deleteWord(){

if(charIndex > 0){

typingElement.textContent =
typingWords[wordIndex].substring(0,charIndex-1);

charIndex--;

setTimeout(deleteWord,40);

}

else{

wordIndex++;

if(wordIndex >= typingWords.length){

wordIndex = 0;

}

setTimeout(typeWord,300);

}

}


document.addEventListener("DOMContentLoaded", function(){

typeWord();

});

// mobile menu

function toggleMenu(){

document.getElementById("menu").classList.toggle("show")

}



/* mobile dropdown */

document.querySelectorAll(".services-toggle")
.forEach(btn=>{

btn.addEventListener("click",function(e){

if(window.innerWidth <= 768){

e.preventDefault();

this.parentElement.classList.toggle("active");

}

});

});


// animated counter

const counters=document.querySelectorAll(".counter")

counters.forEach(counter=>{

counter.innerText="0"

const updateCounter=()=>{

const target=+counter.getAttribute("data-target")

const c=+counter.innerText

const increment=target/100

if(c<target){

counter.innerText=Math.ceil(c+increment)

setTimeout(updateCounter,20)

}else{

counter.innerText=target

}

}

updateCounter()

})



// smooth scroll

document.querySelectorAll("a").forEach(anchor=>{

anchor.addEventListener("click",function(e){

if(this.getAttribute("href").startsWith("#")){

e.preventDefault()

document.querySelector(this.getAttribute("href"))
.scrollIntoView({

behavior:"smooth"

})

}

})

})


const slides = document.querySelectorAll(".slide");

let index = 0;

function autoSlide(){

slides[index].classList.remove("active");

index = (index + 1) % slides.length;

slides[index].classList.add("active");

}

setInterval(autoSlide, 3000); // change every 3 seconds




/*Service Scroll in Home*/

/* SERVICES SLIDER */

const slider = document.getElementById("servicesSlider");

let position = 0;

const visibleCards = 4;   // number of cards visible

const gap = 20;



/* clone first cards for infinite loop */

function cloneCards(){

const cards = slider.children;

for(let i=0;i<visibleCards;i++){

let clone = cards[i].cloneNode(true);

slider.appendChild(clone);

}

}



cloneCards();



function getCardWidth(){

return slider.children[0].offsetWidth + gap;

}



function moveSlider(){

slider.style.transform =
`translateX(-${position * getCardWidth()}px)`;

}



/* auto slide */

function nextSlide(){

position++;



if(position >= slider.children.length - visibleCards){

position = 0;

slider.style.transition="none";

moveSlider();



setTimeout(()=>{

slider.style.transition="transform 0.5s ease";

},50);

}

else{

moveSlider();

}

}



/* buttons */

function scrollServices(step){

position += step;



if(position < 0){

position = slider.children.length - visibleCards - 1;

}



moveSlider();

}



/* auto start */

let autoMove = setInterval(nextSlide,3000);



/* pause on hover */

slider.addEventListener("mouseenter",()=>{

clearInterval(autoMove);

});


slider.addEventListener("mouseleave",()=>{

autoMove = setInterval(nextSlide,3000);

});



/*INDUSTRIES JS*/

function openTab(index){

const tabs = document.querySelectorAll(".tab");

const contents = document.querySelectorAll(".tab-content");


tabs.forEach(tab=>tab.classList.remove("active"));

contents.forEach(c=>c.classList.remove("active"));


tabs[index].classList.add("active");

contents[index].classList.add("active");

}


/*COUNTER JS*/


const countered = document.querySelectorAll(".counter");

let started = false;



function startCounting(){

if(started) return;



const section = document.querySelector(".stats-section");

const sectionTop = section.getBoundingClientRect().top;

const screenHeight = window.innerHeight;



if(sectionTop < screenHeight){

started = true;



countered.forEach(counter=>{

const target = +counter.dataset.target;

let count = 0;



const update = ()=>{

const increment = target / 120;



count += increment;



if(count < target){

counter.innerText = Math.floor(count);

requestAnimationFrame(update);

}

else{

counter.innerText = target;

}

};



update();

});

}

}



window.addEventListener("scroll", startCounting);



/*TESTIMONIALS JS*/


const track =
document.getElementById("testimonialTrack");

const cards =
document.querySelectorAll(".testimonial-card");

let tIndex = 0;



function updateSlide(){

track.style.transform =
`translateX(-${tIndex * 100}%)`;

}



function nextTestimonial(){

tIndex++;

if(tIndex >= cards.length){

tIndex = 0;

}

updateSlide();

}



function prevTestimonial(){

tIndex--;

if(tIndex < 0){

tIndex = cards.length - 1;

}

updateSlide();

}



/* auto slide */

setInterval(()=>{

nextTestimonial();

},4000);