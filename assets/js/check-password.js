/**
 * App User View - Security


'use strict';

(function () {
  const formChangePass = document.querySelector('#changePassword');

  // Form validation for Change password
  if (formChangePass) {
    const fv2 = FormValidation.formValidation(formChangePass, {
      fields: {
        newPassword: {
          validators: {
            notEmpty: {
              message: 'Saisissez un nouveau mot de passe'
            },
            stringLength: {
              min: 8,
              message: '8 caractères minimum'
            }
          }
        },
        confirmPassword: {
          validators: {
            notEmpty: {
              message: 'Confirmez le mot de passe'
            },
            identical: {
              compare: function () {
                return formChangePass.querySelector('[name="newPassword"]').value;
              },
              message: 'Le mot de passe est sa confirmation ne sont pas identiques'
            },
            stringLength: {
              min: 8,
              message: 'Password must be more than 8 characters'
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
    });
  }
})();
 */