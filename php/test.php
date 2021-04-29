<?php
function addFilterCondition($where, $add, $and = true)
{
    if ($where) {
        if ($and) $where .= " AND $add";
        else $where .= " OR $add";
    } else $where = $add;
    return $where;
}

function getMainQuery() {
    return "SELECT * FROM `cartoon` ORDER BY `Рейтинг мультфильма` DESC";
}
if (!empty($_POST["filter"])) {
    $sql = getMainQuery();
    $where = "";

    if ($_POST["vendors"]) {
        $ids = $_POST["vendors"];
        $inQuery = implode(',', array_fill(0, count($ids), '?'));
        $where = addFilterCondition($where, 'vendors.attribute_id IN (' . $inQuery . ')');
    }

    $second = 'ph.item_photo_main=0 ORDER BY i.item_id DESC';

    if ($where) {
        $sql .= " WHERE $where AND " . $second;
    } else {
        $sql .= " WHERE " . $second;
    }
}

?>