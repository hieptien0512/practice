/**
 * validate if any multiple choice is not checked any checkbox
 * @param index
 */
function validate(index) {
    let requiredCheckboxes = $('.list' + index + ' :checkbox[required]');
    requiredCheckboxes.change(function () {
        if (requiredCheckboxes.is(':checked')) {
            requiredCheckboxes.removeAttr('required');
        } else {
            requiredCheckboxes.attr('required', 'required');
        }
    });
}

