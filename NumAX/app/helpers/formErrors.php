<?php if(count($errors) > 0) {
                echo '<div class="form-item error">';
                foreach($errors as $error){
                  echo  '<li class="form-label">' . $error .'</li>';
                }
                echo '</div>';}
?>