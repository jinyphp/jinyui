<?php
	// ++ 요일 이름 
	function _weekName($week){
		switch ($week) {
			case '0':
				return "일";
				break;

			case '1':
				return "월";
				break;

			case '2':
				return "화";
				break;	

			case '3':
				return "수";
				break;	

			case '4':
				return "목";
				break;	

			case '5':
				return "금";
				break;	

			case '6':
				return "토";
				break;					
			
			default:
				# code...
				break;
		}
	}


	// ++ 날짜조건 limit 필드
	if($limit = _formdata("limit")){
		$year = substr($limit,0,4);
		$month = substr($limit,5,2);

	} else {
		// ++ 달력 출력
		$year	= date("Y", time()); 
		$month	= date("m", time());
		$limit = $year."-".$month;
	}

	// ++ 이번달 1일, 시작요일
	$start_WeekDay	= getdate(mktime(0,0,0,$month,1,$year));

	// ++ 데이터 읽기
	$query = "select * from ".$_tableName." where regdate >= '".$limit."-01' and regdate <= '".$limit."-31' ";
	if($table_rows->table_where) $_where = explode(";", $table_rows->table_where);
	if($searchkey || count($_where)>0 ){
		$query .= "and ";

		for($i=0;$i<count($_where);$i++){
			// echo $_where[$i]['field']."<br>";
			// echo _formdata("customer");
			$query .= $_where[$i]." = '"._formdata($_where[$i])."' and ";
		}

		if($searchkey) $query .= $table_rows->table_search." like '%".$searchkey."%' and ";

		$query .= ";";
		$query = str_replace("and ;","",$query); // where 절을 ;으로 마감 후 and ; 를 처리
	}
		
	if( $table_rows->sortfield && $table_rows->table_sorttype )
	$query .= " order by ".$table_rows->sortfield." ".$table_rows->table_sorttype." ";

	//echo $query."<br>";
	if($rowss = _sales_query_rowss($query)){
			/*
				// ++ 해당요일 데이터 출력
				for($k=0;$k<count($rowss);$k++){
					$rows = $rowss[$k];
					$daily_Data .= "<div>".$rows->title."</div>";
				}
			*/			
	}

	// 테이블 출력 필드
	$query1 = "select * from admin_tableslist where table_name = '$_tableName' order by pos asc";
	$_log_history .= $query1."<br>";	
	if($title_rowss = _sales_query_rowss($query1)){

	} 

	




	$list = "일자: ".$limit;
	
	$list .= "<div id='calrenda'>";
	$list .= "<table width='100%' style=\"border-bottom:1px solid #E9E9E9;\"> 
			<tr> 
			<td width='14%' align='center' style=\"border-left:1px solid #E9E9E9;border-top:1px solid #E9E9E9;font-size:12px;padding:10px;\">월</td> 
			<td width='14%' align='center' style=\"border-left:1px solid #E9E9E9;border-top:1px solid #E9E9E9;font-size:12px;padding:10px;\">화</td> 
			<td width='14%' align='center' style=\"border-left:1px solid #E9E9E9;border-top:1px solid #E9E9E9;font-size:12px;padding:10px;\">수</td> 
			<td width='14%' align='center' style=\"border-left:1px solid #E9E9E9;border-top:1px solid #E9E9E9;font-size:12px;padding:10px;\">목</td> 
			<td width='14%' align='center' style=\"border-left:1px solid #E9E9E9;border-top:1px solid #E9E9E9;font-size:12px;padding:10px;\">금</td> 
			<td width='14%' align='center' style=\"border-left:1px solid #E9E9E9;border-top:1px solid #E9E9E9;font-size:12px;padding:10px;\">토</td> 
			<td width='14%' align='center' style=\"border-left:1px solid #E9E9E9;border-top:1px solid #E9E9E9;border-right:1px solid #E9E9E9;font-size:12px;padding:10px;\">일</td> 
			</tr>";		
	$list .= "<tr>";

	for($i=1,$k=0,$realDay=1;$i<50;$i++){ 

		
		if($i>=$start_WeekDay['wday']){	
			// ++ 시작요일 부터 날짜 기록	

			if(checkdate ($month,$realDay,$year)){
			// 마지막 요일 체크, // 정상적인 요일					
				$realDay++;
				$DDD++;

				$daily_Data = "";
				// echo "--- <br>";
				for(;$k<count($rowss);$k++){
					// echo "k= $k <br>";
					// echo substr($rowss[$k]->regdate,8,2)."<br>";
					if($DDD == substr($rowss[$k]->regdate,8,2)){

						// ++ 내용필드 출력
						$editHref = NULL;
						for($t=0;$t<count($title_rowss);$t++){
							$title_rows = $title_rowss[$t];

							$field_key = $title_rows->field_name;
								
								
							if($title_rows->max_string){
								//echo "max_string = ".$title_rows->max_string."<br>";
								//echo $rowss[$k]->$field_key."<br>";
								//echo substr($rowss[$k]->$field_key,0,$title_rows->max_string+2)."<br>";

								if(strlen($rowss[$k]->$field_key) > $title_rows->max_string) {
									$title = substr($rowss[$k]->$field_key,0,$title_rows->max_string+2);
									$title .= "...";
								} else $title = $rowss[$k]->$field_key;
							} else {
								$title = $rowss[$k]->$field_key;
							}

							if($title_rows->editlink){
								if($rowss[$k]->enable) {
								$editHref .= "<a href='#' onclick=\"javascript:edit('edit','".$rowss[$k]->Id."','".$limit."')\">".$title."</a>";
								} else $editHref .= "<a href='#' onclick=\"javascript:edit('edit','".$rowss[$k]->Id."','".$limit."')\">
								<span style=\"text-decoration:line-through;\">".$title."</span></a>";
							} else $editHref .= $title;

								

						}

						// $daily_Data .= "<div>".substr($rowss[$k]->regdate,11,8)." ".$rowss[$k]->title."</div>";
						$daily_Data .= "<div>".$editHref."</div>";
							


							
					} else {
						break;
					}

				}					

			} else {
				// 비정상적인 요일
				$realDay = NULL;
				$DDD = NULL;
				$daily_Data = NULL;
			}
		} 

		if($i%7 == 0) {
			$list .= "<td valign=top style=\"border-left:1px solid #E9E9E9;border-top:1px solid #E9E9E9;border-right:1px solid #E9E9E9; font-size:12px;padding:10px;\">".$DDD.$daily_Data."</td>";
			
			if(checkdate ($month,$realDay,$year)){
				$list .= "</tr><tr>";			
			} else {
				// 비정상 요일일 경우, 종료 ...
				break;
			}

		} else {
			// 미시작 요일처리
			$list .= "<td valign=top style=\"border-left:1px solid #E9E9E9;border-top:1px solid #E9E9E9;font-size:12px;padding:10px;\">".$DDD.$daily_Data."</td>";
		}

	}

		
	$list .= "</tr></table>";

	// ++ 날자 pagnation 처리 
	$list .= "<center><table><tr>";
	$start = intval($month)-3;
	$list .= "<td style=\"font-size:12px;padding:10px;\" width='80'><< <a href='#' onclick=\"javascript:list('".intval($year - 1)."-01')\">".intval($year - 1).""."</a>년</td>";
		
	for($i=1;$i<=12;$i++) 
	$list .= "<td  style=\"font-size:12px;padding:10px;\" width='30'><a href='#' onclick=\"javascript:list('".$year."-".$i."')\">$i".""."</a>월</td>";
		
	$list .= "<td style=\"font-size:12px;padding:10px;\" width='80'><a href='#' onclick=\"javascript:list('".intval($year + 1)."-01')\">".intval($year + 1).""."</a>년 >></td>";
	$list .= "</tr></table></center>";

	$list .= "</div>";
	
?>