<?php
function getCollectionStatus($status) {
    if ($status) {
        return "<span class=\"badge rounded-pill bg-danger badge-dot badge-notifications\"></span>";
    } else {
        return "<span class=\"badge rounded-pill bg-success badge-dot badge-notifications\"></span>";
    }
}
?>