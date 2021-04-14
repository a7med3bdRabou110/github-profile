
<?php 

    function lang($phase){
        static $lang=array(
            "MESSAGE" => "Welcome in arabic" , 
            "ADMIN" => "Admin in arabic"
        );
        return $lang[$phase];
    }

?>