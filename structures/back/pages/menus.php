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
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Mes menus /</span> Gérer mes menus</h4>
            <?php flash(); ?>
            <div class="card">
              <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Liste des Menus</h5>
                <button  style="background-color:#2d698cff; color:white;" class="btn waves-effect waves-light" data-bs-toggle="offcanvas" data-bs-target="#addMenu" aria-controls="addMenu">
                  <i class="ti ti-plus me-1"></i>
                  <span class="align-middle">Créer un menu</span>
                </button>
              </div>
              <div class="table-responsive text-nowrap">
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th>Date</th>
                      <th>Entrée</th>
                      <th>Plat</th>
                      <th>Déssert</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody class="table-border-bottom-0">
                    <?php foreach (getAllMenus() as $menu) : ?>
                      <tr>
                        <td>
                          <?= dateToFrench($menu["date"]); ?>
                        </td>
                        <td>
                          <?= $menu["entree"] ?>
                        </td>
                        <td>
                          <?= $menu["plat"] ?>
                        </td>
                        <td>
                          <?= $menu["dessert"] ?>
                        </td>
                        <td>
                          <div class="dropdown">
                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                              <i class="ti ti-dots-vertical"></i>
                            </button>
                            <div class="dropdown-menu">
                              <a class="dropdown-item update-button" data-id="<?= $menu["id"] ?>" data-date="<?= $menu["date"] ?>" data-entree="<?=$menu["entree"]?>" data-plat="<?=$menu["plat"]?>" data-dessert="<?=$menu["dessert"]?>" data-bs-toggle="offcanvas" data-bs-target="#editMenu" aria-controls="editMenu"><i class="ti ti-pencil me-1"></i> Editer</a>
                              <a class="dropdown-item delete-button" data-id="<?= $menu["id"] ?>" data-text="le menu du <?= $menu["date"] ?>"  href="javascript:void(0);"><i class="ti ti-trash me-1"></i> Effacer</a>
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
    <!-- Modal Ajout-->
    <div class="offcanvas offcanvas-end" tabindex="-1" id="addMenu" aria-labelledby="offcanvasEndLabel">
      <div class="offcanvas-header">
        <h5 id="offcanvasEndLabel" class="offcanvas-title">Créer un menu</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body mx-0 flex-grow-0">
        <form id="addMenuForm" class="row g-3" method="POST" action="/admin/menu-add">
          <!-- Date Menu -->
          <div class="col-12 mb-3 errorForm">
            <label class="form-label" for="newMenuDate">Date du menu</label>
            <input type="date" id="newMenuDate" name="newMenuDate" class="form-control" placeholder="date menu" />
          </div>
          <!-- Entrée Menu -->
          <div class="col-12 mb-3 errorForm">
            <label class="form-label" for="newMenuEntree">Entrée du menu</label>
            <input type="text" id="newMenuEntree" name="newMenuEntree" class="form-control" placeholder="entrée menu" />
          </div>
          <!-- Plat Menu -->
          <div class="col-12 mb-3 errorForm">
            <label class="form-label" for="newMenuPlat">Plat du menu</label>
            <input type="text" id="newMenuPlat" name="newMenuPlat" class="form-control" placeholder="plat menu" />
          </div>
          <!-- Dessert Menu -->
          <div class="col-12 mb-3 errorForm">
            <label class="form-label" for="newMenuDessert">Dessert du menu</label>
            <input type="text" id="newMenuDessert" name="newMenuDessert" class="form-control" placeholder="dessert menu" />
          </div>

          <div class="col-12 text-center">
            <button type="submit" class="btn btn-primary mb-2 d-grid w-100 waves-effect waves-light">AJOUTER</button>
            <button type="button" class="btn btn-label-primary d-grid w-100 waves-effect" data-bs-dismiss="offcanvas">ANNULER</button>
        </form>

      </div>
    </div>
    <!-- /Modal Ajout-->
  </div>
  <!-- / Layout wrapper -->

  <!-- Modal Edit-->
  <div class="offcanvas offcanvas-end" tabindex="-1" id="editMenu" aria-labelledby="offcanvasEndLabel2">
    <div class="offcanvas-header">
      <h5 id="offcanvasEndLabel2" class="offcanvas-title">Editer un menu</h5>
      <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body mx-0 flex-grow-0">
      <form id="editMenuForm" class="row g-3" method="POST" action="/admin/menu-edit">
        <div class="col-12 mb-3 errorForm">
          <!--Date Menu -->
          <label class="form-label" for="editMenuDate">Nouvelle date de ce menu</label>
          <input type="date" id="editMenuDate" name="editMenuDate" class="form-control" placeholder="date menu" />
        </div>
          <!-- Entrée Menu -->
          <div class="col-12 mb-3 errorForm">
            <label class="form-label" for="editMenuEntree">Entrée du menu</label>
            <input type="text" id="editMenuEntree" name="editMenuEntree" class="form-control" placeholder="entrée menu" />
          </div>
          <!-- Plat Menu -->
          <div class="col-12 mb-3 errorForm">
            <label class="form-label" for="editMenuPlat">Plat du menu</label>
            <input type="text" id="editMenuPlat" name="editMenuPlat" class="form-control" placeholder="plat menu" />
          </div>
          <!-- Dessert Menu -->
          <div class="col-12 mb-3 errorForm">
            <label class="form-label" for="editMenuDessert">Dessert du menu</label>
            <input type="text" id="editMenuDessert" name="editMenuDessert" class="form-control" placeholder="dessert menu" />
          </div>
        <div class="col-12 text-center">
          <input type="hidden" name="hiddenMenuId" value="undefined" id="hiddenMenuId">
          <button type="submit" class="btn btn-primary mb-2 d-grid w-100 waves-effect waves-light">MODIFIER</button>
          <button type="button" class="btn btn-label-primary d-grid w-100 waves-effect" data-bs-dismiss="offcanvas">ANNULER</button>
      </form>

    </div>
  </div>
  <!-- /Modal Edit-->


  <!-- Core JS -->
  <!-- build:js assets/vendor/js/core.js -->
  <script src="/assets/vendor/libs/jquery/jquery.js"></script>
  <script src="/assets/vendor/libs/popper/popper.js"></script>
  <script src="/assets/vendor/js/bootstrap.js"></script>
  <script src="/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
  <script src="/assets/vendor/libs/node-waves/node-waves.js"></script>

  <script src="/assets/vendor/libs/dropzone/dropzone.js"></script>
  <script src="/assets/vendor/libs/sweetalert2/sweetalert2.js"></script>
  <script src="/assets/vendor/libs/cleavejs/cleave.js"></script>
  <script src="/assets/vendor/libs/cleavejs/cleave-phone.js"></script>
  <script src="/assets/vendor/libs/select2/select2.js"></script>
  <script src="/assets/vendor/libs/formvalidation/dist/js/FormValidation.min.js"></script>
  <script src="/assets/vendor/libs/formvalidation/dist/js/plugins/Bootstrap5.min.js"></script>
  <script src="/assets/vendor/libs/formvalidation/dist/js/plugins/AutoFocus.min.js"></script>

  <script src="/assets/vendor/libs/hammer/hammer.js"></script>

  <script src="/assets/vendor/js/menu.js"></script>
  <!-- endbuild -->

  <!-- Vendors JS -->

  <!-- Main JS -->
  <script src="/assets/js/main.js"></script>

  <!-- Page JS -->
  <script src="/assets/js/crud-menus.js"></script>
  <script src="/assets/js/delete-buttons.js"></script>
</body>

</html>