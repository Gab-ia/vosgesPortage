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
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Paramètres /</span>Gestion des Menus</h4>
            <?php flash(); ?>
                          <div class="col-md-6 order-md-2 order-1">
                <div class="card mb-4">
                  <h5 class="card-header">Création de Menu</h5>
                  <div class="card-body">
                    <div>
                      <form id="addType" action="/admin/type-action" method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                          <label for="newType" class="form-label">Entrée</label>
                          <input type="text" name="newType" class="form-control mb-2" id="newType" placeholder="..." aria-describedby="defaultFormControlHelp" />
                        </div>
                        <div class="mb-3">
                          <label for="newType" class="form-label">Plat</label>
                          <input type="text" name="newType" class="form-control mb-2" id="newType" placeholder="..." aria-describedby="defaultFormControlHelp" />
                        </div>
                        <div class="mb-3">
                          <label for="newType" class="form-label">Dessert</label>
                          <input type="text" name="newType" class="form-control mb-2" id="newType" placeholder="..." aria-describedby="defaultFormControlHelp" />
                        </div>
                        <button class="btn btn-primary waves-effect waves-light" data-repeater-create="">
                          <i class="ti ti-plus me-1"></i>
                          <span class="align-middle">Ajouter</span>
                        </button>
                      </form>
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
  <div class="modal fade" id="editType" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-simple">
      <div class="modal-content p-3 p-md-5">
        <div class="modal-body">
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          <div class="text-center mb-4">
            <h3 class="mb-2">Editer un type</h3>
          </div>
          <form id="updateTypeForm" class="row g-3" method="POST" action="/admin/update-type" enctype="multipart/form-data">
            <div class="col-12 mb-3">
              <label class="form-label" for="updateTypeText">Nouveau nom du type</label>
              <input type="text" id="updateTypeText" name="updateTypeText" class="form-control" placeholder="John Doe" />
            </div>
            <div class="mb-3">
              <label for="formUpdateFile" class="form-label">Icone pour ce type</label>
              <input class="form-control" type="file" id="formUpdateFile" name="updateIcon">
            </div>
            <div class="col-12 text-center">
              <input type="hidden" name="type_id" value="notDefined" id="hiddenTypeId">
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
  <script src="/assets/vendor/libs/dropzone/dropzone.js"></script>
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
  <script src="/assets/js/crud-types.js"></script>
  <script src="/assets/js/delete-buttons.js"></script>

</body>

</html>