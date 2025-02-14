<!DOCTYPE html>

<html lang="en" class="light-style layout-navbar-fixed layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="/" data-template="vertical-menu-template-no-customizer-starter">
<?php

include './structures/back/composants/head.php';

?>

<body>
  <!-- Layout wrapper -->
  <div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
      <!-- Menu -->

      <?php

      include './structures/back/composants/navigation.php';

      ?>
      <!-- / Menu -->

      <!-- Layout container -->
      <div class="layout-page">
        <!-- Navbar -->

        <?php include './structures/back/composants/navbar.php'; ?>

        <!-- / Navbar -->

        <!-- Content wrapper -->
        <div class="content-wrapper">
          <!-- Content -->

          <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Paramètres / </span>Gestion des zones de livraison</h4>
            <?php flash(); ?>
            <div class="row d-flex">
              <div class="col-md-8 order-md-1 order-2">
                <div class="card mb-4">
                  <h5 class="card-header">LISTE DES ZONES DESSERVIES</h5>
                  <div class="card-body">
                    <div class="text-nowrap">
                      <table class="table">
                        <tbody class="table-border-bottom-0">
                          <tr>
                            <td>
                              <strong>Nom</strong>
                            </td>
                            <td style="color: #2d698cff;">
                              <strong>Ordre de priorité</strong>
                            </td>
                            <td>
                              <strong>Latitude</strong>
                            </td>
                            <td style="color: #2d698cff;">
                              <strong>Longitude</strong>
                            </td>
                            <td>
                              <strong>Liste</strong>
                            </td>
                            <td style="color: #2d698cff;">
                              <strong>Carte</strong>
                            </td>
                            <td>
                              <strong></strong>
                            </td>
                          </tr>
                          <?php foreach (getAllVilles() as $ville) :    
                            $colorListe = ($ville['liste']== 1) ? '#19b04b' : '#c64024';
                            $colorCarte = ($ville['carte']== 1) ? '#19b04b' : '#c64024';?>
                            <tr>
                              <td>
                                <strong><?= $ville["nom_ville"] ?></strong>
                              </td>
                              <td style="color: #2d698cff;">
                                <strong><?= $ville["priority"] ?></strong>
                              </td>
                              <td>
                                <strong><?= $ville["latitude"] ?></strong>
                              </td>
                              <td style="color: #2d698cff;">
                                <strong><?= $ville["longitude"] ?></strong>
                              </td>
                              <td>
                              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" fill="<?= $colorListe ?>"><path d="M152.1 38.2c9.9 8.9 10.7 24 1.8 33.9l-72 80c-4.4 4.9-10.6 7.8-17.2 7.9s-12.9-2.4-17.6-7L7 113C-2.3 103.6-2.3 88.4 7 79s24.6-9.4 33.9 0l22.1 22.1 55.1-61.2c8.9-9.9 24-10.7 33.9-1.8zm0 160c9.9 8.9 10.7 24 1.8 33.9l-72 80c-4.4 4.9-10.6 7.8-17.2 7.9s-12.9-2.4-17.6-7L7 273c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0l22.1 22.1 55.1-61.2c8.9-9.9 24-10.7 33.9-1.8zM224 96c0-17.7 14.3-32 32-32l224 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-224 0c-17.7 0-32-14.3-32-32zm0 160c0-17.7 14.3-32 32-32l224 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-224 0c-17.7 0-32-14.3-32-32zM160 416c0-17.7 14.3-32 32-32l288 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-288 0c-17.7 0-32-14.3-32-32zM48 368a48 48 0 1 1 0 96 48 48 0 1 1 0-96z"/></svg>
                              </td>
                              <td style="color: #2d698cff;">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" fill="<?= $colorCarte ?>"><path d="M408 120c0 54.6-73.1 151.9-105.2 192c-7.7 9.6-22 9.6-29.6 0C241.1 271.9 168 174.6 168 120C168 53.7 221.7 0 288 0s120 53.7 120 120zm8 80.4c3.5-6.9 6.7-13.8 9.6-20.6c.5-1.2 1-2.5 1.5-3.7l116-46.4C558.9 123.4 576 135 576 152l0 270.8c0 9.8-6 18.6-15.1 22.3L416 503l0-302.6zM137.6 138.3c2.4 14.1 7.2 28.3 12.8 41.5c2.9 6.8 6.1 13.7 9.6 20.6l0 251.4L32.9 502.7C17.1 509 0 497.4 0 480.4L0 209.6c0-9.8 6-18.6 15.1-22.3l122.6-49zM327.8 332c13.9-17.4 35.7-45.7 56.2-77l0 249.3L192 449.4 192 255c20.5 31.3 42.3 59.6 56.2 77c20.5 25.6 59.1 25.6 79.6 0zM288 152a40 40 0 1 0 0-80 40 40 0 1 0 0 80z"/></svg>
                              </td>
                              <td>
                                <div class="dropdown d-flex justify-content-end">
                                  <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                    <i class="ti ti-dots-vertical"></i>
                                  </button>
                                  <div class="dropdown-menu">
                                    <a class="dropdown-item update-button" data-id="<?= $ville["id"] ?>" data-text="<?= $ville["nom_ville"] ?>" data-priority="<?= $ville["priority"] ?>" data-latitude="<?= $ville["latitude"] ?>" data-longitude="<?= $ville["longitude"] ?>" data-liste="<?= $ville["liste"] ?>" data-carte="<?= $ville["carte"] ?>" href="javascript:void(0);" data-bs-target="#editVille" data-bs-toggle="modal"><i class="ti ti-pencil me-1"></i> Editer</a>
                                    <a class="dropdown-item delete-button" data-id="<?= $ville["id"] ?>" data-text="<?= $ville["nom_ville"] ?>" data-priority="<?= $ville["priority"] ?>" data-latitude="<?= $ville["latitude"] ?>" data-longitude="<?= $ville["longitude"] ?>" data-liste="<?= $ville["liste"] ?>" data-carte="<?= $ville["carte"] ?>" href="javascript:void(0);"><i class="ti ti-trash me-1"></i> Effacer</a>
                                  </div>
                                </div>
                              </td>
                            </tr>
                          <?php endforeach; ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-4 order-md-2 order-1">
                <div class="card mb-4">
                  <h5 class="card-header">NOUVELLE ZONE</h5>
                  <div class="card-body">
                    <div>
                      <form id="ville_nom" action="/admin/new-zone" method="POST">
                        <div class="mb-3">
                          <label for="ville_nom" class="form-label" style="font-size: 18px;">Ajoutez une zone</label>
                          <input type="text" name="ville_nom" class="form-control mb-2" id="ville_nom" placeholder="Ici..." aria-describedby="defaultFormControlHelp" />
                        </div>
                        <div class="mb-3">
                          <label for="ordre_priorite" class="form-label" style="font-size: 18px;">Ajoutez un ordre de priorité </label>
                          <input type="text" class="form-control mb-2" name="ordre_priorite" id="ordre_priorite" placeholder="Entre 1 et 200"/>
                        </div>
                        <div class="mb-3">
                          <label for="ville_latitude" class="form-label" style="font-size: 18px;">Ajoutez une latitude </label>
                          <input type="text" class="form-control mb-2" name="ville_latitude" id="ville_latitude" placeholder=""/>
                        </div>
                        <div class="mb-3">
                          <label for="ville_longitude" class="form-label" style="font-size: 18px;">Ajoutez une longitude </label>
                          <input type="text" class="form-control mb-2" name="ville_longitude" id="ville_longitude" placeholder=""/>
                        </div>
                        <div class="mb-3">
                          <label for="ville_liste" class="form-label" style="font-size: 18px;">Ajouter à la liste ?</label>
                          <input type="checkbox" class="form-check-input mb-2 checkZone" name="ville_liste" id="ville_liste"/>
                        </div>
                        <div class="mb-3">
                          <label for="ville_carte" class="form-label" style="font-size: 18px;">Ajouter à la carte ?</label>
                          <input type="checkbox" class="form-check-input mb-2 checkZone" name="ville_carte" id="ville_carte"/>
                        </div>
                        <button class="btn btn-primary waves-effect waves-light" data-repeater-create="">
                          <i class="ti ti-plus me-1"></i>
                          <span class="align-middle">Ajouter</span>
                        </button>
                      </form>
                      <br>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- / Content -->

          <!-- Footer -->
          <?php include './structures/back/composants/footer.php'; ?>
          <!-- / Footer -->

          <div class="content-backdrop fade"></div>
        </div>
        <!-- Content wrapper -->
      </div>
      <!-- / Layout page -->
    </div>

    <!-- Overlay -->
    <div class="layout-overlay layout-menu-toggle"></div>

    <!-- Drag Target Area To SlideIn Menu On Small Screens -->
    <div class="drag-target"></div>
  </div>
  <!-- / Layout wrapper -->

  <!-- edit modal -->
  <div class="modal fade" id="editVille" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-simple">
    <div class="modal-content p-3 p-md-5">
      <div class="modal-body">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        <div class="text-center mb-4">
          <h3 class="mb-2">Modifier une zone</h3>
        </div>
        <form id="updateVilleForm" class="row g-3" method="POST" action="/admin/update-zone">
          <div class="col-12 mb-3">
            <label class="form-label" for="updateVilleText" style="font-size: 18px;">Nouveau nom de zone</label>
            <input type="text" id="updateVilleText" name="updateVilleText" class="form-control" placeholder="John Doe" />
          </div>
          <div class="col-12 mb-3">
            <label class="form-label" for="updateOrdrePriorite" style="font-size: 18px;">Nouvel ordre de priorité</label>
            <input type="number" id="updateOrdrePriorite" name="updateOrdrePriorite" class="form-control" placeholder="" value="0" />
          </div>
          <div class="col-12 mb-3">
            <label class="form-label" for="updateLatitude" style="font-size: 18px;">Nouvelle latitude</label>
            <input type="number" id="updateLatitude" name="updateLatitude" class="form-control" placeholder=""/>
          </div>
          <div class="col-12 mb-3">
            <label class="form-label" for="updateLongitude" style="font-size: 18px;">Nouvelle longitude</label>
            <input type="number" id="updateLongitude" name="updateLongitude" class="form-control" placeholder=""/>
          </div>
          <div class="mb-3">
            <label for="update_ville_liste" class="form-label" style="font-size: 18px;">Ajouter à la liste ?</label>
            <input type="checkbox" class="form-check-input mb-2 checkZone" name="update_ville_liste" id="update_ville_liste"/>
          </div>
          <div class="mb-3">
            <label for="update_ville_carte" class="form-label" style="font-size: 18px;">Ajouter à la carte ?</label>
            <input type="checkbox" class="form-check-input mb-2 checkZone" name="update_ville_carte" id="update_ville_carte"/>
          </div>
          <div class="col-12 text-center">
            <input type="hidden" name="hiddenVilleId" value="notDefined" id="hiddenVilleId">
            <button type="submit" class="btn btn-primary me-sm-3 me-1">MODIFIER</button>
            <button type="reset" class="btn btn-label-primary btn-reset" data-bs-dismiss="modal" aria-label="Close">ANNULER</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
 <!-- / edit modal -->

  <!-- Core JS -->
  <!-- build:js assets/vendor/js/core.js -->
  <script src="/assets/vendor/libs/jquery/jquery.js"></script>
  <script src="/assets/vendor/libs/popper/popper.js"></script>
  <script src="/assets/vendor/js/bootstrap.js"></script>
  <script src="/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
  <script src="/assets/vendor/libs/node-waves/node-waves.js"></script>

  <script src="/assets/vendor/libs/hammer/hammer.js"></script>

  <script src="/assets/vendor/js/menu.js"></script>
  <!-- endbuild -->

  <!-- Vendors JS -->
  <script src="/assets/vendor/libs/sweetalert2/sweetalert2.js"></script>
  <script src="/assets/vendor/libs/cleavejs/cleave.js"></script>
  <script src="/assets/vendor/libs/cleavejs/cleave-phone.js"></script>
  <script src="/assets/vendor/libs/select2/select2.js"></script>
  <script src="/assets/vendor/libs/formvalidation/dist/js/FormValidation.min.js"></script>
  <script src="/assets/vendor/libs/formvalidation/dist/js/plugins/Bootstrap5.min.js"></script>
  <script src="/assets/vendor/libs/formvalidation/dist/js/plugins/AutoFocus.min.js"></script>
  <!-- Main JS -->
  <script src="/assets/js/main.js"></script>

  <!-- Page JS -->
  <script src="/assets/js/js_perso/admin-ville.js"></script>
  <script src="/assets/js/delete-buttons.js"></script>
  <script src="/assets/vendor/libs/nouislider/nouislider.js"></script>
  <script src="/assets/js/forms-sliders.js"></script>
</body>

</html>