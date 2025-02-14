<!DOCTYPE html>

<html lang="en" class="light-style layout-navbar-fixed layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="/assets/" data-template="vertical-menu-template-no-customizer-starter">
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

        <div class="content-wrapper">
          <!-- Content -->

          <div class="container-xxl flex-grow-1 container-p-y">
            <?php flash(); ?>
            <!-- Users List Table -->
            <div class="card">
              <div class="card-header border-bottom">
                <h5 class="card-title mb-3">Filtrer les résultats</h5>
                <div class="d-flex justify-content-between align-items-center row pb-2 gap-3 gap-md-0">
                  <div class="col-md-6 user_plan"></div>
                  <div class="col-md-6 user_status"></div>
                  <div class="col-md-6 empty"></div>
                </div>
              </div>
              <div class="card-datatable table-responsive">
                <table class="datatables-users table border-top">
                  <thead>
                    <tr>
                      <th></th>
                      <th>User</th>
                      <th>Pseudo</th>
                      <th>Telephone</th>
                      <th>Role</th>
                      <th>Date création</th>
                      <th>Statut mail</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                </table>
              </div>
              <!-- Offcanvas to add new user -->
              <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasEditUser" aria-labelledby="offcanvasAddUserLabel">
                <div class="offcanvas-header">
                  <h5 id="offcanvasAddUserLabel" class="offcanvas-title">Editer un utilisateur</h5>
                  <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body mx-0 flex-grow-0 pt-0 h-100">
                  <form class="add-new-user pt-0" id="editUserForm" method="post" action="users-update">
                    <div class="mb-3">
                      <label class="form-label" for="editPseudo">Pseudo</label>
                      <input type="text" class="form-control" id="editPseudo" placeholder="Ex : micheline" name="pseudo" aria-label="Ex : micheline" />
                    </div>
                    <div class="mb-3">
                      <label class="form-label" for="editPseudo">Prénom</label>
                      <input type="text" class="form-control" id="editPrenom" placeholder="Ex : micheline" name="prenom" aria-label="Ex : micheline" />
                    </div>
                    <div class="mb-3">
                      <label class="form-label" for="editPseudo">Nom</label>
                      <input type="text" class="form-control" id="editNom" placeholder="Ex : Durand" name="nom" aria-label="Ex : Durand" />
                    </div>
                    <div class="mb-3">
                      <label class="form-label" for="add-user-email">Email</label>
                      <input type="text" id="editEmail" class="form-control" placeholder="ex : john.doe@example.com" aria-label="john.doe@example.com" name="email" />
                    </div>
                    <div class="col-sm-12 mb-3">
                      <label class="switch switch-outline">
                        <input type="checkbox" class="switch-input" name="email_verified" id="editEmailVerified">
                        <span class="switch-toggle-slider">
                          <span class="switch-on"></span>
                          <span class="switch-off"></span>
                        </span>
                        <span class="switch-label">Email validé</span>
                      </label>
                    </div>
                    <div class="mb-3">
                      <label class="form-label" for="add-user-email">Téléphone</label>
                      <input type="text" id="editTelephone" class="form-control" placeholder="ex : (+00 33) 1234455676" aria-label="ex : (+00 33) 1234455676" name="telephone" />
                    </div>
                    <div class="col-sm-12 mb-3">
                      <label class="switch switch-outline">
                        <input type="checkbox" class="switch-input" name="is_admin" id="editIsAdmin">
                        <span class="switch-toggle-slider">
                          <span class="switch-on"></span>
                          <span class="switch-off"></span>
                        </span>
                        <span class="switch-label">Administrateur</span>
                      </label>
                    </div>



                    <input type="hidden" name="userid" value="undefined" id="editHiddenUserId">
                    <button type="submit" class="btn btn-primary mb-3 w-100">MODIFIER</button>
                    <button type="reset" class="btn btn-label-secondary w-100" data-bs-dismiss="offcanvas">ANNULER</button>
                  </form>
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
  <div class="modal fade" id="changePassword" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-simple">
      <div class="modal-content p-3 p-md-5">
        <div class="modal-body">
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          <div class="text-center mb-4">
            <h3 class="mb-2">Changer le mot de passe</h3>
            <p class="text-muted">Utilisateur "<span id="FullNameUser"></span>"</p>
          </div>
          <form id="changePasswordForm" class="row g-3" method="POST" action="/admin/users-password-change">
            <div class="mb-3 col-12 form-password-toggle">
              <label class="form-label" for="changePasswordFirst">Nouveau mot de passe</label>
              <div class="input-group input-group-merge">
                <input class="form-control" type="password" id="changePasswordFirst" name="newPassword" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" />
                <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
              </div>
            </div>

            <div class="mb-3 col-12 form-password-toggle">
                            <label class="form-label" for="changePasswordSecond">Confirmation du mot de passe</label>
                            <div class="input-group input-group-merge">
                              <input
                                class="form-control"
                                type="password"
                                name="confirmPassword"
                                id="changePasswordSecond"
                                placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                              />
                              <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                            </div>
                          </div>
            <div class="col-12 text-center">
              <input type="hidden" name="user_id" value="notDefined" id="hiddenUserId">
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
  <script src="/assets/vendor/libs/typeahead-js/typeahead.js"></script>

  <script src="/assets/vendor/js/menu.js"></script>
  <!-- endbuild -->

  <!-- Vendors JS -->
  <script src="/assets/vendor/libs/moment/moment.js"></script>
  <script src="/assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js"></script>
  <script src="/assets/vendor/libs/select2/select2.js"></script>
  <script src="/assets/vendor/libs/sweetalert2/sweetalert2.js"></script>
  <script src="/assets/vendor/libs/formvalidation/dist/js/FormValidation.min.js"></script>
  <script src="/assets/vendor/libs/formvalidation/dist/js/plugins/Bootstrap5.min.js"></script>
  <script src="/assets/vendor/libs/formvalidation/dist/js/plugins/AutoFocus.min.js"></script>
  <script src="/assets/vendor/libs/cleavejs/cleave.js"></script>
  <script src="/assets/vendor/libs/cleavejs/cleave-phone.js"></script>

  <!-- Main JS -->
  <script src="/assets/js/main.js"></script>

  <!-- Page JS -->
  <script src="/assets/js/delete-buttons.js"></script>
  <script src="/assets/js/app-user-w.js"></script>

</body>

</html>