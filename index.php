<?php 

// Cargar las librerias
require 'vendor/autoload.php';

// Load vars static or dinamics
$contenidoDinamico = "Prueba";

// Cargar paquete para usar el modulo de Dompdf
use Dompdf\Dompdf;
use Dompdf\Options;

// Instanciar la clase Dompdf para su posterior utilizacion
$dompdf = new Dompdf();

// habilitar imagenes remotas
$options = new Options();
$options->set('isRemoteEnabled', true);
$dompdf = new Dompdf($options);


// Elemento de plantilla, en el ejempo puedes ver como pasar campos dinamicos
$htmlTemplate = '
			<style>
			.invoice-box {
				max-width: 800px;
				margin: auto;
				padding: 30px;
				font-size: 16px;
				line-height: 24px;
				font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;
				color: #555;
			}
			.invoice-box table {
				width: 100%;
				line-height: inherit;
				text-align: left;
			}
			.invoice-box table td {
				padding: 5px 10px;
				vertical-align: top;
			}
			.invoice-box table tr td:nth-child(2) {
				text-align: right;
			}
			.invoice-box table tr.top table td {
				padding-bottom: 0px;
			}
			.invoice-box table tr.top table td.title {
				font-size: 45px;
				line-height: 45px;
				color: #333;
			}
			.invoice-box table tr.information table td {
				padding-bottom: 0px;
			}
			.invoice-box table tr.heading td {
				background: #eee;
				border-bottom: 1px solid #ddd;
				font-weight: bold;
			}
			.invoice-box table tr.details td {
				padding-bottom: 20px;
			}
			.invoice-box table tr.item td {
				border-bottom: 1px solid #eee;
			}
			.invoice-box table tr.item.last td {
				border-bottom: none;
			}
			.invoice-box table tr.total td:nth-child(2) {
				border-top: 2px solid #eee;
				font-weight: bold;
			}
			@media only screen and (max-width: 600px) {
				.invoice-box table tr.top table td {
					width: 100%;
					display: block;
					text-align: center;
				}
				.invoice-box table tr.information table td {
					width: 100%;
					display: block;
					text-align: center;
				}
			}
			/** RTL **/
			.invoice-box.rtl {
				direction: rtl;
				font-family: Tahoma, "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;
			}
			.invoice-box.rtl table {
				text-align: right;
			}
			.invoice-box.rtl table tr td:nth-child(2) {
				text-align: left;
			}

      .in_invoice.in_style1 .in_invoice_right {
    -webkit-box-flex: 0;
        -ms-flex: none;
            flex: none;
    width: 60%;
  }

  .in_invoice.in_style1 .in_invoice_table {
    grid-gap: 1px;
  }

  .in_invoice.in_style1 .in_invoice_table > * {
    border: 1px solid #dbdfea;
    margin: -1px;
    padding: 8px 15px 10px;
  }

  .in_invoice.in_style1 .in_invoice_head {
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-pack: justify;
        -ms-flex-pack: justify;
            justify-content: space-between;
  }

  .in_invoice.in_style1 .in_invoice_head .in_invoice_right div {
    line-height: 1em;
  }

  .in_invoice.in_style1 .in_invoice_info {
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-align: center;
        -ms-flex-align: center;
            align-items: center;
    -webkit-box-pack: justify;
        -ms-flex-pack: justify;
            justify-content: space-between;
  }

  .in_invoice.in_style1 .in_invoice_info_2 {
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-pack: justify;
        -ms-flex-pack: justify;
            justify-content: space-between;
    border-top: 1px solid #dbdfea;
    border-bottom: 1px solid #dbdfea;
    padding: 11px 0;
  }

  .in_invoice.in_style1 .in_invoice_seperator {
    min-height: 18px;
    border-radius: 1.6em;
    -webkit-box-flex: 1;
        -ms-flex: 1;
            flex: 1;
    margin-right: 20px;
  }

  .in_invoice.in_style1 .in_invoice_info_list {
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
  }

  .in_invoice.in_style1 .in_invoice_info_list > *:not(:last-child) {
    margin-right: 20px;
  }

  .in_invoice.in_style1 .in_logo img {
    max-height: 50px;
  }

  .in_invoice.in_style1 .in_logo.in_size1 img {
    max-height: 60px;
  }

  .in_invoice.in_style1 .in_logo.in_size2 img {
    max-height: 70px;
  }

  .in_invoice.in_style1 .in_grand_total {
    padding: 8px 15px;
  }

  .in_invoice.in_style1 .in_box_3 {
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
  }

  .in_invoice.in_style1 .in_box_3 > * {
    -webkit-box-flex: 1;
        -ms-flex: 1;
            flex: 1;
  }

  .in_invoice.in_style1 .in_box_3 ul {
    margin: 0;
    padding: 0;
    list-style: none;
  }

  .in_invoice.in_style1 .in_box_3 ul li {
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
  }

  .in_invoice.in_style1 .in_box_3 ul li:not(:last-child) {
    margin-bottom: 5px;
  }

  .in_invoice.in_style1 .in_box_3 ul span {
    -webkit-box-flex: 0;
        -ms-flex: none;
            flex: none;
  }

  .in_invoice.in_style1 .in_box_3 ul span:first-child {
    margin-right: 5px;
  }

  .in_invoice.in_style1 .in_box_3 ul span:last-child {
    -webkit-box-flex: 1;
        -ms-flex: 1;
            flex: 1;
  }

  .in_invoice.in_style2 .in_invoice_head {
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-align: center;
        -ms-flex-align: center;
            align-items: center;
    border-bottom: 1px solid #dbdfea;
    padding-bottom: 15px;
    position: relative;
  }

  .in_invoice.in_style2 .in_invoice_left {
    width: 30%;
    -webkit-box-flex: 0;
        -ms-flex: none;
            flex: none;
  }

  .in_invoice.in_style2 .in_invoice_right {
    width: 70%;
    -webkit-box-flex: 0;
        -ms-flex: none;
            flex: none;
  }

  .in_invoice.in_style2 .in_invoice_info {
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
  }

  .in_invoice.in_style2 .in_invoice_info_left {
    width: 30%;
    -webkit-box-flex: 0;
        -ms-flex: none;
            flex: none;
  }

  .in_invoice.in_style2 .in_invoice_info_right {
    width: 70%;
    -webkit-box-flex: 0;
        -ms-flex: none;
            flex: none;
  }

  .in_invoice.in_style2 .in_logo img {
    max-height: 60px;
  }

  .in_invoice.in_style2 .in_invoice_title {
    line-height: 0.8em;
  }

  .in_invoice.in_style2 .in_invoice_info_in {
    padding: 12px 20px;
    border-radius: 10px;
  }

  .in_invoice.in_style2 .in_card_note {
    display: inline-block;
    padding: 6px 15px;
    border-radius: 6px;
    margin-bottom: 10px;
    margin-top: 5px;
  }

  .in_invoice.in_style2 .in_invoice_footer .in_left_footer {
    padding-left: 0;
  }

  .in_invoice.in_style1.in_type1 {
    padding: 0px 50px 30px;
    position: relative;
    overflow: hidden;
    border-radius: 0;
  }

  .in_invoice.in_style1.in_type1 .in_invoice_head {
    height: 110px;
    position: relative;
  }

  .in_invoice.in_style1.in_type1 .in_shape_bg {
    position: absolute;
    height: 100%;
    width: 70%;
    -webkit-transform: skewX(35deg);
            transform: skewX(35deg);
    top: 0px;
    right: -100px;
    overflow: hidden;
  }

  .in_invoice.in_style1.in_type1 .in_shape_bg img {
    height: 100%;
    width: 100%;
    -o-object-fit: cover;
      object-fit: cover;
    -webkit-transform: skewX(-35deg) translateX(-45px);
            transform: skewX(-35deg) translateX(-45px);
  }

  .in_invoice.in_style1.in_type1 .in_invoice_right {
    position: relative;
    z-index: 2;
  }

  .in_invoice.in_style1.in_type1 .in_logo img {
    max-height: 70px;
  }

  .in_invoice.in_style1.in_type1 .in_invoice_seperator {
    margin-right: 0;
    border-radius: 0;
    -webkit-transform: skewX(35deg);
            transform: skewX(35deg);
    position: absolute;
    height: 100%;
    width: 57.5%;
    right: -60px;
    overflow: hidden;
    border: none;
  }

  .in_invoice.in_style1.in_type1 .in_invoice_seperator img {
    height: 100%;
    width: 100%;
    -o-object-fit: cover;
      object-fit: cover;
    -webkit-transform: skewX(-35deg);
            transform: skewX(-35deg);
    -webkit-transform: skewX(-35deg) translateX(-10px);
            transform: skewX(-35deg) translateX(-10px);
  }

  .in_invoice.in_style1.in_type1 .in_invoice_info {
    position: relative;
    padding: 4px 0;
  }

  .in_invoice.in_style1.in_type1 .in_card_note,
  .in_invoice.in_style1.in_type1 .in_invoice_info_list {
    position: relative;
    z-index: 1;
  }

  .in_border_bottom {
  border-bottom: 1px solid #dbdfea;
}

  @media (min-width: 500px) {
    .in_invoice.in_style1.in_type2 {
      position: relative;
      overflow: hidden;
      border-radius: 0;
    }
    .in_invoice.in_style1.in_type2 td {
      padding-top: 12px;
      padding-bottom: 12px;
    }
    .in_invoice.in_style1.in_type2 .in_pt0 {
      padding-top: 0;
    }
    .in_invoice.in_style1.in_type2 .in_bars {
      display: -webkit-box;
      display: -ms-flexbox;
      display: flex;
      position: absolute;
      top: 0px;
      left: 50%;
      -webkit-transform: translateX(-50%);
              transform: translateX(-50%);
      overflow: hidden;
      padding: 0 15px;
    }
    .in_invoice.in_style1.in_type2 .in_bars span {
      height: 100px;
      width: 5px;
      display: block;
      margin: -15px 20px 0;
      -webkit-transform: rotate(-40deg);
              transform: rotate(-40deg);
    }
    .in_invoice.in_style1.in_type2 .in_bars.in_type1 {
      top: initial;
      bottom: 0;
    }
    .in_invoice.in_style1.in_type2 .in_bars.in_type1 span {
      margin: 0 20px 0;
      position: relative;
      bottom: -15px;
    }
    .in_invoice.in_style1.in_type2 .in_shape {
      height: 230px;
      width: 250px;
      position: absolute;
      top: 0;
      right: 0;
      overflow: hidden;
    }
    .in_invoice.in_style1.in_type2 .in_shape .in_shape_in {
      position: absolute;
      height: 350px;
      width: 350px;
      -webkit-transform: rotate(40deg);
              transform: rotate(40deg);
      top: -199px;
      left: 67px;
      overflow: hidden;
    }
    .in_invoice.in_style1.in_type2 .in_shape.in_type1 {
      top: initial;
      bottom: 0;
      right: initial;
      left: 0;
    }
    .in_invoice.in_style1.in_type2 .in_shape.in_type1 .in_shape_in {
      top: 135px;
      left: -153px;
    }
    .in_invoice.in_style1.in_type2 .in_shape_2 {
      height: 120px;
      width: 120px;
      border: 5px solid currentColor;
      padding: 20px;
      position: absolute;
      bottom: -30px;
      right: 77px;
      -webkit-transform: rotate(45deg);
              transform: rotate(45deg);
    }
    .in_invoice.in_style1.in_type2 .in_shape_2 .in_shape_2_in {
      height: 100%;
      width: 100%;
      border: 20px solid currentColor;
    }
    .in_invoice.in_style1.in_type2 .in_shape_2.in_type1 {
      left: -76px;
      right: initial;
      bottom: 245px;
    }
    .in_invoice.in_style1.in_type2 .in_shape_2.in_type1 .in_shape_2_in {
      border-width: 6px;
    }
    .in_invoice.in_style1.in_type2 .in_invoice_right {
      width: 40%;
    }
    .in_invoice.in_style1.in_type2 .in_logo img {
      max-height: 65px;
    }
    .in_invoice.in_style1.in_type2 .in_invoice_footer {
      margin-bottom: 120px;
    }
    .in_invoice.in_style1.in_type2 .in_right_footer {
      position: relative;
      padding: 6px 0;
    }
    .in_invoice.in_style1.in_type2 .in_right_footer table {
      position: relative;
      z-index: 2;
    }
    .in_invoice.in_style1.in_type2 .in_left_footer {
      padding: 5px 0px;
    }
    .in_invoice.in_style1.in_type2 .in_shape_3 {
      position: absolute;
      top: 0;
      left: -40px;
      height: 100%;
      width: calc(100% + 150px);
      -webkit-transform: skewX(35deg);
              transform: skewX(35deg);
    }
    .in_invoice.in_style1.in_type2 .in_shape_4 {
      position: absolute;
      bottom: 200px;
      left: 0;
      height: 200px;
      width: 200px;
    }
  }

  .in_invoice.in_style1.in_type3 {
    position: relative;
    overflow: hidden;
    border-radius: 0;
  }

  .in_invoice.in_style1.in_type3 .in_shape_1 {
    position: absolute;
    top: -1px;
    left: 0;
  }

  .in_invoice.in_style1.in_type3 .in_shape_2 {
    position: absolute;
    bottom: 0;
    left: 0;
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
  }

  .in_invoice.in_style1.in_type3 .in_logo img {
    max-height: 60px;
  }

  .in_invoice.in_style1.in_type3 .in_invoice_head.in_mb20 {
    margin-bottom: 65px;
  }

  .in_invoice.in_style1.in_type3 .in_invoice_info_list {
    position: relative;
    padding: 10px 0 10px 40px;
  }

  .in_invoice.in_style1.in_type3 .in_invoice_info_list_bg {
    position: absolute;
    height: 100%;
    width: calc(100% + 100px);
    top: 0;
    left: 0;
    border-radius: 20px 0 0 0px;
    -webkit-transform: skewX(-35deg);
            transform: skewX(-35deg);
  }

  .in_invoice.in_style2.in_type1 {
    padding-top: 0;
    padding-bottom: 0;
    border-width: 40px 0 0;
    border-style: solid;
    position: relative;
    overflow: hidden;
  }

  .in_invoice.in_style2.in_type1.in_small_border {
    border-width: 7px 0 0;
  }

  .in_invoice.in_style2.in_type1 .in_shape_bg {
    position: absolute;
    height: 100%;
    width: 42%;
    -webkit-transform: skewX(-35deg);
            transform: skewX(-35deg);
    top: 0px;
    left: -100px;
  }

  .in_invoice.in_style2.in_type1 .in_invoice_head {
    padding-top: 15px;
    border-bottom: none;
  }
 
  .in_width_1 {
  width: 8.33333333%;
}

.in_width_2 {
  width: 16.66666667%;
}

.in_width_3 {
  width: 25%;
}

.in_width_4 {
  width: 33.33333333%;
}

.in_width_5 {
  width: 41.66666667%;
}

.in_text_right {
  text-align: right;
}
.in_text_left {
  text-align: left!important;
}

.in_semi_bold {
  font-weight: 600;
}

.in_accent_bg,
.in_accent_bg_hover:hover {
  background-color:#86b133;
  color:#fff;
}

th {
    padding: 10px 15px;
    line-height: 1.55em;
}
 
    .in_invoice_footer {
  /*display: -webkit-box;
  display: -ms-flexbox;
  display: flex;*/
}

.in_invoice_footer table {
  margin-top: -1px;
}

.in_invoice_footer .in_left_footer {
  width: 60%;
  padding: 5px 0px;
 float: left;
}

.in_invoice_footer .in_right_footer {
  width: 37%;
  float: right;
}
.in_bold {
  font-weight: 700;
}
.in_primary_color {
  color: #86b133;
}

.triangle-bottomleft {
      width: 25%;
      height: 0;
      border-top: 100px solid #86b133;
      border-right: 100px solid transparent;
      position:absolute;
    }



/*--------------------------------------------------------------
  Will apply only print window
----------------------------------------------------------------*/
@media print {
  .in_gray_bg {
    background-color: #f5f6fa !important;
    -webkit-print-color-adjust: exact;
  }

  .in_ternary_bg {
    background-color: #b5b5b5 !important;
    -webkit-print-color-adjust: exact;
  }

  .in_primary_bg {
    background-color: #111 !important;
    -webkit-print-color-adjust: exact;
  }

  .in_secondary_bg {
    background-color: #666 !important;
    -webkit-print-color-adjust: exact;
  }

  .in_accent_bg {
    background-color: #86b133;
    -webkit-print-color-adjust: exact;
  }

  .in_accent_bg_10 {
    background-color: rgba(0, 122, 255, 0.1) !important;
    -webkit-print-color-adjust: exact;
  }

  .in_accent_bg_20 {
    background-color: rgba(0, 122, 255, 0.15) !important;
    -webkit-print-color-adjust: exact;
  }

  .in_white_color {
    color: #fff !important;
    -webkit-print-color-adjust: exact;
  }

  .in_accent_color {
    color: #007aff !important;
    -webkit-print-color-adjust: exact;
  }

  .in_ternary_color {
    color: #b5b5b5 !important;
    -webkit-print-color-adjust: exact;
  }

  .in_hide_print {
    display: none !important;
  }

  .in_dark_invoice .in_gray_bg {
    background-color: #111 !important;
    -webkit-print-color-adjust: exact;
  }

  .in_dark_invoice {
    background: #111 !important;
    color: rgba(255, 255, 255, 0.65) !important;
    -webkit-print-color-adjust: exact;
  }

  .in_dark_invoice .in_gray_bg {
    background: rgba(255, 255, 255, 0.05) !important;
    -webkit-print-color-adjust: exact;
  }

  hr {
    background: #dbdfea !important;
    -webkit-print-color-adjust: exact;
  }

  .in_col_4,
  .in_col_4.in_col_2_md {
    -ms-grid-columns: (1fr)[4];
    grid-template-columns: repeat(4, 1fr);
  }

  .in_col_2_md {
    -ms-grid-columns: (1fr)[2];
    grid-template-columns: repeat(2, 1fr);
  }

  .in_mb1 {
    margin-bottom: 1px;
  }

  .in_mb2 {
    margin-bottom: 2px;
  }

  .in_mb3 {
    margin-bottom: 3px;
  }

  .in_mb4 {
    margin-bottom: 4px;
  }

  .in_mb5 {
    margin-bottom: 5px;
  }

  .in_mb6 {
    margin-bottom: 6px;
  }

  .in_mb7 {
    margin-bottom: 7px;
  }

  .in_mb8 {
    margin-bottom: 8px;
  }

  .in_mb9 {
    margin-bottom: 9px;
  }

  .in_mb10 {
    margin-bottom: 10px;
  }

  .in_mb11 {
    margin-bottom: 11px;
  }

  .in_mb12 {
    margin-bottom: 12px;
  }

  .in_mb13 {
    margin-bottom: 13px;
  }

  .in_mb14 {
    margin-bottom: 14px;
  }

  .in_mb15 {
    margin-bottom: 15px;
  }

  .in_mb16 {
    margin-bottom: 16px;
  }

  .in_mb17 {
    margin-bottom: 17px;
  }

  .in_mb18 {
    margin-bottom: 18px;
  }

  .in_mb19 {
    margin-bottom: 19px;
  }

  .in_mb20 {
    margin-bottom: 20px;
  }

  .in_mb21 {
    margin-bottom: 21px;
  }

  .in_mb22 {
    margin-bottom: 22px;
  }

  .in_mb23 {
    margin-bottom: 23px;
  }

  .in_mb24 {
    margin-bottom: 24px;
  }

  .in_mb25 {
    margin-bottom: 25px;
  }

  .in_mb26 {
    margin-bottom: 26px;
  }

  .in_mb27 {
    margin-bottom: 27px;
  }

  .in_mb28 {
    margin-bottom: 28px;
  }

  .in_mb29 {
    margin-bottom: 29px;
  }

  .in_mb30 {
    margin-bottom: 30px;
  }

  .in_mb40 {
    margin-bottom: 40px;
  }

  .in_mobile_hide {
    display: block;
  }

  .in_invoice {
    padding: 10px;
  }

  .in_invoice .in_right_footer {
    width: 42%;
  }

  .in_invoice_footer {
    -webkit-box-orient: initial;
    -webkit-box-direction: initial;
    -ms-flex-direction: initial;
    flex-direction: initial;
  }

  .in_invoice_footer .in_left_footer {
    width: 60%;
    padding: 5px 0px;
    -webkit-box-flex: 0;
    -ms-flex: none;
    flex: none;
    border-top: none;
    margin-top: 0px;
  }

  .in_invoice.in_style2 .in_card_note {
    margin-top: 5px;
  }

  .in_note.in_text_center {
    text-align: center;
  }

  .in_note.in_text_center p br {
    display: initial;
  }

  .in_invoice_footer.in_type1 {
    -webkit-box-orient: initial;
    -webkit-box-direction: initial;
    -ms-flex-direction: initial;
    flex-direction: initial;
  }

  .in_invoice.in_style2 .in_invoice_head {
    -webkit-box-orient: initial;
    -webkit-box-direction: initial;
    -ms-flex-direction: initial;
    flex-direction: initial;
  }

  .in_invoice.in_style2 .in_invoice_head>.in_invoice_left {
    width: 30%;
  }

  .in_invoice.in_style2 .in_invoice_head>.in_invoice_right {
    width: 70%;
  }

  .in_invoice.in_style2 .in_invoice_head .in_invoice_left {
    margin-bottom: initial;
  }

  .in_invoice.in_style2 .in_invoice_head .in_text_right {
    text-align: right;
  }

  .in_invoice.in_style2 .in_invoice_info {
    -webkit-box-orient: initial;
    -webkit-box-direction: initial;
    -ms-flex-direction: initial;
    flex-direction: initial;
  }

  .in_invoice.in_style2 .in_invoice_info>.in_invoice_info_left {
    width: 30%;
  }

  .in_invoice.in_style2 .in_invoice_info>.in_invoice_info_right {
    width: 70%;
  }

  .in_invoice.in_style1.in_type1 {
    padding: 0px 20px 30px;
  }

  .in_invoice.in_style1.in_type1 .in_invoice_head {
    height: 180px;
  }

  .in_invoice.in_style1.in_type1 .in_invoice_info {
    padding: 4px 0;
    -webkit-box-orient: initial;
    -webkit-box-direction: initial;
    -ms-flex-direction: initial;
    flex-direction: initial;
    -webkit-box-align: center;
    -ms-flex-align: center;
    align-items: center;
  }

  .in_invoice.in_style1.in_type1 .in_invoice_seperator {
    top: initial;
    margin-right: 0;
    border-radius: 0;
    -webkit-transform: skewX(35deg);
    transform: skewX(35deg);
    position: absolute;
    height: 100%;
    width: 57.5%;
    right: -60px;
    overflow: hidden;
    border: none;
  }

  .in_invoice.in_style1.in_type1 .in_logo img {
    max-height: 70px;
  }

  .in_invoice.in_style2.in_type1 {
    border-width: 20px 0 0;
  }

  .in_invoice.in_style2.in_type1 .in_shape_bg {
    height: 100%;
    width: 42%;
  }

  .in_invoice.in_style2.in_type1 .in_invoice_head .in_text_center {
    text-align: center;
  }

  .in_invoice.in_style2.in_type1 .in_logo {
    top: initial;
    margin-bottom: initial;
  }

  .in_invoice.in_style2 .in_invoice_info_in {
    padding: 12px 20px;
  }

  .in_invoice.in_style2 .in_logo img {
    max-height: 60px;
  }

  .in_curve_35 {
    -webkit-transform: skewX(-35deg);
    transform: skewX(-35deg);
    margin-left: 22px;
    margin-right: 22px;
  }

  .in_curve_35>* {
    -webkit-transform: skewX(35deg);
    transform: skewX(35deg);
  }

  .in_invoice.in_style1.in_type1 .in_invoice_seperator {
    -webkit-transform: skewX(35deg);
    transform: skewX(35deg);
  }

  .in_invoice.in_style1.in_type1 .in_invoice_seperator img {
    -webkit-transform: skewX(-35deg) translateX(-45px);
    transform: skewX(-35deg) translateX(-45px);
  }

  .in_section_heading .in_curve_35 {
    margin-left: 12px;
  }

  .in_round_border {
    border-top-width: 2px;
  }

  .in_border_left_none_md {
    border-left-width: 1px;
  }

  .in_border_right_none_md {
    border-right-width: 1px;
  }

  .in_note {
    margin-top: 30px;
  }

  .in_pagebreak {
    page-break-before: always;
  }
}

.n_left_footer_td {
  padding: 5px 0px!important;
  line-height: 1.em;
}
/*#style */
		</style>
	</head>
<div class="invoice-box">

    <table cellpadding="0" cellspacing="0">
      <tr class="top">
        <td colspan="2">
          <table>
            <tr>
              <td class="title">
                <img src="" title="Company logo" style="width: 100%; max-width: 300px;" />
              </td>
              <td>
                <h2>Invoice</h2>
                Invoice #: 123<br />
                Created: January 1, 2015<br />
                Due: February 1, 2015
              </td>
            </tr>
          </table>
        </td>
      </tr>
      <tr class="information">
        <td colspan="2">
          <table>
            <tr>
              <td class="in_primary_color" style="margin: 0px; padding:0px 5px; font-weight: bold;">Billed by</td>
              <td class="in_primary_color" style="margin: 0px; padding:0px 5px; font-weight: bold;">Billed To</td>
            </tr>
            <tr>
              <td>
                Foobar labs<br />
                46, raghuvaar Dham Society<br />
                Surat, Gujarat, India - 395006<br />
                <b>GSTIN 29ABCED1233FG54</b><br/>
                <b>PAN CED1233FG54</b>
              </td>
              <td>
                Wax Studio<br />
                303, 3rd floor Mall, Banglore<br />
                Karnataka India - 540056<br/>
                <b>GSTIN 29ABCED1233FG54</b><br/>
                <b>PAN CED1233FG54</b>
              </td>
            </tr>
          </table>
        </td>
      </tr>

      <!--<tr class="heading">
        <td>Item</td>
        <td>Price</td>
      </tr>
      <tr class="item">
        <td>Website design</td>
        <td>$300.00</td>
      </tr>
      <tr class="item">
        <td>Hosting (3 months)</td>
        <td>$75.00</td>
      </tr>
      <tr class="item last">
        <td>Domain name (1 year)</td>
        <td>$10.00</td>
      </tr>
      <tr class="total">
        <td></td>
        <td>Total: $385.00</td>
      </tr>-->
    </table>
    <div class="in_table in_style1 in_mb30">
      <div class="in_table_responsive">
        <table class="in_border_bottom">
          <thead>
            <tr class="in_border_top">
              <th class="in_width_3 in_semi_bold  in_accent_bg">Item</th>
              <th class="in_width_4 in_semi_bold  in_accent_bg in_text_left ">Description</th>
              <th style="background-color: #253243;" class="in_width_2 in_semi_bold  in_accent_bg">Price</th>
              <th style="background-color: #253243;" class="in_width_1 in_semi_bold in_accent_bg">Qty</th>
              <th style="background-color: #253243;" class="in_width_2 in_semi_bold in_accent_bg in_text_right">Total</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td class="in_width_3">1. Website Design</td>
              <td class="in_width_4 in_text_left ">Six web page designs and three times revision</td>
              <td class="in_width_2">$350</td>
              <td class="in_width_1">1</td>
              <td class="in_width_2 in_text_right">$350</td>
            </tr>
            <tr>
              <td class="in_width_3">2. Web Development</td>
              <td class="in_width_4 in_text_left">Convert pixel-perfect frontend and make it dynamic</td>
              <td class="in_width_2">$600</td>
              <td class="in_width_1">1</td>
              <td class="in_width_2 in_text_right">$600</td>
            </tr>
            <tr>
              <td class="in_width_3">3. App Development</td>
              <td class="in_width_4 in_text_left">Android &amp; Ios Application Development</td>
              <td class="in_width_2">$200</td>
              <td class="in_width_1">2</td>
              <td class="in_width_2 in_text_right">$400</td>
            </tr>
            <tr>
              <td class="in_width_3">4. Digital Marketing</td>
              <td class="in_width_4 in_text_left">Facebook, Youtube and Google Marketing</td>
              <td class="in_width_2">$100</td>
              <td class="in_width_1">3</td>
              <td class="in_width_2 in_text_right">$300</td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="in_invoice_footer">
        <div class="in_left_footer">
          <table class="in_mb15">
            <tbody style="border: 0px;">
              <tr style="border: 0px!important;" class=" ">
                <td colspan="3" class="in_width_2 in_bold n_left_footer_td in_primary_color">Bank &amp; payment Details</td>
                
              </tr>
              <tr>
                <td style="" class="in_width_4 in_primary_color_2 n_left_footer_td">Account Holder Name</td>
                <td class="in_width_1 in_primary_color_2 in_text_left n_left_footer_td"><b>Fooster Labs</b></td>
                <td class="in_width_2" rowspan="4"> <img title="BARCODE IMAGE" src="img/br-01.png"></td>
              </tr>
              <tr>
                <td style="" class="in_width_3 in_primary_color_2 n_left_footer_td">Account Number</td>
                <td class="in_width_1 in_primary_color_2 in_text_left n_left_footer_td"><b>452136578025</b></td>
              </tr>
              <tr>
                <td style="" class="in_width_3 in_primary_color_2 td-line n_left_footer_td">IFSC</td>
                <td class="in_width_1 in_primary_color_2 in_text_left n_left_footer_td"><b>HDFC016765</b></td>
              </tr>
              <tr>
                <td style="" class="in_width_3 in_primary_color_2 n_left_footer_td">Bank</td>
                <td class="in_width_1 in_primary_color_2 in_text_left n_left_footer_td"><b>HDFC</b></td>
              </tr>
              <tr>
                <td style="" class="in_width_3 in_primary_color_2 n_left_footer_td">UPI</td>
                <td class="in_width_1 in_primary_color_2 in_text_left n_left_footer_td"><b>1234569874112</b></td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="in_right_footer">
          <table>
            <tbody>
              <tr>
                <td class="in_width_3 in_primary_color_2 in_border_none in_bold">Subtotal</td>
                <td class="in_width_3 in_primary_color_2 in_text_right in_border_none in_bold">$1650</td>
              </tr>
              <tr>
                <td style="padding-top: 0px;" class="in_width_3 in_primary_color_2 in_border_none ">Discount</td>
                <td style="padding-top: 2px; padding-bottom: 2px;" class="in_width_3 in_primary_color_2 in_text_right in_text_right in_border_none ">-400.00</td>
              </tr>
              <tr>
                <td style="padding-top: 2px; padding-bottom: 2px;" class="in_width_3 in_primary_color_2">Tax<span style="color: #000;">(10%)</span></td>
                <td style="padding-top: 2px; padding-bottom: 2px;" class="in_width_3 in_primary_color_2 in_text_right">-400.00</td>
              </tr>
              <tr class="in_border_top in_border_bottom">
                <td class="in_width_3 in_border_top_0 in_bold in_f16 in_primary_color_2">Grand Total	</td>
                <td class="in_width_3 in_border_top_0 in_bold in_f16 in_primary_color_2 in_text_right">$1732</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>

    </div>
    <table>
      <tr>
        <td>
          <p class=""><b class="in_primary_color">Terms &amp; Conditions:</b></p>
      <ul class="">
        <li>All claims relating to quantity or shipping errors.</li>
        <li>Delivery dates are not guaranteed and Seller.</li>
      </ul>
        </td>
      </tr>
    </table>
  </div>
</body>
</html>
';


// Agregando el contenido de nuestro pdf al payoload de descarga
$dompdf->loadHtml($htmlTemplate);

// Asignacion del tamaño
$dompdf->setPaper('A4','landscape');

// Unificacion de todo los parametros enviados a nuestra clase para presentarlo en pantalla
$dompdf->render();

// Creadno de archivo pdf y descarga con un nombre dinamico
$dompdf->stream($contenidoDinamico);

?>

