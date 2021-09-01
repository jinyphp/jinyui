<?php
	// 거래내역서 PDF 인쇄 	
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

		// Sales 사용자 DB 접근.
		include ($_SERVER['DOCUMENT_ROOT']."/conf/sales.php");

		$trans = _formdata("trans");
		$business = _formdata("business");
		$company_id = _formdata("company_id");
		$company_search = _formdata("company_search");
		$transdate = _formdata("transdate");

		$customer = _formdata("customer");
		$phone = _formdata("phone");
		$email = _formdata("email");

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

			public function TableRows($header,$rowss){
				
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
				//count($rowss)
				for($i=0;$i<count($rowss);$i++){
					$rows = $rowss[$i];
					for($j=0;$j<$count;$j++){
						if($feild[$j] == "no"){
							$this->Cell($width[$j], 6, $i+1, 'LR', 0, 'L', $fill);
						} else if($feild[$j] == "goodname" && $rows->trans == "sell_paid"){
							$this->Cell($width[$j], 6, '***** 입금(결제)*****', 'LR', 0, 'L', $fill);
						} else if($feild[$j] == "goodname" && $rows->trans == "buy_paid"){
							$this->Cell($width[$j], 6, '***** 출금(결제) *****', 'LR', 0, 'L', $fill);	
						} else {
							$this->Cell($width[$j], 6, $rows->$feild[$j], 'LR', 0, 'L', $fill);
						}
					
					}
					$this->Ln();
					$fill=!$fill;

					// ++ 20라인 이상 넘을 경우, 타이틀 출력
					
					if($i>0 && $i%20 == 0){

						$this->SetDrawColor(0, 0, 0);
						$this->SetLineWidth(0.1);

						$posY = $this->GetY() + 1 ;

						$this->SetFont('yungodic120', '', 5);
						$this->SetX(130.01);
						$this->Cell(15, 4, '판매재고 관리 및 쇼핑몰, 홈페이지 제작 http://www.saleshosting.co.kr', $boder=false, $ln=0, 'L', 0, '', 0, false, 'T', 'C');

						
						// ++ 다음페이지 추가 
						$this->AddPage();
						$this->SetAutoPageBreak(TRUE, 0);





						$this->SetFillColor(255, 0, 0);
						$this->SetTextColor(255);
						$this->SetDrawColor(128, 0, 0);
						$this->SetLineWidth(0.2);
						$this->SetFont('', 'B');
			
						// Header Title 출력
						$cell = explode(";", $header);
						// $count = ;
						for($k=0;$k<count($cell);$k++){
							$_title = explode("=",$cell[$k]);				
							$width[$k] = $_title[1];

							$_label = explode(":", $_title[0]);
							$label[$k] = $_label[0]; 

							$feild[$k] = $_label[1]; 

							$this->Cell($width[$k], 7, $label[$k], 1, 0, 'C', 1);		
						}
			
						$this->Ln();

						// Color and font restoration
						$this->SetFillColor(224, 235, 255);
						$this->SetTextColor(0);
						$this->SetFont('');

						

					}

					//
				}
				$this->Cell(array_sum($width), 0, '', 'T');
			}

		}

		// 페이지 설정
		$PDF_PAGE_FORMAT = 'A4';
		$PDF_PAGE_ORIENTATION = 'L';

		// create new PDF document
		$custom_layout = array(210.02, 297.01); //A4
		$pdf = new MYPDF($PDF_PAGE_ORIENTATION, PDF_UNIT, 'A4', true, 'UTF-8', false);

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

		

		

		// 거래처 선택 조건 Query
		$query = "select * from `sales_company` ";
		if($company_id = _formdata("company_id")){
			$company=explode(";", $company_id);
			$query .= "where ";
			for($i=0;$i<count($company)-1;$i++){
				$query .= "Id='".$company[$i]."' or ";
			}
			$query .= ";";
			$query = str_replace("or ;","",$query);
		} else if($company_search= _formdata("company_search")){
			if($company) $query .= "where company like '%$company_search%' ;";
		} 
		//echo $query."<br>";
		
		// 선택 거래처 목록 
		if($company_rowss = _sales_query_rowss($query)){
			for($i=0;$i<count($company_rowss);$i++){
				$company_rows = $company_rowss[$i];

				$pdf->AddPage();
				$pdf->SetAutoPageBreak(TRUE, 0);
				
				// 거래처별 내역 표시 
				// 거래 전표 Query
				$query1 = "select * from sales_trans where company_id = '".$company_rows->Id."' ";

				$start = _formdata("start");
    			$end = _formdata("end");
    			$query1 .= "and transdate >= '$start' and transdate <= '$end' ";

    			if($business = _formdata("business")) $query1 .= "and business = '$business' ";

    			$trans = _formdata("trans");
    			if($trans == "all"){

    			} else if($trans == "buysell"){
    				$query1 .= "and ( trans = 'buy' or trans = 'sell' ) ";

    			} else if($trans == "buy"){
    				$query1 .= "and trans = 'buy' ";

    			} else if($trans == "sell"){
    				$query1 .= "and trans = 'sell' ";

    			} else if($trans == "sell_paid"){
    				$query1 .= "and trans = 'sell_paid' ";
    	
    			} else if($trans == "buy_paid"){
    				$query1 .= "and trans = 'buy_paid' ";

    			} else if($trans == "paid"){
    				$query1 .= "and ( trans = 'buy_paid' or trans = 'sell_paid' ) ";
		
    			} 

    			$query1 .= " order by transdate desc, Id desc";	


    			$pdf->SetFont('yungodic120', '', 15);
				$pdf->SetX(110);
				$pdf->Cell(67, 10, '거래내역서', $boder=false, $ln=0, 'L', 0, '', $stretch = 4, false, 'T', 'C');
				$pdf->Ln();

				$pdf->SetFont('yungodic120', '', 8);
				$pdf->Cell(15, 6, '거래처:', $boder=false, $ln=0, 'L', 0, '', 0, false, 'T', 'C');
				$pdf->Cell(100, 6, $company_rows->company , $boder=false, $ln=0, 'L', 0, '', 0, false, 'T', 'C');

				$pdf->SetX(230);
				$pdf->Cell(15, 6, '기간:', $boder=false, $ln=0, 'L', 0, '', 0, false, 'T', 'C');
				$report_priod = _formdata("start")." ~ "._formdata("end");
				$pdf->Cell(85, 6, $report_priod, $boder=false, $ln=0, 'L', 0, '', 0, false, 'T', 'C');
				$pdf->Ln();

    			// 문자열 길이 , // A4사이즈 = 200	
				$table_header = "No:no=10;거래일자:transdate=20;제품명:goodname=107;규격:spec=20;수량:num=15;단가:prices=20;부가세:vat=15;할인액:discount=20;금액:total=20;입금:paid=20;잔액:balance=20";

				$total_d = 0;
				$vat_d = 0;
				$discount_d = 0;
				$payment_d = 0;

				$total_m = 0;
				$vat_m = 0;
				$discount_m = 0;
				$payment_m = 0;

				if($rowss = _sales_query_rowss($query1)){
					$pdf->TableRows($table_header,$rowss);						
				} else {
					$pdf->Table_header($table_header);
				}	

				$pdf->SetDrawColor(0, 0, 0);
				$pdf->SetLineWidth(0.1);

				$posY = $pdf->GetY() + 1 ;

				$pdf->SetFont('yungodic120', '', 5);
				$pdf->SetX(130.01);
				$pdf->Cell(15, 4, '판매재고 관리 및 쇼핑몰, 홈페이지 제작 http://www.saleshosting.co.kr', $boder=false, $ln=0, 'L', 0, '', 0, false, 'T', 'C');

			}

			// close and output PDF document
			$pdf->Output('trans.pdf', 'I');
		}


	} else {
		echo "Error! please, login before.";
	}

?>