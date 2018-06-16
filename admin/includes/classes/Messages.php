<?php

/**
* Messages Class
*/

class Messages {

    public static function setMsg($text, $type){

        if ($type == 'error') {
            $_SESSION['error_msg'] = $text;
        } else {
            $_SESSION['success_msg'] = $text;
        }
    }

    public static function display(){

        if (isset($_SESSION['error_msg'])){

            echo '<div class="ui negative small message"><i class="close icon"></i><div class="header">'.$_SESSION['error_msg'].'</div></div>';
            unset($_SESSION['error_msg']);
        }

        if (isset($_SESSION['success_msg'])){

            echo '<div class="ui positive small message"><i class="close icon"></i><div class="header">'.$_SESSION['success_msg'].'</div></div>';
            unset($_SESSION['success_msg']);
        }
    }
}