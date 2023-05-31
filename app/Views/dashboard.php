<!DOCTYPE html>
<html lang="en">
<?php 
        include("head.php"); 
     ?>
<body>
        <section class="main">
                    
        <div class="sidebardiv">
                <?php 
                        include("sidebar.php");  
                ?> 
        </div>
        <div class="content">
                <div class="navbardiv">
                        <?php 
                                include("navbar.php"); 
                        ?>
                </div>
                <div class="data_content">
                        <?=  $this->include(esc($content));  ?>
                </div>
        </div>
        </section>
</body>
</html>