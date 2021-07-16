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
		$transdate = _formdata("transdate");

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
				for($i=0;$i<10;$i++){
					$rows = $rowss[$i];
					for($j=0;$j<$count;$j++){
						if($feild[$j] == "no"){
							$this->Cell($width[$j], 6, $i+1, 'LR', 0, 'L', $fill);
						} else {
							$this->Cell($width[$j], 6, $rows->$feild[$j], 'LR', 0, 'L', $fill);
						}					
					}
					$this->Ln();
					$fill=!$fill;
				}
				$this->Cell(array_sum($width), 0, '', 'T');
			}

		}

		// create new PDF document
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
		$PDF_PAGE_FORMAT= 'A4';
		// $pdf->AddPage();
		


		// ++ 선택갯수에 따른 전표 출력
		if($TID = $_POST['TID']){

			// ++ 한페이지에 10개씩 출력함
			for($i=0;$i<count($TID);$i+=10){

				// ++ 다음페이지 추가 
				$pdf->AddPage();
				$pdf->SetAutoPageBreak(TRUE, 0);

				// ++ 발급자	
				$pdf->SetFont('yungodic120', '', 15);
				$pdf->Cell(100, 10, '거래명세서 (발급자)', $boder=false, $ln=0, 'L', 0, '', $stretch = 0, false, 'T', 'C');
				$pdf->Ln();

				$pdf->SetFont('yungodic120', '', 8);
				$pdf->Cell(15, 10, '거래일자:', $boder=false, $ln=0, 'L', 0, '', 0, false, 'T', 'C');
				$pdf->Cell(85, 10, $transdate, $boder=false, $ln=0, 'L', 0, '', 0, false, 'T', 'C');
				$pdf->Ln();

				$query = "select * from `sales_company` where Id = '$company_id'";
				if($company_rows = _sales_query_rows($query)){
					$pdf->Cell(15, 10, '거래처', $boder=false, $ln=0, 'L', 0, '', 0, false, 'T', 'C');
					$pdf->Cell(85, 10, $company_rows->company, $boder=false, $ln=0, 'L', 0, '', 0, false, 'T', 'C');
					$pdf->Ln();
				} else {
					$pdf->Cell(100, 10, '선택된 거래처가 없습니다.', $boder=false, $ln=0, 'L', 0, '', 0, false, 'T', 'C');
					$pdf->Ln();
				}

				// + 공급자 정보 출력
				$pdf->SetXY(100.01,5.01);
				$pdf->MultiCell(5,36,'   공  급  자   ',$border = true, $align = 'C', $fill = false, $ln = 1, $x = '', $y = '', $reseth = true, $stretch = 0, $ishtml = false, $autopadding = true, $maxh = 0, $valign = 'M',  $fitcell = false ); 

				// 공급자 정보 표시
				$query = "select * from sales_business where Id='$business'";
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

				// 리스트 표시 
				$pdf->SetY(43.01);
				// 문자열 길이 , // A4사이즈 = 200	
				$table_header = "No:no=10;제품명:goodname=80;규격:spec=20;수량:num=15;단가:prices=20;부가세:vat=15;할인액:discount=20;금액:total=20";
				if($TID){			
					$query = "select * from sales_trans where ";


					

					if($i+10 < count($TID)) $count = $i + 10; else $count = count($TID);
					for($j=$i;$j<$count;$j++) $query .= "Id = '".$TID[$j]."' || ";
					
    				$query .= ";";
    				$query = str_replace("|| ;","",$query);
    				/*
    				$pdf->Cell(15, 6, $query, 1, $ln=0, 'L', 0, '', 0, false, 'T', 'C');
    				$pdf->Ln();

    				$pdf->Cell(15, 6, "i = $i, count = $count", 1, $ln=0, 'L', 0, '', 0, false, 'T', 'C');
    				$pdf->Ln();
    				*/

    		
    				if($rowss = _sales_query_rowss($query))	$pdf->TableRows($table_header,$rowss);
			
					$query = str_replace("*", "SUM(prices) AS total_prices, SUM(total) AS total_total, SUM(vat) AS total_vat, SUM(discount) AS total_discount ", $query);
					$balance_rows = _sales_query_rows($query);

				} else {
					$pdf->Table_header($table_header);
					$pdf->Cell(200, 60, '내역이 없습니다.', 1, $ln=0, 'C', 0, '', 0, false, 'T', 'C');
					$pdf->Ln();
				}

				// ++ 하단 정보 출력
				$pdf->SetDrawColor(0, 0, 0);
				$pdf->SetLineWidth(0.1);

				$pdf->SetXY(5.01,111);
				$pdf->Cell(100, 6, '참고내용', $boder=false, $ln=0, 'L', 0, '', 0, false, 'T', 'C');

				$pdf->SetXY(105.01,111);
				$pdf->Cell(15, 6, '전 미수금', 1, $ln=0, 'L', 0, '', 0, false, 'T', 'C');
				if($trans == "sell") $pdf->Cell(35, 6, $company_rows->balance_sell, 1, $ln=0, 'L', 0, '', 0, false, 'T', 'C');
				else if($trans == "buy")  $pdf->Cell(35, 6, $company_rows->balance_buy, 1, $ln=0, 'L', 0, '', 0, false, 'T', 'C');
				$pdf->Ln();

				$pdf->SetX(105.01);
				$pdf->Cell(15, 6, '총 미수금', 1, $ln=0, 'L', 0, '', 0, false, 'T', 'C');
				$pdf->Cell(35, 6, '', 1, $ln=0, 'L', 0, '', 0, false, 'T', 'C');
				$pdf->Ln();

				$pdf->SetX(105.01);
				$pdf->Cell(15, 6, '입금액', 1, $ln=0, 'L', 0, '', 0, false, 'T', 'C');
				$pdf->Cell(35, 6, '', 1, $ln=0, 'L', 0, '', 0, false, 'T', 'C');
				$pdf->Ln();

				$pdf->SetX(105.01);
				$pdf->Cell(15, 10, '인수자', 1, $ln=0, 'L', 0, '', 0, false, 'T', 'C');
				$pdf->Cell(35, 10, '', 1, $ln=0, 'L', 0, '', 0, false, 'T', 'C');
				$pdf->Ln();

				$pdf->SetXY(155.01,111);
				$pdf->Cell(15, 6, '금액', 1, $ln=0, 'L', 0, '', 0, false, 'T', 'C');
				$pdf->Cell(35, 6, $balance_rows->total_prices, 1, $ln=0, 'L', 0, '', 0, false, 'T', 'C');
				$pdf->Ln();

				$pdf->SetX(155.01);
				$pdf->Cell(15, 6, '부가세', 1, $ln=0, 'L', 0, '', 0, false, 'T', 'C');
				$pdf->Cell(35, 6, $balance_rows->total_vat, 1, $ln=0, 'L', 0, '', 0, false, 'T', 'C');
				$pdf->Ln();

				$pdf->SetX(155.01);
				$pdf->Cell(15, 6, '할인액', 1, $ln=0, 'L', 0, '', 0, false, 'T', 'C');
				$pdf->Cell(35, 6, $balance_rows->total_discount, 1, $ln=0, 'L', 0, '', 0, false, 'T', 'C');
				$pdf->Ln();

				$pdf->SetX(155.01);
				$pdf->Cell(15, 10, '결제액', 1, $ln=0, 'L', 0, '', 0, false, 'T', 'C');
				$pdf->Cell(35, 10, $balance_rows->total_total, 1, $ln=0, 'L', 0, '', 0, false, 'T', 'C');
				$pdf->Ln();

				$pdf->SetFont('yungodic120', '', 5);
				$pdf->SetXY(105.01, 139);
				$pdf->Cell(15, 4, '판매재고 관리 및 쇼핑몰, 홈페이지 제작 http://www.saleshosting.co.kr', $boder=false, $ln=0, 'L', 0, '', 0, false, 'T', 'C');
				

				// ++
				// ++ 반장 출력
				// 절취선 라인
				$pdf->SetDrawColor(0, 0, 0);	$pdf->SetLineWidth(0.1);	$pdf->SetXY(5.01, 148.5);
				$pdf->Line(5.01,148.5,205.01,148.5);

				// ++ 반장 데이터 (발급자)
				$pdf->SetXY(5.01, 153.5);

				$pdf->SetFont('yungodic120', '', 15);
				$pdf->Cell(100, 10, '거래명세서 (공급자)', $boder=false, $ln=0, 'L', 0, '', $stretch = 0, false, 'T', 'C');
				$pdf->Ln();

				$pdf->SetFont('yungodic120', '', 8);
				$pdf->Cell(15, 10, '거래일자:', $boder=false, $ln=0, 'L', 0, '', 0, false, 'T', 'C');
				$pdf->Cell(85, 10, $transdate, $boder=false, $ln=0, 'L', 0, '', 0, false, 'T', 'C');
				$pdf->Ln();

				if($company_rows){
					$pdf->Cell(15, 10, '거래처', $boder=false, $ln=0, 'L', 0, '', 0, false, 'T', 'C');
					$pdf->Cell(85, 10, $company_rows->company, $boder=false, $ln=0, 'L', 0, '', 0, false, 'T', 'C');
					$pdf->Ln();
				} else {
					$pdf->Cell(100, 10, '선택된 거래처가 없습니다.', $boder=false, $ln=0, 'L', 0, '', 0, false, 'T', 'C');
					$pdf->Ln();
				}

		
				$pdf->SetXY(100.01,153.5);
				$pdf->MultiCell(5,36,'   공  급  자   ',$border = true, $align = 'C', $fill = false, $ln = 1, $x = '', $y = '', $reseth = true, $stretch = 0, $ishtml = false, $autopadding = true, $maxh = 0, $valign = 'M',  $fitcell = false );  

	
				// 공급자 정보 표시
				$pdf->SetXY(105.01,153.5);
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

				// 리스트 표시 
				$pdf->SetY(191.5);
				if($rowss){
					// 문자열 길이 , // A4사이즈 = 200
					$table_header = "No:no=10;제품명:goodname=80;규격:spec=20;수량:num=15;단가:prices=20;부가세:vat=15;할인액:discount=20;금액:total=20";
					$pdf->TableRows($table_header,$rowss);
				}

				$pdf->SetDrawColor(0, 0, 0);
				$pdf->SetLineWidth(0.1);

				$pdf->SetXY(5.01,260);
				$pdf->Cell(100, 6, '참고내용', $boder=false, $ln=0, 'L', 0, '', 0, false, 'T', 'C');

				$pdf->SetXY(105.01,260);
				$pdf->Cell(15, 6, '전 미수금', 1, $ln=0, 'L', 0, '', 0, false, 'T', 'C');
				if($trans == "sell") $pdf->Cell(35, 6, $company_rows->balance_sell, 1, $ln=0, 'L', 0, '', 0, false, 'T', 'C');
				else if($trans == "buy")  $pdf->Cell(35, 6, $company_rows->balance_buy, 1, $ln=0, 'L', 0, '', 0, false, 'T', 'C');
				$pdf->Ln();

				$pdf->SetX(105.01);
				$pdf->Cell(15, 6, '총 미수금', 1, $ln=0, 'L', 0, '', 0, false, 'T', 'C');
				$pdf->Cell(35, 6, '', 1, $ln=0, 'L', 0, '', 0, false, 'T', 'C');
				$pdf->Ln();

				$pdf->SetX(105.01);
				$pdf->Cell(15, 6, '입금액', 1, $ln=0, 'L', 0, '', 0, false, 'T', 'C');
				$pdf->Cell(35, 6, '', 1, $ln=0, 'L', 0, '', 0, false, 'T', 'C');
				$pdf->Ln();

				$pdf->SetX(105.01);
				$pdf->Cell(15, 10, '인수자', 1, $ln=0, 'L', 0, '', 0, false, 'T', 'C');
				$pdf->Cell(35, 10, '', 1, $ln=0, 'L', 0, '', 0, false, 'T', 'C');
				$pdf->Ln();


				$pdf->SetXY(155.01,260);
				$pdf->Cell(15, 6, '금액', 1, $ln=0, 'L', 0, '', 0, false, 'T', 'C');
				$pdf->Cell(35, 6, $balance_rows->total_prices, 1, $ln=0, 'L', 0, '', 0, false, 'T', 'C');
				$pdf->Ln();

				$pdf->SetX(155.01);
				$pdf->Cell(15, 6, '부가세', 1, $ln=0, 'L', 0, '', 0, false, 'T', 'C');
				$pdf->Cell(35, 6, $balance_rows->total_vat, 1, $ln=0, 'L', 0, '', 0, false, 'T', 'C');
				$pdf->Ln();

				$pdf->SetX(155.01);
				$pdf->Cell(15, 6, '할인액', 1, $ln=0, 'L', 0, '', 0, false, 'T', 'C');
				$pdf->Cell(35, 6, $balance_rows->total_discount, 1, $ln=0, 'L', 0, '', 0, false, 'T', 'C');
				$pdf->Ln();

				$pdf->SetX(155.01);
				$pdf->Cell(15, 10, '결제액', 1, $ln=0, 'L', 0, '', 0, false, 'T', 'C');
				$pdf->Cell(35, 10, $balance_rows->total_total, 1, $ln=0, 'L', 0, '', 0, false, 'T', 'C');
				$pdf->Ln();

				$pdf->SetFont('yungodic120', '', 5);
				$pdf->SetXY(105.01, 288);
				$pdf->Cell(15, 4, '판매재고 관리 및 쇼핑몰, 홈페이지 제작 http://www.saleshosting.co.kr', $boder=false, $ln=0, 'L', 0, '', 0, false, 'T', 'C');

				

			}

			// close and output PDF document
			$pdf->Output('trans.pdf', 'I');

		}


	} else {
		echo "Error! please, login before.";
	}

?>