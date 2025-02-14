'use strict';
const formCollectionUpdate = document.querySelector('#updateCollectionForm');
const allDeleteButtons = document.querySelectorAll(".delete-button");
const allUpdateButtons = document.querySelectorAll(".update-button");
const editCollectionModal = document.getElementById('editCollection');

document.addEventListener('DOMContentLoaded', function (e) {
  allDeleteButtons.forEach(deleteButton => {
    deleteButton.addEventListener("click", () => {
      deleteButtonF(deleteButton.dataset.text, deleteButton.dataset.id, "delete-collection")
    });
  });
  
  allUpdateButtons.forEach(editButton => {
    editButton.addEventListener("click", () => {
      document.getElementById("updateCollectionText").placeholder = editButton.dataset.text;  
      document.getElementById("updateCollectionText").value = editButton.dataset.text;      
      document.getElementById("hiddenCollectionId").value = editButton.dataset.id;
      document.getElementById("optionTypeId-"+editButton.dataset.typeid).selected = "true";
      if (editButton.dataset.isprivate == "1") {
        document.getElementById("isPrivateUpdate").checked = true;
      } else {
        document.getElementById("isPrivateUpdate").checked = false;
      }
      
    })
  });
  (function () {
    // Form validation for Add new record
    if (formCollectionUpdate) {
      const fvUpdate = FormValidation.formValidation(formCollectionUpdate, {
        fields: {
          updateCollectionText: {
            validators: {
              notEmpty: {
                message: 'Veuillez entrer un nouveau nom '
              },
              stringLength: {
                min: 4,
                message: '4 caractères mininum '
              }
            }
          },
          updateCollectionType: {
            validators: {
              notEmpty: {
                message: 'Veuillez choisir un type '
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