<?php
echo '<pre>';
print_r('a');
echo '</pre>';
die();
return array(
    'Gamebank\Module' => __DIR__ . '/Module.php',
    'Gamebank\Controller\IndexController' => __DIR__ . '/src/Gamebank/Controller/IndexController.php',
);
