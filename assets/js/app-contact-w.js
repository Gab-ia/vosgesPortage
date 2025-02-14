'use strict';

$(function () {

  let borderColor, bodyBg, headingColor;

  if (isDarkStyle) {
    borderColor = config.colors_dark.borderColor;
    bodyBg = config.colors_dark.bodyBg;
    headingColor = config.colors_dark.headingColor;
  } else {
    borderColor = config.colors.borderColor;
    bodyBg = config.colors.bodyBg;
    headingColor = config.colors.headingColor;
  }

  var dt_user_table = $('.datatables-contacts'),
    select2 = $('.select2')

  if (select2.length) {
    var $this = select2;
    $this.wrap('<div class="position-relative"></div>').select2({
      placeholder: 'Select Country',
      dropdownParent: $this.parent()
    });
  }

  if (dt_user_table.length) {
    // Précharger les noms des villes pour les contacts avec nom_ville = 'Autre'
    $.ajax({
      url: '/api/contacts',
      method: 'GET',
      success: function (response) {
        let data;
        try {
          data = typeof response === 'string' ? JSON.parse(response) : response;
        } catch (e) {
          console.error("Erreur lors du parsing de la réponse JSON:", e);
          return;
        }

        if (!data || !Array.isArray(data.data)) {
          console.error("La réponse de l'API n'est pas dans le format attendu:", data);
          return;
        }

        const promises = data.data.map(contact => {
          if (contact.nom_ville === 'Autre') {
            return getNomVilleVosgesFromIdContact(contact.id)
              .then(nomVilleVosges => {
                contact.nom_ville += " : " + nomVilleVosges;
              })
              .catch(error => {
                console.error("Erreur lors de la récupération du nom de la ville :", error);
                contact.nom_ville += " : Erreur de chargement";
              });
          }
          return Promise.resolve();
        });

        Promise.all(promises).then(() => {
          initDataTable(data.data);
        });
      },
      error: function (error) {
        console.error("Erreur lors de la récupération des contacts :", error);
      }
    });
  }

  function initDataTable(data) {
    var dt_user = dt_user_table.DataTable({
      data: data,
      columns: [
        { data: '' },            // Control column
        { data: 'nom_complet' }, // Full Name
        { data: 'telephone' },   // Telephone
        { data: 'infos' },       // Infos
        { data: 'nb_repas' },    // Number of meals
        { data: 'nom_ville' },   // City
        { data: 'date_inscription' }
      ],
      columnDefs: [
        {
          className: 'control',
          searchable: false,
          orderable: false,
          responsivePriority: 2,
          targets: 0,
          render: function (data, type, full, meta) {
            return '';
          }
        },
        {
          targets: 1,
          responsivePriority: 4,
          render: function (data, type, full, meta) {
            var $name = full['nom_complet'],
              $email = full['email'],
              $image = full['avatar'];
            if ($image) {
              var $output =
                '<img src="' + assetsPath + 'img/avatars/' + $image + '" alt="Avatar" class="rounded-circle">';
            } else {
              var stateNum = Math.floor(Math.random() * 6);
              var states = ['success', 'danger', 'warning', 'info', 'primary', 'secondary'];
              var $state = states[stateNum],
                $initials = $name.match(/\b\w/g) || [];
              $initials = (($initials.shift() || '') + ($initials.pop() || '')).toUpperCase();
              $output = '<span class="avatar-initial rounded-circle bg-label-primary">' + $initials + '</span>';
            }
            return `
            <div class="d-flex justify-content-start align-items-center user-name">
              <div class="avatar-wrapper">
                <div class="avatar avatar-sm me-3">${$output}</div>
              </div>
              <div class="d-flex flex-column">
                <span class="fw-semibold">${$name}</span>
                <small class="text-muted">${$email}</small>
              </div>
            </div>`;
          }
        },
        {
          targets: 2,
          render: function (data, type, full, meta) {
            var $contactPhone = full['telephone'];
            return '<span class="fw-semibold">' + $contactPhone + '</span>';
          }
        },
        {
          targets: 3,
          render: function (data, type, full, meta) {
            var $contactInfos = full['infos'];
            return '<span class="fw-semibold">' + $contactInfos + '</span>';
          }
        },
        {
          targets: 4,
          render: function (data, type, full, meta) {
            var $contactRepas = full['nb_repas'];
            return '<span class="fw-semibold">' + $contactRepas + '</span>';
          }
        },
        {
          targets: 5,
          render: function (data, type, full, meta) {
            var $contactVille = full['nom_ville'];
            return '<span class="fw-semibold">' + $contactVille + '</span>';
          }
        },
        {
          targets: 6,
          render: function (data, type, full, meta) {
            var $contactDateInscription = full['date_inscription'];

            // Vérifier si la date n'est pas null
            if ($contactDateInscription === null) {
              return '<span class="fw-semibold">Non renseigné</span>';
            }

            // Créer un objet Date à partir de la date_inscription
            var dateObject = new Date($contactDateInscription);

            // Formatage de la date pour affichage
            var formattedDate = new Intl.DateTimeFormat('fr-FR', {
              day: '2-digit',
              month: 'long',
              year: 'numeric'
            }).format(dateObject);

            // Si type est 'display', retourner la date formatée
            if (type === 'display') {
              return '<span class="fw-semibold">' + formattedDate + '</span>';
            }

            // Pour le tri et les autres utilisations, retourner la date originale (au format timestamp)
            return dateObject.getTime();
          }
        }
      ],
      order: [[1, 'desc']],
      dom:
        '<"row me-2"' +
        '<"col-md-2"<"me-3"l>>' +
        '<"col-md-10"<"dt-action-buttons text-xl-end text-lg-start text-md-end text-start d-flex align-items-center justify-content-end flex-md-row flex-column mb-3 mb-md-0"fB>>' +
        '>t' +
        '<"row mx-2"' +
        '<"col-sm-12 col-md-6"i>' +
        '<"col-sm-12 col-md-6"p>' +
        '>',
      language: {
        url: 'https://cdn.datatables.net/plug-ins/1.13.4/i18n/fr-FR.json',
        sLengthMenu: '_MENU_',
        search: '',
        searchPlaceholder: 'Rechercher..'
      },
      buttons: [
        {
          extend: 'collection',
          className: 'btn btn-label-secondary dropdown-toggle mx-3',
          text: '<i class="ti ti-screen-share me-1 ti-xs"></i>Exporter',
          buttons: [
            {
              extend: 'print',
              text: '<i class="ti ti-printer me-2" ></i>Print',
              className: 'dropdown-item',
              exportOptions: {
                columns: [1, 2, 3, 4, 5],
                format: {
                  body: function (inner, coldex, rowdex) {
                    return cleanContent(inner);
                  }
                }
              },
              customize: function (win) {
                $(win.document.body)
                  .css('color', headingColor)
                  .css('border-color', borderColor)
                  .css('background-color', bodyBg);
                $(win.document.body)
                  .find('table')
                  .addClass('compact')
                  .css('color', 'inherit')
                  .css('border-color', 'inherit')
                  .css('background-color', 'inherit');
              }
            },
            {
              extend: 'csv',
              text: '<i class="ti ti-file-text me-2" ></i>Csv',
              className: 'dropdown-item',
              exportOptions: {
                columns: [1, 2, 3, 4, 5],
                format: {
                  body: function (inner, coldex, rowdex) {
                    return cleanContent(inner);
                  }
                }
              }
            },
            {
              extend: 'excel',
              text: '<i class="ti ti-file-spreadsheet me-2"></i>Excel',
              className: 'dropdown-item',
              exportOptions: {
                columns: [1, 2, 3, 4, 5],
                format: {
                  body: function (inner, coldex, rowdex) {
                    return cleanContent(inner);
                  }
                }
              }
            },
            {
              extend: 'pdf',
              text: '<i class="ti ti-file-code-2 me-2"></i>Pdf',
              className: 'dropdown-item',
              exportOptions: {
                columns: [1, 2, 3, 4, 5],
                format: {
                  body: function (inner, coldex, rowdex) {
                    return cleanContent(inner);
                  }
                }
              }
            },
            {
              extend: 'copy',
              text: '<i class="ti ti-copy me-2" ></i>Copy',
              className: 'dropdown-item',
              exportOptions: {
                columns: [1, 2, 3, 4, 5],
                format: {
                  body: function (inner, coldex, rowdex) {
                    return cleanContent(inner);
                  }
                }
              }
            }
          ]
        },
        {
          text: '<i class="ti ti-plus me-0 me-sm-1 ti-xs"></i><span class="d-none d-sm-inline-block">Add New User</span>',
          className: 'add-new btn btn-primary d-none',
          attr: {
            'data-bs-toggle': 'offcanvas',
            'data-bs-target': '#offcanvasAddUser'
          }
        }
      ],
      responsive: {
        details: {
          display: $.fn.dataTable.Responsive.display.modal({
            header: function (row) {
              var data = row.data();
              return 'Details of ' + data['full_name'];
            }
          }),
          type: 'column',
          renderer: function (api, rowIdx, columns) {
            var data = $.map(columns, function (col, i) {
              return col.title !== '' ? '<tr data-dt-row="' + col.rowIndex + '" data-dt-column="' + col.columnIndex + '">' +
                '<td>' + col.title + ':</td> ' +
                '<td>' + col.data + '</td>' +
                '</tr>' : '';
            }).join('');
            return data ? $('<table class="table"/><tbody />').append(data) : false;
          }
        }
      }
    });
  }

  // Function to clean content for export
  function cleanContent(inner) {
    if (inner.length <= 0) return inner;
    var el = $.parseHTML(inner);
    var result = '';
    $.each(el, function (index, item) {
      if (item.classList !== undefined && item.classList.contains('user-name')) {
        result = result + item.lastChild.firstChild.textContent;
      } else if (item.innerText === undefined) {
        result = result + item.textContent;
      } else result = result + item.innerText;
    });
    return result;
  }

  setTimeout(() => {
    $('.dataTables_filter .form-control').removeClass('form-control-sm');
    $('.dataTables_length .form-select').removeClass('form-select-sm');
  }, 300);
});

async function getNomVilleVosgesFromIdContact(id_contact) {
  try {
    const response = await fetch(`/api/getNomVilleVosgesFromIdContact?id_contact=${id_contact}`, {
      method: 'GET'
    });

    if (!response.ok) {
      throw new Error(`Erreur: ${response.status} - ${response.statusText}`);
    }

    const nomVilleVosges = await response.json();

    if (nomVilleVosges.error) {
      throw new Error(nomVilleVosges.error + (nomVilleVosges.details ? ' - ' + nomVilleVosges.details : ''));
    }

    return nomVilleVosges.nom_ville;

  } catch (error) {
    console.error("Erreur:", error);
    throw error;
  }
}
