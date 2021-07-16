
	
	
	function showBarcode($mode,$url){
 		App.callBarcodeReader($mode,$url);
 	}
 	
 	function saveBarcodeValue($value,$barcodeMode,$url){
 		// document.getElementById('barcodeValue').value = "1111111";
 		// document.getElementById('barcodeValue').value = $value;
		// document.getElementById('barcodeMode').value = $barcodeMode;
		var url1;
		
		url1 = $url + "barcode=" + $value;
	
		
		location.href = url1;
		
 	}
 	
