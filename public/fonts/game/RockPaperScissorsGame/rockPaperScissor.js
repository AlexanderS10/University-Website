let userScore=0;
let compScore=0;
let userScoreSpan=document.getElementById("user-score");
let compScoreSpan=document.getElementById("computer-score");
let scoreBoardDiv=document.querySelector(".score-board");
let resultP=document.querySelector(".result > p");
let rockDiv=document.getElementById("r");
let paperDiv=document.getElementById("p");
let scissorsDiv=document.getElementById("s");


function getComputerChoice(){
    const choices=['r','p','s'];
    let choicesRandom=Math.floor(Math.random() *3);
    return choices[choicesRandom];
}
getComputerChoice();

function toWord(letterChoice){
    if(letterChoice === "p"){
        return "Paper";
    }
    else if (letterChoice === "r"){
        return "Rock";
    }
    else{
        return "Scissors";
    }
}

function draw(userChoiceF, computerChoiceF){
    resultP.innerHTML= toWord(userChoiceF) + " equals " + toWord(computerChoiceF) + ". Draw!!!";
    let userChoiceDiv=document.getElementById(userChoiceF);
    userChoiceDiv.classList.add('gray-glow'); // using a variable
    setTimeout(function(){document.getElementById(userChoiceF).classList.remove('gray-glow')},350)
}
function wins(userChoiceF, computerChoiceF){
    userScore++;
    userScoreSpan.innerHTML=userScore;
    resultP.innerHTML= toWord(userChoiceF) + " beats " + toWord(computerChoiceF) + ". You win!!!";
    document.getElementById(userChoiceF).classList.add('green-glow');
    setTimeout(() =>document.getElementById(userChoiceF).classList.remove('green-glow'),350); // another way
}
function loses(userChoiceF, computerChoiceF){
    compScore++;
    compScoreSpan.innerHTML=compScore;
    resultP.innerHTML= `${toWord(userChoiceF)} loses to ${toWord(computerChoiceF)}. You lose!!!`;
    document.getElementById(userChoiceF).classList.add('red-glow'); //normally
    setTimeout(function(){document.getElementById(userChoiceF).classList.remove('red-glow')},350);
}

function game(userChoice){
    let computerChoice=getComputerChoice();
    let res=userChoice+computerChoice;
    if (res=="rr" || res=="ss"||res=="pp"){
        draw(userChoice, computerChoice);
    }
    else if (res=="rs" || res=="sp" || res=="pr"){
        wins(userChoice, computerChoice);
    }
    //computer wins
    else if (res=="rp" || res=="ps" || res=="sr"){
        loses(userChoice, computerChoice);
    }
}


function main(){
    rockDiv.addEventListener('click', function(){
        game("r");
    })
    paperDiv.addEventListener('click', function(){
        game("p");
    })
    scissorsDiv.addEventListener('click', function(){
        game("s");
    })
}

main();