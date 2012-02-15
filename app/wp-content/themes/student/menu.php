<?php
function head_menu()
{
    echo '<ul class="nav">';

    $menu_loc = 'head_menu';
    if ( ( $locations = get_nav_menu_locations() ) && isset( $locations[ $menu_loc ] ) )
    {
        $menu = wp_get_nav_menu_object( $locations[ $menu_loc ] );
        $n = 0;
        $menu_items = wp_get_nav_menu_items($menu->term_id);
        $last_item = count($menu_items);
        foreach($menu_items as $key=>$first_menu)
        {

            if($first_menu->menu_item_parent == 0)
            {
                print '<li ';
                if($n+1 == $last_item) print 'class="last-item"';
                $item_parent = 0;
                foreach($menu_items as $key1=>$sec_lvl)
                {
                    if($sec_lvl->menu_item_parent==$first_menu->ID)
                    {
                        $item_parent++;
                        if($item_parent == 1)print 'class="nav-level"';
                    }
                }


                print '><a href="'.$first_menu->url.'">'.$first_menu->title.'</a>';
                $n++;
                $i=0;
                foreach($menu_items as $key1=>$sec_lvl)
                {
                    if($sec_lvl->menu_item_parent==$first_menu->ID)
                    {   $i++;
                        if ($i == 1)
                        {
                            print '<div class="submenu"><ul>';
                        }

                        print '<li><a href="'.$sec_lvl->url.'">'.$sec_lvl->title.'</a></li>';
                    }
                }
                if($i!=0)
                {
                    print '</ul>
						<div class="bottom"></div>
					</div>';
                }

                print '</li>';
            }
        }
    }

    echo '</ul>';
}