'use strict';
const formCollectionAdd = document.querySelector('#addCollectionForm');
const formCollectionEdit = document.querySelector('#editCollectionForm');
const allRadioIcons = document.querySelectorAll('.form-check-new');
const allRadioIconsEdit = document.querySelectorAll('.form-check-edit');
const allDeleteButtons = document.querySelectorAll(".delete-button");
const allUpdateButtons = document.querySelectorAll(".update-button");

document.addEventListener('DOMContentLoaded', function (e) {

  allUpdateButtons.forEach(editButton => {
    editButton.addEventListener("click", () => {
      document.getElementById("editCollectionName").placeholder = editButton.dataset.text;  
      document.getElementById("editCollectionName").value = editButton.dataset.text;      
      document.getElementById("hiddenCollectionId").value = editButton.dataset.id;
      document.getElementById("iconEdit-"+editButton.dataset.typeid).checked = true;

      if (editButton.dataset.isprivate == "1") {
        document.getElementById("isPrivateEdit").checked = true;
      } else {
        document.getElementById("isPrivateEdit").checked = false;
      }

      const selectedTypes = document.querySelectorAll(".customChecked");
      selectedTypes.forEach(type => {
        type.classList.remove("customChecked");
      });

      document.getElementById("form-check-"+editButton.dataset.typeid).classList.add("customChecked");
      if (editButton.dataset.isprivate == "1") {
        document.getElementById("isPrivateUpdate").checked = true;
      } else {
        document.getElementById("isPrivateUpdate").checked = false;
      }
      
    })
  });

  allRadioIcons.forEach(radioButton => {
    radioButton.addEventListener("click", () => {
      allRadioIcons.forEach(cleanRadio => {
        cleanRadio.classList.remove("customChecked");
      })
      radioButton.classList.add("customChecked");
    });
  });

  allRadioIconsEdit.forEach(radioButton => {
    radioButton.addEventListener("click", () => {
      allRadioIconsEdit.forEach(cleanRadio => {
        cleanRadio.classList.remove("customChecked");
      })
      radioButton.classList.add("customChecked");
    });
  });

  allDeleteButtons.forEach(deleteButton => {
    deleteButton.addEventListener("click", () => {
      deleteButtonF(deleteButton.dataset.text, deleteButton.dataset.id, "/admin/my-collections-delete")
    });
  });




  (function () {
    // Form validation for Add new record
    if (formCollectionAdd) {
      const fvUpdate = FormValidation.formValidation(formCollectionAdd, {
        fields: {
          newCollectionName: {
            validators: {
              notEmpty: {
                message: 'Veuillez entrer un nouveau nom '
              },
              stringLength: {
                min: 10,
                max: 100,
                message: '10 caractères mininum et 100 max '
              }
            }
          },
          newCollectionTypeId: {
            validators: {
              notEmpty: {
                message: 'Putain de message !!'
              }
            }
          },
        },
        plugins: {
          trigger: new FormValidation.plugins.Trigger(),
          bootstrap5: new FormValidation.plugins.Bootstrap5({
            eleValidClass: '',
            rowSelector: '.errorForm'
          }),
          submitButton: new FormValidation.plugins.SubmitButton(),
          defaultSubmit: new FormValidation.plugins.DefaultSubmit(),
        }
      });
    }
  })();

  (function () {
    // Form validation for Add new record
    if (formCollectionEdit) {
      const fvUpdate = FormValidation.formValidation(formCollectionEdit, {
        fields: {
          editCollectionName: {
            validators: {
              notEmpty: {
                message: 'Veuillez entrer un nouveau nom '
              },
              stringLength: {
                min: 10,
                max:100,
                message: 'Veuillez saisir entre 10 et 100 caractères '
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

