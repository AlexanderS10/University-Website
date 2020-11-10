let courseName="System Design and Implementation";
let courseInfo="CS 5910";
let courseSection="Section 001";
let courseTimeFrame="August 31, 2020 - December 22, 2020";
let courseTime="Tue, Thu 03:50 PM - 05:20PM"
let courseSetting="REMOTE";

function addTable(){
    $('#my_classes').append('<table class="classes">' 
    +'<tr id="course_title"><td> <h4>'+courseName+'</h4></td></tr>'
    +'<tr id="course_info"><td><h5>'+courseInfo+' / '+courseSection+'</h5></td></tr>'
    +'<tr id=time_frame><td><h5>'+courseTimeFrame+'</h5></td></tr>'
    +'<tr id=course_time><td><h5>'+courseTime+'</h5></td></tr>'
    +'<tr id=course_setting><td><h5>'+courseSetting+'</h5></td></tr>'
    +'</table>');

}