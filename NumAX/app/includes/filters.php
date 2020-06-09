<?php
include(ROOT_PATH . '/app/database/connect.php');
include(ROOT_PATH . '/app/helpers/filterOptions.php');
?>


<form id="filter-form" class="filter-section" action="?" method="post">
            <div class="filter-option">
                <h4>Country</h4>
                    <select class="filter-input" name="country" id='country'form="filter-form" value="<?php echo $country; ?>">
                    <option value="All">All</option>
                    <?php
                $country = getCountry();
                foreach ($country as $countryDetails) {
                ?>
                        <option value="<?php echo $countryDetails["country"]; ?>"><?php echo $countryDetails["country"]; ?></option><?php }?></select>
            </div>
     
        <div class="filter-option">
            <h4>Composition</h4>
                <select class="filter-input" name="composition" id='composition'form="filter-form" value="<?php echo $compositionDetails["composition"]; ?>">
                <option value="All">All</option>
                <?php
            $composition = getComposition();
            foreach ($composition as $compositionDetails) {
            ?>
                    <option value="<?php echo $compositionDetails["composition"]; ?>"><?php echo $compositionDetails["composition"]; ?></option><?php }?></select>
        </div>
   

    <div class="filter-option">
        <h4>Shape</h4>
        
            <select class="filter-input" name="shape" id ='shape'form="filter-form" value="<?php echo $shape; ?>">
            <option value="All">All</option>
            <?php $shape = getShape();
        foreach ($shape as $shapeDetails) {
        ?>
                <option value="<?php echo $shapeDetails["shape"]; ?>"><?php echo $shapeDetails["shape"]; ?></option><?php } ?></select>
    </div>

        </div>
    <div class="form-item">
        <button type="submit" name="filter-btn" class="btn form-btn">Filter</button>
    </div>
</form>
