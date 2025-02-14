'use strict';
const formCountry = document.querySelector('#addCountry');
const formCountryUpdate = document.querySelector('#updateCountryForm');
const allDeleteButtons = document.querySelectorAll(".delete-button");
const allUpdateButtons = document.querySelectorAll(".update-button");
const editCountryModal = document.getElementById('editCountry');

document.addEventListener('DOMContentLoaded', function (e) {
  allDeleteButtons.forEach(deleteButton => {
    deleteButton.addEventListener("click", () => {
      deleteButtonF(deleteButton.dataset.text, deleteButton.dataset.id, "delete-country")
    });
  });
  (function () {
    // Form validation for Add new record
    if (formCountry) {
      const fv = FormValidation.formValidation(formCountry, {
        fields: {
          country_name: {
            validators: {
              notEmpty: {
                message: 'Veuillez entrer un nouveau pays '
              },
              stringLength: {
                min: 4,
                message: '4 caractères mininum '
              }
            }
          },
          iso_code: {
            validators: {
              notEmpty: {
                message: 'Veuillez saisir un code ISO '
              },
              stringLength: {
                min: 2,
                max: 5,
                message: 'un code iso comprend entre 2 et 5 caractères '
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
      document.getElementById("updateCountryText").placeholder = editButton.dataset.text;
      document.getElementById("updateCodeText").placeholder = editButton.dataset.text2;
      document.getElementById("updateCountryText").value = editButton.dataset.text;
      document.getElementById("updateCodeText").value = editButton.dataset.text2;
      document.getElementById("hiddenCountryId").value = editButton.dataset.id;
    })
  });
  (function () {
    // Form validation for Add new record
    if (formCountryUpdate) {
      const fvUpdate = FormValidation.formValidation(formCountryUpdate, {
        fields: {
          updateCountryText: {
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
          updateCodeText: {
            validators: {
              notEmpty: {
                message: 'Veuillez saisir un code ISO '
              },
              stringLength: {
                min: 2,
                max: 5,
                message: 'un code iso comprend entre 2 et 5 caractères '
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