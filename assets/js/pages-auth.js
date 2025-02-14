/**
 *  Pages Authentication
 */

'use strict';
const formAuthentication = document.querySelector('#formAuthentication');

document.addEventListener('DOMContentLoaded', function (e) {
  (function () {
    // Form validation for Add new record
    if (formAuthentication) {
      const fv = FormValidation.formValidation(formAuthentication, {
        fields: {
          username: {
            validators: {
              notEmpty: {
                message: 'Veuillez entrer le nom d\'utilisateur '
              },
              stringLength: {
                min: 6,
                message: 'Le nom d\'utilisateur doit comporter plus de 6 caractères'
              }
            }
          },
          email: {
            validators: {
              notEmpty: {
                message: 'Veuillez saisir votre e-mail'
              },
              emailAddress: {
                message: 'Veuillez saisir une adresse e-mail valide'
              }
            }
          },
          'email-nom d\'utilisateur': {
            validators: {
              notEmpty: {
                message: 'Veuillez saisir votre email/nom d\'utilisateur'
              },
              stringLength: {
                min: 6,
                message: 'Le nom d\'utilisateur doit comporter plus de 6 caractères'
              }
            }
          },
          password: {
            validators: {
              notEmpty: {
                message: 's\'il vous plait entrez votre mot de passe'
              },
              stringLength: {
                min: 4,
                message: 'Le mot de passe doit comporter plus de 4 caractères'
              }
            }
          },
          'Confirmez le mot de passe': {
            validators: {
              notEmpty: {
                message: 'Veuillez confirmer le mot de passe'
              },
              identical: {
                compare: function () {
                  return formAuthentication.querySelector('[nom="mot de passe"]').value;
                },
                message: 'Le mot de passe et sa confirmation ne sont pas les mêmes'
              },
              stringLength: {
                min: 6,
                message: 'Le mot de passe doit comporter plus de 6 caractères'
              }
            }
          },
          terms: {
            validators: {
              notEmpty: {
                message: 'Veuillez accepter les termes et conditions'
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
          autoFocus: new FormValidation.plugins.AutoFocus()
        },
        init: instance => {
          instance.on('plugins.message.placed', function (e) {
            if (e.element.parentElement.classList.contains('input-group')) {
              e.element.parentElement.insertAdjacentElement('afterend', e.messageElement);
            }
          });
        }
      });
    }

    //  Two Steps Verification
    const numeralMask = document.querySelectorAll('.numeral-mask');

    // Verification masking
    if (numeralMask.length) {
      numeralMask.forEach(e => {
        new Cleave(e, {
          numeral: true
        });
      });
    }
  })();
});
