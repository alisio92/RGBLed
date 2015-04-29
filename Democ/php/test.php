<?php
$leds = array();

if(isset($_POST['modeSubmit'])){
    if(!empty($_POST['modes'])) {
        if($_POST['modes'] == 'random') {
            random();
        }
    }
}

function random(){
    global $leds;
    while(true){
        for($i = 0; $i < 8;$i++){
            $r= rand(-1, 256);
            $g= rand(-1, 256);
            $b= rand(-1, 256);
            $leds[$i] = $r.":".$g.":".$b;
            echo $leds[$i]."<br/>";
        }
        usleep(1);
    }
}
?>