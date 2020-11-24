let course_title = "Data Management";
let course_crn = 5824;
let course_section = "002";
let course_days = "M/W";
let course_time="8-9:30";
let course_building="CC";
let course_room = 101;

function generateClass(){
    for (i=0 ; i<60 ; i++){
        $(".classes_list tbody").append('<tr> <td>'+course_title+'</td>'
    +'<td id="s_name">'+course_crn+'</td>'
    +'<td id="s_lname">'+course_section+'</td>'
    +'<td id="s_email">'+course_days+'</td>'
    +'<td id="s_email">'+course_time+'</td>'
    +'<td id="s_email">'+course_building+'</td>'
    +'<td id="s_advisor">'+course_room+'</td>'+'</tr');
    }
}
generateClass()

