<?php
include __DIR__ . '/db.php'; 

function getCategories($db) {
    return $db->query("SELECT * FROM categories");
}
function getProducts($db) {
    return $db->query("SELECT * FROM products");
}
function deleteProduct($db, $id) {
    $sql = "DELETE FROM products WHERE id=?";
    $stmt= $db->prepare($sql);
    $stmt->execute([$id]);
}

function deleteCategory($db, $id) {
    $sql = "DELETE FROM categories WHERE id=?";
    $stmt= $db->prepare($sql);
    $stmt->execute([$id]);
}
?>