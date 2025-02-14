'use strict';
const formCondition = document.querySelector('#addCondition');
const formConditionUpdate = document.querySelector('#updateConditionForm');
const allDeleteButtons = document.querySelectorAll(".delete-button");
const allUpdateButtons = document.querySelectorAll(".update-button");
const editConditionModal = document.getElementById('editCondition');


document.addEventListener('DOMContentLoaded', function (e) {

allDeleteButtons.forEach(deleteButton => {
  deleteButton.addEventListener("click", () => {
    deleteButtonF(deleteButton.dataset.text, deleteButton.dataset.id, "delete-condition")
  });
});

  (function () {
    // Form validation for Add new record
    if (formCondition) {
      const fv = FormValidation.formValidation(formCondition, {
        fields: {
            newCondition: {
            validators: {
              notEmpty: {
                message: 'Veuillez entrer une nouvelle de condition '
              },
              stringLength: {
                min: 4,
                message: '4 caractères mininum '
              }
            }
          },
        },
        plugins: {
          trigger: new FormValidation.plugins.Trigger(),
          bootstrap5: new FormValidation.plugins.Bootstrap5({
            eleValidClass: '',
            rowSelector: '.mb-3'
          }),
          submitButton: new FormValidation.plugins.SubmitButton(),
          defaultSubmit: new FormValidation.plugins.DefaultSubmit(),
        }
      });
    }
  })();


  allUpdateButtons.forEach(editButton => {
    editButton.addEventListener("click", () => {
      document.getElementById("updateConditionText").placeholder = editButton.dataset.text;
      document.getElementById("updateConditionText").value = editButton.dataset.text;
      document.getElementById("hiddenConditionId").value = editButton.dataset.id;
    })
  });

  (function () {
    // Form validation for Add new record
    if (formConditionUpdate) {
      const fvUpdate = FormValidation.formValidation(formConditionUpdate, {
        fields: {
          updateConditionText: {
            validators: {
              notEmpty: {
                message: 'Veuillez entrer une nouveau nom '
              },
              stringLength: {
                min: 4,
                message: '4 caractères mininum '
              }
            }
          },
        },
        plugins: {
          trigger: new FormValidation.plugins.Trigger(),
          bootstrap5: new FormValidation.plugins.Bootstrap5({
            eleValidClass: '',
            rowSelector: '.mb-3'
          }),
          submitButton: new FormValidation.plugins.SubmitButton(),
          defaultSubmit: new FormValidation.plugins.DefaultSubmit(),
        }
      });
    }
  })();

  
});