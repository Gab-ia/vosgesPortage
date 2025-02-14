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
          <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Mes collections /</span> gérer mes collections</h4>
            <?php flash(); ?>
            <div class="card">
              <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Liste des collections</h5>
                <button class="btn btn-primary waves-effect waves-light" data-bs-toggle="offcanvas" data-bs-target="#addCollection" aria-controls="addCollection">
                  <i class="ti ti-plus me-1"></i>
                  <span class="align-middle">Créer une collection</span>
                </button>
              </div>
              <div class="table-responsive text-nowrap">
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th>Collections</th>
                      <th>Date création</th>
                      <th>Date modification</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody class="table-border-bottom-0">
                    <?php foreach (getAllCollectionsbyUserID($_SESSION["User"]["userId"]) as $collection) : ?>
                      <tr>
                        <td>
                          <img src="/assets/img/type-icons/type-<?= $collection["type_ID"] ?>.svg" width="32"><?= getCollectionStatus($collection["Is_private"]); ?><span class="ps-3"><strong><a href="/admin/view-collection?collectionID=<?= $collection["ID"]  ?>"><?= $collection["Name"]  ?></a></strong></span><span class="badge rounded-pill bg-label-dark ms-2"><?= $collection["Number_items"]  ?></span>
                        </td>
                        <td>
                          <?= dateToFrench($collection["Creation_date"]); ?>
                        </td>
                        <td>
                          <?= dateToFrench($collection["Update_date"]); ?>
                        </td>
                        <td>
                          <div class="dropdown">
                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                              <i class="ti ti-dots-vertical"></i>
                            </button>
                            <div class="dropdown-menu">
                              <a class="dropdown-item update-button" data-id="<?= $collection["ID"] ?>" data-isprivate="<?= $collection["Is_private"] ?>" data-typeid="<?= $collection["ID_type"] ?>" data-text="<?= $collection["Name"] ?>" data-bs-toggle="offcanvas" data-bs-target="#editMyCollection" aria-controls="editMyCollection"><i class="ti ti-pencil me-1"></i> Editer</a>
                              <a class="dropdown-item delete-button" data-id="<?= $collection["ID"] ?>" data-text="<?= $collection["Name"] ?>" href="javascript:void(0);"><i class="ti ti-trash me-1"></i> Effacer</a>
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
  <div class="offcanvas offcanvas-end" tabindex="-1" id="addCollection" aria-labelledby="offcanvasEndLabel">
    <div class="offcanvas-header">
      <h5 id="offcanvasEndLabel" class="offcanvas-title">Créer une collection</h5>
      <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body mx-0 flex-grow-0">
      <form id="addCollectionForm" class="row g-3" method="POST" action="/admin/my-collections-add">
        <div class="col-12 mb-3 errorForm">
          <label class="form-label" for="newCollectionName">Nouveau nom de cette collection</label>
          <input type="text" id="newCollectionName" name="newCollectionName" class="form-control" placeholder="nom collection" />
        </div>
        <div class="col-12 mb-2">
          <label for="selectType" class="form-label">Type de la collection</label>

          <div class="card-body">
            <div class="row errorForm">
              <?php foreach (getAllTypes() as $type) : ?>
                <div class="col-6 mb-3">
                  <div class="form-check custom-option custom-option-icon form-check-new">
                    <label class="form-check-label custom-option-content" for="icon-<?= $type["ID"] ?>">
                      <span class="custom-option-body mt-3">
                        <img src="/assets/img/type-icons/type-<?= $type["ID"] ?>.svg" width="50" class="me-2">
                        <span class="custom-option-title"><?= $type["Type_name"] ?></span>

                      </span>
                      <input name="newCollectionTypeId" class="form-check-input" type="radio" value="<?= $type["ID"] ?>" id="icon-<?= $type["ID"] ?>">
                    </label>
                  </div>
                </div><?php endforeach; ?>
            </div>
          </div>
        </div>
        <div class="col-sm-12">
          <label class="switch switch-outline">
            <input type="checkbox" class="switch-input" name="Is_private" value="1" id="isPrivateUpdate">
            <span class="switch-toggle-slider">
              <span class="switch-on"></span>
              <span class="switch-off"></span>
            </span>
            <span class="switch-label">Collection privée</span>
          </label>
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
 <div class="offcanvas offcanvas-end" tabindex="-1" id="editMyCollection" aria-labelledby="offcanvasEndLabel2">
    <div class="offcanvas-header">
      <h5 id="offcanvasEndLabel2" class="offcanvas-title">Editer une collection</h5>
      <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body mx-0 flex-grow-0">
      <form id="editCollectionForm" class="row g-3" method="POST" action="/admin/my-collections-edit">
        <div class="col-12 mb-3 errorForm">
          <label class="form-label" for="editCollectionName">Nouveau nom de cette collection</label>
          <input type="text" id="editCollectionName" name="editCollectionName" class="form-control" placeholder="nom collection" />
        </div>
        <div class="col-12 mb-2">
          <label for="selectType" class="form-label">Type de la collection</label>

          <div class="card-body">
            <div class="row errorForm">
            <?php foreach (getAllTypes() as $type) : ?>
              <div class="col-6 mb-3">
                <div class="form-check custom-option custom-option-icon form-check-edit" id="form-check-<?= $type["ID"] ?>">
                  <label class="form-check-label custom-option-content" for="iconEdit-<?= $type["ID"] ?>">
                    <span class="custom-option-body mt-3">
                    <img src="/assets/img/type-icons/type-<?= $type["ID"] ?>.svg" width="50" class="me-2">
                      <span class="custom-option-title"><?= $type["Type_name"] ?></span>

                    </span>
                    <input name="editCollectionTypeId" class="form-check-input" type="radio" value="<?= $type["ID"] ?>" id="iconEdit-<?= $type["ID"] ?>">
                  </label>
                </div>
              </div><?php endforeach; ?>
            </div>
          </div>
        </div>
        <div class="col-sm-12">
          <label class="switch switch-outline">
            <input type="checkbox" class="switch-input" name="editIs_private" value="1" id="isPrivateEdit">
            <span class="switch-toggle-slider">
              <span class="switch-on"></span>
              <span class="switch-off"></span>
            </span>
            <span class="switch-label">Collection privée</span>
          </label>
        </div>
        <div class="col-12 text-center">
        <input type="hidden" name="hiddenCollectionId" value="undefined" id="hiddenCollectionId">
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
  <script src="/assets/js/crud-my-collections.js"></script>
  <script src="/assets/js/delete-buttons.js"></script>
</body>

</html>