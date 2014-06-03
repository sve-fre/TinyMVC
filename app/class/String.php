<?php

class String {

    public static function contains($haystack, $needle) {
        return (strpos($haystack, $needle) !== false);
    }

}
