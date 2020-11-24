let courseName="System Design and Implementation";
let courseInfo="CS 5910";
let courseSection="Section 001";
let courseTimeFrame="August 31, 2020 - December 22, 2020";
let courseTime="Tue, Thu 03:50 PM - 05:20PM"
let courseSetting="REMOTE";

function addTable(){
    $('#my_classes').append('<table class="classes">' 
    +'<tr id="course_title"><td><a>'+courseName+'</a></td></tr>'
    +'<tr id="course_info"><td>'+courseInfo+' / '+courseSection+'</td></tr>'
    +'<tr id=time_frame><td>'+courseTimeFrame+'</td></tr>'
    +'<tr id=course_time><td>'+courseTime+'</td></tr>'
    +'<tr id=course_setting><td>'+courseSetting+'</td></tr>'
    +'</table>');
}

let slideIndex=0;
showSlides();

function showSlides(){
    let i;
    let slides = $(".my_slides");
    for (i=0; i<slides.length; i++){
        slides[i].style.display="none";
    }
    slideIndex++;
    if(slideIndex>slides.length){
        slideIndex=1;
    }
    slides[slideIndex-1].style.display="block";
    setTimeout(showSlides, 3000);
}