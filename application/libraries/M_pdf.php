<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

 include_once APPPATH.'/third_party/mpdf/mpdf.php';

class M_pdf {

    public $param;
    public $pdf;

    public function __construct($param = array('orientation' => 1))
    {
        $mode = "en-GB-x";
        $format = 'A4';
        $default_font_size = "";
        $default_font = "";
        $mgl = 10;
        $mgr = 10;
        $mgt = 10;
        $mgb = 10;
        $mgh = 6;
        $mgf = 3;
        $orientation = 'P';

        if($param['orientation'] == 2) {
            $format = 'A4-L';
            $orientation = 'L';
        }
        $this->pdf = new mPDF($mode,$format,$default_font_size,$default_font,$mgl,$mgr,$mgt,$mgb,$mgh,$mgf,$orientation);
    }
}
