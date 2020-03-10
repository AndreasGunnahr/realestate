<?php
/**
 * Template for displaying search forms in Palmeria.
 */
?>
<form role="search" method="get" class="search-form" action="<?php echo esc_url(home_url('/')); ?>">
    <div class = "row">
         <div class = "container search">
            <label for="search">Search</label>
            <input id = "search" type="search" class="search-field" placeholder="<?php echo esc_attr_x('Search &hellip;', 'placeholder', 'palmeria'); ?>" value="<?php echo get_search_query(); ?>" name="s" />
        </div>
        <button type="submit" class="search-submit">Search</button>
    </div>
    <div class = "row">
        <div class = "container">
            <label for="min_room">Min rooms</label>
            <input type="text" name="min_room" id="min_room" placeholder="Min rooms">
        </div>
        <div class = "container">
		    <label for="max_room">Max rooms</label>
            <input type="text" name="max_room" id="max_room" placeholder="Max rooms">
        </div>
        <div class = "container">
		    <label for="min_price">Min price</label>
            <input type="text" name="min_price" id="min_price" placeholder="Min price">
        </div>
        <div class = "container">
		    <label for="max price">Max price</label>
            <input type="text" name="max_price" id="max_price" placeholder="Max price">
        </div>
    </div>
</form>