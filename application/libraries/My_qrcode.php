<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once(APPPATH . 'third_party/phpqrcode/qrlib.php');

class My_qrcode {
    public function __construct() {
        // QRcode library loaded
    }

    public function generate($data, $filename = false, $level = 'L', $size = 4) {
        // Generate QR code
        QRcode::png($data, $filename, $level, $size);
    }
}
