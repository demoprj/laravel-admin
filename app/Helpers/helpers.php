<?php

if (!function_exists('xx_helper_generate_serial_number')) {
    /**
     * Generate Serial Number Base Length 21 Bits
     * @param string $prefix
     * @return string
     */
    function xx_helper_generate_serial_number(string $prefix = ''): string
    {
        return $prefix . substr(date('YmdHis'), 2) . substr(microtime(), 2, 5) . rand(1000, 9999);
    }
}
