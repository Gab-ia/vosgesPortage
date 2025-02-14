'use strict';
const formMenuAdd = document.querySelector('#addMenuForm');
const formMenuEdit = document.querySelector('#editMenuForm');
const allRadioIcons = document.querySelectorAll('.form-check-new');
const allRadioIconsEdit = document.querySelectorAll('.form-check-edit');
const allDeleteButtons = document.querySelectorAll(".delete-button");
const allUpdateButtons = document.querySelectorAll(".update-button");

document.addEventListener('DOMContentLoaded', function (e) {

    allUpdateButtons.forEach(editButton => {
        editButton.addEventListener("click", () => {
            //date
            document.getElementById("editMenuDate").placeholder = editButton.dataset.date;
            document.getElementById("editMenuDate").value = editButton.dataset.date;
            //entrée
            document.getElementById("editMenuEntree").placeholder = editButton.dataset.entree;
            document.getElementById("editMenuEntree").value = editButton.dataset.entree;
            //plat
            document.getElementById("editMenuPlat").placeholder = editButton.dataset.plat;
            document.getElementById("editMenuPlat").value = editButton.dataset.plat;
            //dessert
            document.getElementById("editMenuDessert").placeholder = editButton.dataset.dessert;
            document.getElementById("editMenuDessert").value = editButton.dataset.dessert;

            document.getElementById("hiddenMenuId").value = editButton.dataset.id;
        })
    });


    allDeleteButtons.forEach(deleteButton => {
        deleteButton.addEventListener("click", () => {
            deleteButtonF(deleteButton.dataset.text, deleteButton.dataset.id, "/admin/menu-delete")
        });
    });




    (function () {
        // Form validation for Add new menu
        if (formMenuAdd) {
            const fvUpdate = FormValidation.formValidation(formMenuAdd, {
                fields: {
                    newMenuDate: {
                        validators: {
                            notEmpty: {
                                message: 'Veuillez entrer une nouvelle date'
                            },
                        }
                    },
                    newMenuEntree: {
                        validators: {
                            notEmpty: {
                                message: 'Veuillez entrer une nouvelle entrée'
                            },
                            stringLength: {
                                min: 10,
                                max: 200,
                                message: '10 caractères mininum et 200 max '
                            }
                        }
                    },
                    newMenuPlat: {
                        validators: {
                            notEmpty: {
                                message: 'Veuillez entrer un nouveau plat'
                            },
                            stringLength: {
                                min: 10,
                                max: 200,
                                message: '10 caractères mininum et 200 max '
                            }
                        }
                    },
                    newMenuDessert: {
                        validators: {
                            notEmpty: {
                                message: 'Veuillez entrer un nouveau dessert'
                            },
                            stringLength: {
                                min: 10,
                                max: 200,
                                message: '10 caractères mininum et 200 max '
                            }
                        }
                    }
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
        // Form validation for Edit a menu
        if (formMenuEdit) {
            const fvUpdate = FormValidation.formValidation(formMenuEdit, {
                fields: {
                    editMenuDate: {
                        validators: {
                            notEmpty: {
                                message: 'Veuillez entrer une nouvelle date'
                            },
                        }
                    },
                    editMenuEntree: {
                        validators: {
                            notEmpty: {
                                message: 'Veuillez entrer une nouvelle entrée'
                            },
                            stringLength: {
                                min: 10,
                                max: 200,
                                message: '10 caractères mininum et 200 max '
                            }
                        }
                    },
                    editMenuPlat: {
                        validators: {
                            notEmpty: {
                                message: 'Veuillez entrer un nouveau plat'
                            },
                            stringLength: {
                                min: 10,
                                max: 200,
                                message: '10 caractères mininum et 200 max '
                            }
                        }
                    },
                    editMenuDessert: {
                        validators: {
                            notEmpty: {
                                message: 'Veuillez entrer un nouveau dessert'
                            },
                            stringLength: {
                                min: 10,
                                max: 200,
                                message: '10 caractères mininum et 200 max '
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

});

