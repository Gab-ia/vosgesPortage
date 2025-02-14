'use strict';
const formVille= document.querySelector('#ville_nom');
const formVilleUpdate = document.querySelector('#updateVilleForm');
const allDeleteButtons = document.querySelectorAll(".delete-button");
const allUpdateButtons = document.querySelectorAll(".update-button");
const editVilleModal = document.getElementById('editVille');

document.addEventListener('DOMContentLoaded', function (e) {

allDeleteButtons.forEach(deleteButton => {
  deleteButton.addEventListener("click", () => {
    deleteButtonF(deleteButton.dataset.text, deleteButton.dataset.id, "delete-ville")
  });
});

  (function () {
    // Ajout d'une nouvelle Zone
    if (formVille) {
      const fv = FormValidation.formValidation(formVille, {
        fields: {
            ville_nom: {
            validators: {
              notEmpty: {
                message: 'Veuillez entrer une nouvelle zone '
              },
              stringLength: {
                min: 4,
                message: '4 caractères mininum '
              }
            }
          },
          ordre_priorite: {
            validators: {
              notEmpty: {
                message: 'Veuillez entrer un nombre entre 1 et 200 '
              },
              stringLength: {
                min: 1,
                max: 3,
                message: 'Veuillez entrer un nombre entre 1 et 200 '
              }
            }
          }
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
      document.getElementById("updateVilleText").placeholder = editButton.dataset.text;
      document.getElementById("updateVilleText").value = editButton.dataset.text;
      document.getElementById("hiddenVilleId").value = editButton.dataset.id;
      document.getElementById("updateOrdrePriorite").value = editButton.dataset.priority; 
      document.getElementById("updateLatitude").value = editButton.dataset.latitude; 
      document.getElementById("updateLongitude").value = editButton.dataset.longitude;
      document.getElementById("update_ville_liste").checked = editButton.dataset.liste === "1";
      document.getElementById("update_ville_carte").checked = editButton.dataset.carte === "1"; 
    })
  });

  (function () {
    // Modification d'une nouvelle Zone
    if (formVilleUpdate) {
      const fvUpdate = FormValidation.formValidation(formVilleUpdate, {
        fields: {
          updateVilleText: {
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