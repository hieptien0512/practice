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

    const li = document.createElement('li');
    choice.innerHTML += createQuestionField(index).outerHTML + createDeleteChoiceButton(index).outerHTML;
    li.innerHTML += choice.outerHTML;
    return li;
}

/**
 * create delete choice button for new choice
 * @param index
 * @returns {HTMLDivElement}
 */
function createDeleteChoiceButton(index) {
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
    return deleteChoice;
}

/**
 * create question input for new choice
 * @param index
 * @returns {HTMLDivElement}
 */
function createQuestionField(index) {
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
    return questionChoice;
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

    card.innerHTML += createCardHeader().outerHTML + createCardBody().outerHTML;

    return card;
}

/**
 * create card body for card question
 * @returns {HTMLDivElement}
 */
function createCardBody() {
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
    return cardBody;
}

/**
 * create card header for card question
 * @returns {HTMLDivElement}
 */
function createCardHeader() {
    const buttonDelCard = document.createElement('button');
    buttonDelCard.setAttribute("type", "button");
    buttonDelCard.setAttribute("id", "delQuestion" + indexQuestion);
    buttonDelCard.setAttribute("class", "btn btn-danger btn-sm");
    buttonDelCard.setAttribute("onclick", "removeCard(" + indexQuestion + ")");
    buttonDelCard.appendChild(document.createTextNode("Delete"));

    const formCheck = document.createElement('div');
    formCheck.setAttribute("class", "form-check form-check-inline");
    formCheck.setAttribute("id", "radio" + indexQuestion);

    const multiCheck = document.createElement('input');
    multiCheck.setAttribute("class", "form-check-input ml-4");
    multiCheck.setAttribute("type", "radio");
    multiCheck.setAttribute("name", "question" + indexQuestion + "[]");
    multiCheck.setAttribute("id", "multiCheck" + indexQuestion);
    multiCheck.setAttribute("value", "0");
    multiCheck.setAttribute("checked", "checked");

    const labelMulti = document.createElement('label');
    labelMulti.setAttribute("class", "form-check-label");
    labelMulti.setAttribute("for", "multiCheck" + indexQuestion);
    labelMulti.appendChild(document.createTextNode("Multiple Choice"));

    const singleCheck = document.createElement('input');
    singleCheck.setAttribute("class", "form-check-input ml-4");
    singleCheck.setAttribute("type", "radio");
    singleCheck.setAttribute("name", "question" + indexQuestion + "[]");
    singleCheck.setAttribute("id", "single" + indexQuestion);
    singleCheck.setAttribute("value", "1");

    const labelSingle = document.createElement('label');
    labelSingle.setAttribute("class", "form-check-label");
    labelSingle.setAttribute("for", "single" + indexQuestion);
    labelSingle.appendChild(document.createTextNode("Single Choice"));

    formCheck.innerHTML += multiCheck.outerHTML + labelMulti.outerHTML + singleCheck.outerHTML + labelSingle.outerHTML;


    const cardHeader = document.createElement('div');
    cardHeader.setAttribute("class", "card-header");
    cardHeader.appendChild(document.createTextNode("Question "));

    cardHeader.innerHTML += buttonDelCard.outerHTML + formCheck.outerHTML;
    return cardHeader;
}

/**
 * append card question to cardlist
 **/
function addQuestionCard() {
    const cardHolder = formQuestion.querySelector('.cardList');
    cardHolder.appendChild(createCard());
}



