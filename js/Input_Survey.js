const formQuestion = document.querySelector('.formSurvey')
let indexChoice = 1;
let indexQuestion = 1;

/**
 * Create li contain choice input and delete li button
 * @param index int: id of each element
 **/
function createLi(index) {
    const choice = document.createElement('div');
    choice.setAttribute("class", "row");
    choice.setAttribute("id", "choice" + indexChoice);

    const questionChoice = document.createElement('div');
    questionChoice.setAttribute("class", "form-group col-sm-11");
    questionChoice.setAttribute("id", "questionChoice" + indexChoice);
    questionChoice.setAttribute("name", "questionChoice" + indexChoice);

    const inputChoice = document.createElement('input');
    inputChoice.setAttribute("type", "text");
    inputChoice.setAttribute("class", "form-control form-control-sm");
    inputChoice.setAttribute("id", "question" + index + "[]");
    inputChoice.setAttribute("name", "question" + index + "[]");
    inputChoice.setAttribute("placeholder", "Choice");
    inputChoice.setAttribute("required", "");
    inputChoice.required = true;

    questionChoice.innerHTML += inputChoice.outerHTML;

    const deleteChoice = document.createElement('div');
    deleteChoice.setAttribute("class", "form-group col-sm-1");
    deleteChoice.setAttribute("id", "deleteChoice" + indexChoice);

    const delBtn = document.createElement('button');
    delBtn.setAttribute("type", "button");
    delBtn.setAttribute("id", "delBtn" + indexChoice);
    delBtn.setAttribute("class", "btn btn-danger btn-sm");
    delBtn.setAttribute("onclick", "removeChoice(" + indexChoice + "," + index + ")");
    delBtn.appendChild(document.createTextNode("X"));

    deleteChoice.innerHTML += delBtn.outerHTML;

    const li = document.createElement('li');
    choice.innerHTML += questionChoice.outerHTML + deleteChoice.outerHTML;
    li.innerHTML += choice.outerHTML;
    return li;
}

/**
 * Append li of choice in to ul list
 * @param index int: id of each element
 **/
function addChoice(index) {
    indexChoice++;

    const divList = document.querySelector('.listHolder' + index);

    const ul = divList.querySelector('.list' + index);
    ul.appendChild(createLi(index));
    return ul;
}

/**
 * Remove choice from question card
 * @param index int: id of each element
 * @param indexQuestion int: id of each question card
 **/
function removeChoice(index, indexQuestion) {
    let list = formQuestion.querySelector('.list' + indexQuestion);
    let li = list.childElementCount;
    if (li > 2) {
        let choice = document.getElementById('choice' + index);
        choice.parentElement.remove();
    } else {
        alert('Can not delete all choice of a question');
    }

}

/**
 * remove question card from form post
 * @param index int: id of each element
 **/
function removeCard(index) {
    let card = document.getElementById('questionCard' + index);
    card.remove();
}

/**
 * create question card
 **/
function createCard() {
    indexQuestion++;
    indexChoice++;

    const card = document.createElement('div');
    card.setAttribute("class", "card mt-2");
    card.setAttribute("id", "questionCard" + indexQuestion);

    const buttonDelCard = document.createElement('button');
    buttonDelCard.setAttribute("type", "button");
    buttonDelCard.setAttribute("id", "delQuestion" + indexQuestion);
    buttonDelCard.setAttribute("class", "btn btn-danger btn-sm");
    buttonDelCard.setAttribute("onclick", "removeCard(" + indexQuestion + ")");
    buttonDelCard.appendChild(document.createTextNode("Delete"));

    const cardHeader = document.createElement('div');
    cardHeader.setAttribute("class", "card-header");
    cardHeader.appendChild(document.createTextNode("Question "));

    cardHeader.innerHTML += buttonDelCard.outerHTML;

    const cardBody = document.createElement('div');
    cardBody.setAttribute("class", "card-body");

    const li = document.createElement('li');

    const divQuestion = document.createElement('div');
    divQuestion.setAttribute("class", "form-group mt-2");

    const inputQuestion = document.createElement('input');
    inputQuestion.setAttribute("type", "text");
    inputQuestion.setAttribute("id", "question" + indexQuestion + "[]");
    inputQuestion.setAttribute("name", "question" + indexQuestion + "[]");
    inputQuestion.setAttribute("placeholder", "Question ?");
    inputQuestion.setAttribute("class", "form-control");
    inputQuestion.setAttribute("required", "");
    inputQuestion.required = true;

    const buttonAddChoice = document.createElement('button');
    buttonAddChoice.setAttribute("type", "button");
    buttonAddChoice.setAttribute("id", "addChoiceBtn" + indexQuestion);
    buttonAddChoice.setAttribute("class", "btn btn-success btn-sm");
    buttonAddChoice.setAttribute("style", "float: right;");
    buttonAddChoice.setAttribute("onclick", "addChoice(" + indexQuestion + ")");
    buttonAddChoice.appendChild(document.createTextNode("More Choice"));


    divQuestion.innerHTML += inputQuestion.outerHTML;

    li.innerHTML += divQuestion.outerHTML;

    const ul = document.createElement('ul');
    ul.setAttribute("class", "list" + indexQuestion);
    ul.innerHTML += li.outerHTML + createLi(indexQuestion).outerHTML;


    const listHolder = document.createElement('div');
    listHolder.setAttribute("class", "listHolder" + indexQuestion);

    listHolder.innerHTML += ul.outerHTML + buttonAddChoice.outerHTML;

    cardBody.innerHTML += listHolder.outerHTML;

    card.innerHTML += cardHeader.outerHTML + cardBody.outerHTML;

    return card;
}

/**
 * append card to cardlist
 **/
function addQuestionCard() {
    const cardHolder = formQuestion.querySelector('.cardList');
    cardHolder.appendChild(createCard());
}


// /**
//  * onclick addQuestionBtn will create new car for in put new question
//  **/
// const cardHolder = document.querySelector('.cardHolder');
// const addQuestionBtn = document.querySelector('#addQuestionButton');
//
// addQuestionBtn.addEventListener('click', () =>{
//     const formSurvey = cardHolder.querySelector('.formSurvey');
//     const card = cardHolder.querySelector('.card');
//     const div = document.createElement('div');
//     div.className = "container";
//     div.innerHTML += card.outerHTML;
//     formSurvey.appendChild(div);
//
// });
