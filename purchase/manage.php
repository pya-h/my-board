<?php
$pid = null;
try {
    $product = get_product(
        get_url_param($_SERVER['REQUEST_URI'], "id")
    );
    $_SESSION[ORDER_PRODUCT_ID] = $product[PRODUCT_ID];
    $_SESSION[ORDER_COST] = $product[PRODUCT_PRICE] * 10; //toman => rials
    $_SESSION[ORDER_PRODUCT_NAME] = $product[PRODUCT_TITLE];
    // some other stuff matbe
    header("Location: " . ROUTE_ZARINCALL);
} catch (Exception $ex) {
    $_SESSION[ERROR] = [ERR_TITLE => "خطا در خرید", ERR_MSG => $ex, ERR_IMG => null];
    // do some other stuff
}
?>
