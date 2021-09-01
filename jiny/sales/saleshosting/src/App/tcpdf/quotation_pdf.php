<?php
	// 견적서 PDF 인쇄 	
	// TCPDF 적용 : 2016.03.23

	// 로그인 사전 체크
	if(isset($_COOKIE['cookie_email'])){

		include ($_SERVER['DOCUMENT_ROOT']."/conf/dbinfo.php");
		include ($_SERVER['DOCUMENT_ROOT']."/func/mysql.php");

		include ($_SERVER['DOCUMENT_ROOT']."/func/datetime.php");
		include ($_SERVER['DOCUMENT_ROOT']."/func/file.php");
		include ($_SERVER['DOCUMENT_ROOT']."/func/form.php");

		// Include the main TCPDF library (search for installation path).
		require_once('tcpdf_include.php');

		// extend TCPF with custom functions
	class MYPDF extends TCPDF {

		public function Table_header($header){
			$this->SetFillColor(255, 0, 0);
			$this->SetTextColor(255);
			$this->SetDrawColor(128, 0, 0);
			$this->SetLineWidth(0.2);
			$this->SetFont('', 'B');
			
			// Header Title 출력
			$cell = explode(";", $header);
			$count = count($cell);
			for($i=0;$i<$count;$i++){
				$_title = explode("=",$cell[$i]);				
				$width[$i] = $_title[1];

				$_label = explode(":", $_title[0]);
				$label[$i] = $_label[0]; 

				$feild[$i] = $_label[1]; 

				$this->Cell($width[$i], 7, $label[$i], 1, 0, 'C', 1);		
			}
			
			$this->Ln();

			// Color and font restoration
			$this->SetFillColor(224, 235, 255);
			$this->SetTextColor(0);
			$this->SetFont('');

		}

		public function TableRows($header,$data){
			$this->SetFillColor(255, 0, 0);
			$this->SetTextColor(255);
			$this->SetDrawColor(128, 0, 0);
			$this->SetLineWidth(0.2);
			$this->SetFont('', 'B');
			
			// Header Title 출력
			$cell = explode(";", $header);
			$count = count($cell);
			for($i=0;$i<$count;$i++){
				$_title = explode("=",$cell[$i]);				
				$width[$i] = $_title[1];

				$_label = explode(":", $_title[0]);
				$label[$i] = $_label[0]; 

				$feild[$i] = $_label[1]; 

				$this->Cell($width[$i], 7, $label[$i], 1, 0, 'C', 1);		
			}
			
			$this->Ln();

			// Color and font restoration
			$this->SetFillColor(224, 235, 255);
			$this->SetTextColor(0);
			$this->SetFont('');

			$fill = 0;
			$_data = explode(";", $data);
			for($i=0;$i<25;$i++){				
				$rows = explode(":", $_data[$i]);

				for($j=0;$j<$count;$j++){
					if($feild[$j] == "no"){
						$this->Cell($width[$j], 6, $i+1, 'LR', 0, 'L', $fill);
					} else if($feild[$j] == "goodname"){
						$this->Cell($width[$j], 6, $rows[1], 'LR', 0, 'L', $fill);
					} else if($feild[$j] == "spec"){
						$this->Cell($width[$j], 6, $rows[2], 'LR', 0, 'L', $fill);
					} else if($feild[$j] == "num"){
						$this->Cell($width[$j], 6, $rows[3], 'LR', 0, 'L', $fill);
					} else if($feild[$j] == "prices"){
						$this->Cell($width[$j], 6, $rows[4], 'LR', 0, 'L', $fill);
					} else if($feild[$j] == "vat"){
						$this->Cell($width[$j], 6, $rows[6], 'LR', 0, 'L', $fill);	
					} else if($feild[$j] == "discount"){
						$this->Cell($width[$j], 6, $rows[7], 'LR', 0, 'L', $fill);
					} else if($feild[$j] == "total"){
						$this->Cell($width[$j], 6, $rows[8], 'LR', 0, 'L', $fill);			
					}

					
					
				}
				$this->Ln();
				$fill=!$fill;
			}
			$this->Cell(array_sum($width), 0, '', 'T');

		}

	}

		// create new PDF document
		$PDF_PAGE_FORMAT= 'A4';
		$custom_layout = array(210.02, 297.01); //A4
		$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, 'A4', true, 'UTF-8', false);

		// set document information
		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor('saleshosting');
		$pdf->SetTitle('transaction');
		$pdf->SetSubject('trans');
		$pdf->SetKeywords('saleshosting, trans');

		// remove default header/footer
		$pdf->setPrintHeader(false);
		$pdf->setPrintFooter(false);

		// set default monospaced font
		$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

		// set margins
		$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
		$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
		$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

		// set auto page breaks
		$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

		// set image scale factor
		$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

		// set some language-dependent strings (optional)
		if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
			require_once(dirname(__FILE__).'/lang/eng.php');
			$pdf->setLanguageArray($l);
		}

		// ---------------------------------------------------------

		// 폰트 설정
		// $pdf->SetFont('helvetica', '', 8);
		$pdf->SetFont('yungodic120', '', 8);

		// 페이지 여백 설정
		// TCPDF::SetMargins($left,$top,$right = -1,$keepmargins = false)
		// $left   (float) Left margin.
		// $top    (float) Top margin.
		// $right  (float) Right margin. Default value is the left one.
		// $keepmargins    (boolean) if true overwrites the default page margins
		$pdf->SetMargins(5.01, 5.01, 5, $keepmargins = false);

		// 페이지 설정
		
		

		// Sales 사용자 DB 접근.
		include ($_SERVER['DOCUMENT_ROOT']."/conf/sales.php");

		// =====================================
		// 발급자	

		
		$uid = explode(";", _formdata("uid"));
		if(count($uid)>1){
			
			for($i=0;$i<count($uid);$i++){
				if($uid[$i]) $_uid .= "Id = '".$uid[$i]."' or ";
			}

			$_uid .= ";";
			$_uid = str_replace("or ;", ";", $_uid);

			
			$query = "select * from `sales_quotation` where ".$_uid;

		} else $query = "select * from `sales_quotation` where Id = '"._formdata("uid")."'";
		// echo $query;
		
    	if($rowss= _sales_query_rowss($query)){
    		//echo "quotation";

    		for($i=0;$i<count($rowss);$i++){
    			$rows = $rowss[$i];

    			$pdf->AddPage();
				$pdf->SetAutoPageBreak(TRUE, 0);

    			$pdf->SetFont('yungodic120', '', 15);
				$pdf->Cell(100, 10, '견 적 서', $boder=false, $ln=0, 'L', 0, '', $stretch = 0, false, 'T', 'C');
				$pdf->Ln();

				$transdate = $rows->transdate; //_formdata("transdate");
				$pdf->SetFont('yungodic120', '', 8);
				$pdf->Cell(15, 6, '견적일자:', $boder=false, $ln=0, 'L', 0, '', 0, false, 'T', 'C');
				$pdf->Cell(85, 6, $transdate, $boder=false, $ln=0, 'L', 0, '', 0, false, 'T', 'C');
				$pdf->Ln();

				$company_id = $rows->company_id; //_formdata("company_id");
				$company_search = $rows->company; //_formdata("company_search");
				if($company_search){
					$pdf->Cell(15, 10, '거래처', $boder=false, $ln=0, 'L', 0, '', 0, false, 'T', 'C');
					$pdf->SetFont('', 'B');
					$pdf->Cell(85, 10, $company_search, $boder=false, $ln=0, 'L', 0, '', 0, false, 'T', 'C');
					$pdf->SetFont('');
					$pdf->Ln();
				} else {
					$pdf->Cell(100, 10, '거래처 이름이 없습니다.', $boder=false, $ln=0, 'L', 0, '', 0, false, 'T', 'C');
					$pdf->Ln();
				}

				$customer = $rows->customer; //_formdata("customer");
				$pdf->Cell(100, 6, $customer, $boder=false, $ln=0, 'L', 0, '', 0, false, 'T', 'C');
				$pdf->Ln();

				$phone = $rows->phone; //_formdata("phone");
				$pdf->Cell(100, 6, $phone, $boder=false, $ln=0, 'L', 0, '', 0, false, 'T', 'C');
				$pdf->Ln();

				$email = $rows->email; //_formdata("email");
				$pdf->Cell(100, 6, $email, $boder=false, $ln=0, 'L', 0, '', 0, false, 'T', 'C');
				$pdf->Ln();


				$pdf->SetXY(100.01,5.01);
				$pdf->MultiCell(5,36,'   공  급  자   ',$border = true, $align = 'C', $fill = false, $ln = 1, $x = '', $y = '', $reseth = true, $stretch = 0, $ishtml = false, $autopadding = true, $maxh = 0, $valign = 'M',  $fitcell = false ); 

				// 공급자 정보 표시
				$business = $rows->business; //_formdata("business");
				$business_id = $rows->business_id; //_formdata("business_id");
				$query = "select * from sales_business where Id='$business_id'";
				if( $business_rows = _sales_query_rows($query) ){
			
					// 공급자 정보 표시
					$pdf->SetXY(105.01,5.01);
					$pdf->Cell(15, 6, '등록번호', 1, $ln=0, 'L', 0, '', 0, false, 'T', 'C');
					$pdf->Cell(85, 6, $business_rows->biznumber, 1, $ln=0, 'L', 0, '', 0, false, 'T', 'C');
					$pdf->Ln();

					$pdf->SetX(105.01);
					$pdf->Cell(15, 6, '상호', 1, $ln=0, 'L', 0, '', 0, false, 'T', 'C');
					$pdf->Cell(50, 6, $business_rows->business, 1, $ln=0, 'L', 0, '', 0, false, 'T', 'C');
					$pdf->Cell(15, 6, '대표자명', 1, $ln=0, 'L', 0, '', 0, false, 'T', 'C');
					$pdf->Cell(20, 6, $business_rows->president, 1, $ln=0, 'L', 0, '', 0, false, 'T', 'C');
					$pdf->Ln();

					$pdf->SetX(105.01);
					$pdf->Cell(15, 6, '주소', 1, $ln=0, 'L', 0, '', 0, false, 'T', 'C');
					$pdf->Cell(85, 6, $business_rows->address, 1, $ln=0, 'L', 0, '', 0, false, 'T', 'C');
					$pdf->Ln();

					$pdf->SetX(105.01);
					$pdf->Cell(15, 6, '업태', 1, $ln=0, 'L', 0, '', 0, false, 'T', 'C');
					$pdf->Cell(35, 6, $business_rows->item, 1, $ln=0, 'L', 0, '', 0, false, 'T', 'C');
					$pdf->Cell(15, 6, '업종', 1, $ln=0, 'L', 0, '', 0, false, 'T', 'C');
					$pdf->Cell(35, 6, $business_rows->subject, 1, $ln=0, 'L', 0, '', 0, false, 'T', 'C');
					$pdf->Ln();

					$pdf->SetX(105.01);
					$pdf->Cell(15, 6, '이메일', 1, $ln=0, 'L', 0, '', 0, false, 'T', 'C');
					$pdf->Cell(85, 6, $business_rows->email, 1, $ln=0, 'L', 0, '', 0, false, 'T', 'C');
					$pdf->Ln();

					$pdf->SetX(105.01);
					$pdf->Cell(15, 6, '담당자', 1, $ln=0, 'L', 0, '', 0, false, 'T', 'C');
					$pdf->Cell(35, 6, $business_rows->manager, 1, $ln=0, 'L', 0, '', 0, false, 'T', 'C');
					$pdf->Cell(15, 6, '연락처', 1, $ln=0, 'L', 0, '', 0, false, 'T', 'C');
					$pdf->Cell(35, 6, $business_rows->phone, 1, $ln=0, 'L', 0, '', 0, false, 'T', 'C');
					$pdf->Ln();
	
				} else {
					$pdf->SetXY(105.01,5.01);
					$pdf->Cell(100, 36, '공급자 정보가 없습니다.', 1, $ln=0, 'L', 0, '', 0, false, 'T', 'C');
				}

				$pdf->Ln();
				$title = $rows->title; //_formdata("email");
				$pdf->Cell(200, 15, $title, $boder=false, $ln=0, 'L', 0, '', 0, false, 'T', 'C');
				$pdf->Ln();


				// 리스트 표시 
				$posY = $pdf->GetY() + 1 ;
		
				$data = $rows->data; //$_POST['data'];
				// 문자열 길이 , // A4사이즈 = 200	
				$table_header = "No:no=10;제품명:goodname=80;규격:spec=20;수량:num=15;단가:prices=20;부가세:vat=15;할인액:discount=20;금액:total=20";
				if($data){
			
    				$pdf->TableRows($table_header,$data);

				} else {
					$pdf->Table_header($table_header);
					$pdf->Cell(200, 60, '내역이 없습니다.', 1, $ln=0, 'C', 0, '', 0, false, 'T', 'C');
					$pdf->Ln();
				}

				

				$pdf->SetDrawColor(0, 0, 0);
				$pdf->SetLineWidth(0.1);

				$posY = $pdf->GetY() + 1 ;

				$pdf->SetXY(5.01,$posY);
				$pdf->Cell(100, 6, '참고내용', $boder=false, $ln=0, 'L', 0, '', 0, false, 'T', 'C');

				$quo_sum = $rows->quo_sum; //_formdata("quo_sum");
				$pdf->SetXY(130.01,$posY);
				$pdf->Cell(15, 6, '금액', 1, $ln=0, 'L', 0, '', 0, false, 'T', 'C');
				$pdf->Cell(60, 6, $quo_sum, 1, $ln=0, 'L', 0, '', 0, false, 'T', 'C');
				$pdf->Ln();

				$quo_vat = $rows->quo_vat; //_formdata("quo_vat");
				$pdf->SetX(130.01);
				$pdf->Cell(15, 6, '부가세', 1, $ln=0, 'L', 0, '', 0, false, 'T', 'C');
				$pdf->Cell(60, 6, $quo_vat, 1, $ln=0, 'L', 0, '', 0, false, 'T', 'C');
				$pdf->Ln();

		
		//$pdf->SetX(130.01);
		//$pdf->Cell(15, 6, '할인액', 1, $ln=0, 'L', 0, '', 0, false, 'T', 'C');
		//$pdf->Cell(60, 6, $balance_rows->total_discount, 1, $ln=0, 'L', 0, '', 0, false, 'T', 'C');
		//$pdf->Ln();
		

				$quo_total = $rows->quo_total; //_formdata("quo_total");
				$pdf->SetX(130.01);
				$pdf->Cell(15, 10, '결제액', 1, $ln=0, 'L', 0, '', 0, false, 'T', 'C');
				$pdf->Cell(60, 10, $quo_total, 1, $ln=0, 'L', 0, '', 0, false, 'T', 'C');
				$pdf->Ln();

				$pdf->SetFont('yungodic120', '', 5);
				$pdf->SetX(130.01);
				$pdf->Cell(15, 4, '판매재고 관리 및 쇼핑몰, 홈페이지 제작 http://www.saleshosting.co.kr', $boder=false, $ln=0, 'L', 0, '', 0, false, 'T', 'C');

    		}

    		// close and output PDF document
			$pdf->Output('quotation.pdf', 'I');


    	} else {
    		// echo $query."<br>";
    		echo "인쇄할 PDF 견적서가 없습니다.";
    	}
		


		


		

		//============================================================+
		// END OF FILE
		//============================================================+

	} else {
		echo "Error! please, login before.";
	}

?>