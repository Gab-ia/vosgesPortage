 <?php
    function flash()
    {

        // Vérifier si un message flash est présent
        if (isset($_SESSION['flash'])) {

            foreach ($_SESSION['flash'] as $flash) {

                $message = $flash['message'];
                $status = $flash['status'];

                switch ($status) {
                    case 'success':
                        $icon = 'check';
                        break;
                    case 'danger':
                        $icon = 'ban';
                        break;
                    case 'warning':
                        $icon = 'bell';
                }

                // Afficher le message avec le statut approprié

                echo '<div class="alert alert-' . $status . ' d-flex align-items-center alert-w" role="alert">
                    <span class="alert-icon text-' . $status . ' me-2">
                    <i class="ti ti-' . $icon . ' ti-xs"></i>
                    </span>' .
                    $message
                    . '</div>';
            }
            // Supprimer le message de la session
            unset($_SESSION['flash']);
        }
    }

    function setFlash($message, $status)
    {

        $_SESSION['flash'][] = array(
            'message' => $message,
            'status' => $status
        );
    }

    // set flash 2 parametre ... le msg et le status
    ?>

