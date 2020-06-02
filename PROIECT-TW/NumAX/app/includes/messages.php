<?php if(isset($_SESSION['message'])): ?>
        <div class="form-item <?php echo $_SESSION['type'];  ?>">
            <li class="form-label">
                <?php echo $_SESSION['message'];  ?>    
            </li>
        </div>

    <?php 
        unset($_SESSION['message'], $_SESSION['type']);
    ?>


    <?php endif; ?>