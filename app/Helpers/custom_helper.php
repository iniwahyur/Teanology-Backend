<?php
function adminLogin () {
    $db = \Config\Database::connect();
    return $db->table('admin')->where('id_admin', session('id_admin'))->get()->getRow();
}

function countData($table) {
    $db = \Config\Database::connect();
    return $db->table($table)->countAllResults();
}
?>