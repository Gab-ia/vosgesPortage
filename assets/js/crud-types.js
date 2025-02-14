'use strict';
const formCondition = document.querySelector('#addType');
const allDeleteButtons = document.querySelectorAll(".delete-button");
const formConditionUpdate = document.querySelector('#updateTypeForm');
const allUpdateButtons = document.querySelectorAll(".update-button");
const editConditionModal = document.getElementById('editType');

document.addEventListener('DOMContentLoaded', function (e) {


  Dropzone.options.addType = { // The camelized version of the ID of the form element

    // The configuration we've talked about above
    autoProcessQueue: false,
    uploadMultiple: false,
    parallelUploads: 100,
    maxFiles: 100,
  
    // The setting up of the dropzone
    init: function() {
      alert("ssd");
      var myDropzone = this;
  
      // First change the button to actually tell Dropzone to process the queue.
      this.element.querySelector("button[type=submit]").addEventListener("click", function(e) {
        // Make sure that the form isn't actually being sent.
        e.preventDefault();
        e.stopPropagation();
        myDropzone.processQueue();
      });
  
      // Listen to the sendingmultiple event. In this case, it's the sendingmultiple event instead
      // of the sending event because uploadMultiple is set to true.
      this.on("sendingmultiple", function() {
        // Gets triggered when the form is actually being sent.
        // Hide the success button or the complete form.
      });
      this.on("successmultiple", function(files, response) {
        // Gets triggered when the files have successfully been sent.
        // Redirect user or notify of success.
      });
      this.on("errormultiple", function(files, response) {
        // Gets triggered when there was an error sending the files.
        // Maybe show form again, and notify user of error
      });
    }
   
  }


  allDeleteButtons.forEach(deleteButton => {
    deleteButton.addEventListener("click", () => {
      deleteButtonF(deleteButton.dataset.text, deleteButton.dataset.id, "delete-type")
    });

  });
  (function () {
    // Form validation for Add new record
    if (formCondition) {
      const fv = FormValidation.formValidation(formCondition, {
        fields: {
          newType: {
            validators: {
              notEmpty: {
                message: 'Veuillez entrer une nouveau type '
              },
              stringLength: {
                min: 4,
                message: '4 caractères mininum '
              }
            },
          },
          icon: {
            validators: {
              notEmpty: {
                message: 'Veuillez choisir un fichier '
              },
                file: {
                    extension: 'svg',
                    type: 'image/svg+xml',
                    message: 'Sélectionnez un fichier svg ',
                },
            },
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
      document.getElementById("updateTypeText").placeholder = editButton.dataset.text;
      document.getElementById("updateTypeText").value = editButton.dataset.text;
      document.getElementById("hiddenTypeId").value = editButton.dataset.id;
    })
  });

  (function () {
    if (formConditionUpdate) {
      const fvUpdate = FormValidation.formValidation(formConditionUpdate, {
        fields: {
          updateTypeText: {
            validators: {
              notEmpty: {
                message: 'Veuillez entrer une nouveau type '
              },
              stringLength: {
                min: 4,
                message: '4 caractères mininum '
              }
            }
          },
          updateIcon: {
            validators: {
                file: {
                    extension: 'svg',
                    type: 'image/svg+xml',
                    message: 'Sélectionnez un fichier svg ',
                },
            },
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