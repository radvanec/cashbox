<?php
mb_internal_encoding("UTF-8");
spl_autoload_register(function ($class_name) {
    include "model/".$class_name . '.php';
});
$database = new productsCategoriesManager();
$info = new infoManager();
?>
<!DOCTYPE html>
<html>
    <head>
        <title><?php $info->getSiteTitle(); ?> | Cashbox</title>
        <link rel="stylesheet" href="css/cashbox.css">
    </head>
    <body>
        <header>
            <h1><?php $info->getSiteTitle(); ?></h1>
        </header>
        <main>
            <div id="cashboxLeftColumn">
                
            </div>
            <div id="cashboxRightColumn">
                <div class="cashboxRightColumnHeader">
                        <select id='cashboxCategories'>
                            <option>Vyberte kategorii</option>";
                            <?php $database->showProductsCategories(); ?>
                        </select>
                </div>

            </div>
        </main>
    </body>
</html>
