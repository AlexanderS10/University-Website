let name = "Namneek";
let lName ="Kaur";
let s_id = 123213;
let s_email = "sjkfhkjsd@oldwestbury.edu";
let s_advisor="Ashok";

function addStudent(){
    $('.student_list').append('<tr> <td id="s_id">'+s_id+'</td>'
    +'<td id="s_name"><a>'+name+'</a></td>'
    +'<td id="s_lname">'+lName+'</td>'
    +'<td id="s_email">'+s_email+'</td>'
    +'<td id="s_advisor">'+s_advisor+'</td>'+'</tr');
}