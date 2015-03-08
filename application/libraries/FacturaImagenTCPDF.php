<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

require_once('public/admin/tcpdf/tcpdf.php');

class FacturaImagenTCPDF extends TCPDF {
    //Page header
    
    /*
     * 
     public function Header() {
        // get the current page break margin
        $bMargin = $this->getBreakMargin();
        // get current auto-page-break mode
        $auto_page_break = $this->AutoPageBreak;
        // disable auto-page-break
        $this->SetAutoPageBreak(false, 0);
        // set bacground image
        //$img_file = K_PATH_IMAGES.'image_demo.jpg';
        $img_file = 'public/admin/factura2.jpg';
        $this->Image($img_file, 0, 0, 216, 268, '', '', '', false, 300, '', false, false, 0);
        // restore auto-page-break status
        $this->SetAutoPageBreak($auto_page_break, $bMargin);
        // set the starting point for the page content
        $this->setPageMark();
    }
     * */
     
}
