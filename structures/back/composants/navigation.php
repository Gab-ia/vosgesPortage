<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme" data-bg-class="bg-menu-theme" style="touch-action: none; user-select: none; -webkit-user-drag: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);">
  <div class="app-brand demo">
    <a href="/admin/home" class="app-brand-link">
      <span style="color:#d66826ff" class="app-brand-text demo menu-text fw-bold">Vosges <span style="color:#2d698cff;">Portage</span></span>
    </a>

    <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
      <i class="ti menu-toggle-icon d-none d-xl-block ti-sm align-middle"></i>
      <i class="ti ti-x d-block d-xl-none ti-sm align-middle"></i>
    </a>
  </div>

  <div class="menu-inner-shadow"></div>

  <ul class="menu-inner py-1 overflow-auto">
    <!-- Dashboards -->


    <li class="menu-item">
      <a href="javascript:void(0);" class="menu-link menu-toggle">
        <i class="menu-icon tf-icons ti ti-article"></i>
        <div>Mes menus</div>
      </a>
      <ul class="menu-sub">
        <li class="menu-item">
          <a href="/admin/menus" class="menu-link">
            <div>Gérer les menus</div>
          </a>
        </li>
        <li class="menu-item">
          <a href="/admin/importExcelMenus" class="menu-link">
            <div>Importer des Menus</div>
          </a>
        </li>
      </ul>
    </li>


    <?php if (showAdminNav()) : ?>
      <li class="menu-item">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
          <i class="menu-icon tf-icons ti ti-users"></i>
          <div>Utilisateurs</div>
        </a>
        <ul class="menu-sub">
          <li class="menu-item">
            <a href="/admin/users" class="menu-link">
              <div>Liste des utilisateurs</div>
            </a>
          </li>
        </ul>
      </li>

      <li class="menu-item">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
          <i class="menu-icon tf-icons ti ti-users"></i>
          <div>Contacts</div>
        </a>
        <ul class="menu-sub">
          <li class="menu-item">
            <a href="/admin/contacts" class="menu-link">
              <div>Liste des contacts</div>
            </a>
          </li>
        </ul>
      </li>

      <li class="menu-item">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
          <i class="menu-icon tf-icons ti ti-settings"></i>
          <div>Paramètres</div>
        </a>
        <ul class="menu-sub">
          <li class="menu-item">
            <a href="/admin/zone" class="menu-link">
              <div>Gérer les zones desservies</div>
            </a>
          </li>
        </ul>
      </li>
    <?php endif; ?>


    <!-- Components -->

</aside>