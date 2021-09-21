var slideIndex = 1;
showSlides(slideIndex);

function plusSlides(n) {
  showSlides(slideIndex += n);
}

function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {

  var i;
  var slides = document.getElementsByClassName("linha");
  
  if (n > slides.length) 
  {
    slideIndex = 1;
  }    
  if (n < 1) 
  {
    slideIndex = slides.length;
  }
  for (i = 0; i < slides.length; i++) 
  {
      slides[i].style.display = "none";  
  }
  slides[slideIndex - 1].style.display = "block";  
}

//bandas

var slideIndex1 = 1;
showSlides1(slideIndex1);

function plusSlides1(n) {
  showSlides1(slideIndex1 += n);
}

function currentSlide1(n) {
  showSlides1(slideIndex1 = n);
}

function showSlides1(n) {

  var i;
  var slides = document.getElementsByClassName("linha1");
  
  if (n > slides.length) 
  {
    slideIndex1 = 1;
  }    
  if (n < 1) 
  {
    slideIndex1 = slides.length;
  }
  for (i = 0; i < slides.length; i++) 
  {
      slides[i].style.display = "none";  
  }
  slides[slideIndex1-1].style.display = "block";  
}