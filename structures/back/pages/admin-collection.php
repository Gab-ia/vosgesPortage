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
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Utilisateurs / </span>collections</h4>
            <?php flash(); ?>
            <div class="card">
                <h5 class="card-header">Liste des collections</h5>
                <div class="table-responsive text-nowrap">
                  <table class="table table-hover">
                    <thead>
                      <tr>
                        <th>Collections</th>
                        <th>Utilisateurs</th>
                        <th>Date création</th>
                        <th>Date modification</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                    <?php foreach (getAllCollections() as $collection) : ?>
                      <tr>
                        <td>
                          <img src="/assets/img/type-icons/type-<?= $collection["type_ID"] ?>.svg" width="32"><?= getCollectionStatus($collection["Is_private"]); ?><span class="ps-3"><strong><a href="/admin/view-collection?collectionID=<?= $collection["ID"]  ?>"><?= $collection["Name"]  ?></a></strong></span><span class="badge rounded-pill bg-label-dark ms-2"><?= $collection["Number_items"]  ?></span>
                        </td>
                        <td><a href="/admin/view-user?userID=<?= $collection["user_ID"]  ?>"><?= $collection["First_name"] ." ". $collection["Last_name"]  ?></a></td>
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
                              <a class="dropdown-item update-button" data-id="<?= $collection["ID"] ?>" data-isprivate="<?= $collection["Is_private"] ?>" data-typeid="<?= $collection["ID_type"] ?>" data-text="<?= $collection["Name"] ?>" href="javascript:void(0);" data-bs-target="#editCollection" data-bs-toggle="modal"
                                ><i class="ti ti-pencil me-1"></i> Editer</a>
                              <a class="dropdown-item delete-button" data-id="<?= $collection["ID"] ?>" data-text="<?= $collection["Name"] ?>" href="javascript:void(0);"
                                ><i class="ti ti-trash me-1"></i> Effacer</a>
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
  </div>
  <!-- / Layout wrapper -->

  <!-- edit modal -->
  <div class="modal fade" id="editCollection" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-simple">
    <div class="modal-content p-3 p-md-5">
      <div class="modal-body">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        <div class="text-center mb-4">
          <h3 class="mb-2">Editer une collection</h3>
        </div>
        <form id="updateCollectionForm" class="row g-3" method="POST" action="/admin/update-collection">
          <div class="col-12 mb-3">
            <label class="form-label" for="updateCollectionText">Nouveau nom de cette collection</label>
            <input type="text" id="updateCollectionText" name="updateCollectionText" class="form-control" placeholder="John Doe" />
          </div>
          <div class="col-12 mb-3">
            <label for="selectType" class="form-label">Type de la collection</label>
            <select name="updateCollectionType" id="selectTypeUpdate" class="select2 form-select form-select-lg" data-allow-clear="true">
              <?php foreach (getAllTypes() as $type) : ?>
              <option value="<?= $type["ID"] ?>" id="optionTypeId-<?= $type["ID"] ?>"><?= $type["Type_name"] ?></option>
              <?php endforeach; ?>
            </select>
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
            <input type="hidden" name="collection_id" value="notDefined" id="hiddenCollectionId">
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
  <script src="/assets/js/crud-collection.js"></script>
  <script src="/assets/js/delete-buttons.js"></script>
</body>

</html>