<?php
$current_menu = '3';
function wp_get_menu_array($current_menu)
{

    $array_menu = wp_get_nav_menu_items($current_menu);
    $menu = array();
    foreach ($array_menu as $father) {
        if (empty($father->menu_item_parent)) {
            $menu[$father->ID] = array();
            $menu[$father->ID]['ID']             =   $father->ID;
            $menu[$father->ID]['title']          =   $father->title;
            $menu[$father->ID]['url']            =   $father->url;
            $menu[$father->ID]['children']       =   array();
            $childMenu = array();
            foreach ($array_menu as $child) {
                if ($child->menu_item_parent == $father->ID) {
                    $childMenu[$child->ID] = array();
                    $childMenu[$child->ID]['ID']          =   $child->ID;
                    $childMenu[$child->ID]['title']       =   $child->title;
                    $childMenu[$child->ID]['url']         =   $child->url;
                    $childMenu[$child->ID]['children']       =   array();
                    $grandChildMenu = array();
                    foreach ($array_menu as $grandfather) {
                        if ($grandfather->menu_item_parent == $child->ID) {
                            $grandChildMenu[$grandfather->ID] = array();
                            $grandChildMenu[$grandfather->ID]['ID']          =   $grandfather->ID;
                            $grandChildMenu[$grandfather->ID]['title']       =   $grandfather->title;
                            $grandChildMenu[$grandfather->ID]['url']         =   $grandfather->url;
                            $childMenu[$grandfather->menu_item_parent]['children'][$grandfather->ID] = $grandChildMenu[$grandfather->ID];
                        }
                    }
                    $menu[$child->menu_item_parent]['children'][$child->ID] = $childMenu[$child->ID];
                }
            }
        }
    }
    return $menu;
}

?>
