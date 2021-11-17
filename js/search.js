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
  var slides1 = document.getElementsByClassName("linha1");

  if (n > slides1.length) 
  {
    slideIndex1 = 1;
  }    
  if (n < 1) 
  {
    slideIndex1 = slides1.length;
  }
  for (i = 0; i < slides1.length; i++) 
  {
      slides1[i].style.display = "none";  
  }
  slides1[slideIndex1 - 1].style.display = "block";  
}

//cantor

var slideIndex2 = 1;
showSlides2(slideIndex2);

function plusSlides2(n) {
  showSlides2(slideIndex2 += n);
}

function currentSlide2(n) {
  showSlides2(slideIndex2 = n);
}

function showSlides2(n) {

  var i;
  var slides2 = document.getElementsByClassName("linha2");

  if (n > slides2.length) 
  {
    slideIndex2 = 1;
  }    
  if (n < 1) 
  {
    slideIndex2 = slides2.length;
  }
  for (i = 0; i < slides2.length; i++) 
  {
      slides2[i].style.display = "none";  
  }
  slides2[slideIndex2 - 1].style.display = "block";  
}

//albuns

var slideIndex3 = 1;
showSlides3(slideIndex3);

function plusSlides3(n) {
  showSlides3(slideIndex3 += n);
}

function currentSlide3(n) {
  showSlides3(slideIndex3 = n);
}

function showSlides3(n) {

  var i;
  var slides3 = document.getElementsByClassName("linha3");

  if (n > slides3.length) 
  {
    slideIndex3 = 1;
  }    
  if (n < 1) 
  {
    slideIndex2 = slides3.length;
  }
  for (i = 0; i < slides3.length; i++) 
  {
      slides3[i].style.display = "none";  
  }
  slides3[slideIndex3 - 1].style.display = "block";  
}