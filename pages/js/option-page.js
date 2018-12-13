(function($){
jQuery(document).ready(function($){
	$__elm = $('<div class="btn-group  pull-right"><a id="btn_exporttocsv" class="btn btn-primary" data-toggle="modal" href="">Export To CSV <i class="fa fa-download"></i></a></div><div class="space15"></div>');
	$('.panel-heading > h4').append($__elm);
	
	
	
	function funcLoadQuotes(){
		$action = localize_var.TextDomain+'_getQuotes';
		
		var jqxhr = jQuery.getJSON(localize_var.admin_ajaxurl+"?action="+$action, function (data) {
			
	        var $aoColumns = [ 
	                          { "sTitle": "Ref. No","sName":"uniqueid" ,"mData":"uniqueid" ,"sClass" :"hidden-xs col-md-1"},
	                          { "sTitle": "Received","sName":"createdate" ,"mData":"createdate" ,"sClass" :"hidden-xs hidden-sm col-md-1 date"},
	                         // { "sTitle": "Preferred Service","sName":"startpricing.hometype" ,"mData":"startpricing.hometype" ,"sClass" :"col-md-3 prefServ"},
	                          { "sTitle": "Building Type","sName":"startpricing.hometypetext" ,"mData":"startpricing.hometypetext" ,"sClass" :"col-md-2 prefServ"},
	                          { "sTitle": "Type of Cleaning","sName":"_typeofclean" ,"mData":"_typeofclean" ,"sClass" :"col-md-2 prefServ"},
	                          { "sTitle": "First Name","sName":"contactinfo.firstName" ,"mData":"contactinfo.firstName" ,"sClass" :"col-md-2"},
	                          { "sTitle": "Last Name","sName":"contactinfo.lastName" ,"mData":"contactinfo.lastName" ,"sClass" :"col-md-2"},
	                          { "sTitle": "Phone","sName":"contactinfo.phoneNumber" ,"mData":"contactinfo.phoneNumber" ,"sClass" :"col-md-1"},
	                          { "sTitle": "Scheduled","sName":"schedule.availabledate" ,"mData":"schedule.availabledate" ,"sClass" :"col-md-1"},
	                          { "sTitle": "ZipCode","sName":"servicearea.zipcode" ,"mData":"servicearea.zipcode" ,"sClass" :"col-md-1"},
	                          { "sTitle": "Amount","sName":"_totalpriceStr" ,"mData":"_totalpriceStr" ,"sClass" :"col-md-1 text-right","mRender": function( data, type, full ) {
	                              return formatNumber(data);                                       
	                          }},
	                          { "sTitle": "Status","sName":"isActive" ,"mData":"isActive" ,"sClass" :"status col-md-1"},
	                          { "sTitle": "Payment","sName":"isLocked" ,"mData":"isLocked" ,"sClass" :"col-md-1","mRender": function( data, type, full ) {
	                              return data == '1' ? 'Authorized' : 'Not Paid';                                       
	                          }},
	                          { "sTitle": "Action","sName":"uniqueid" ,"mData":"uniqueid","sClass" : "action col-xs-6 col-md-1","bSortable":false  }
	                          ];
	       var $fnRowCallback =  function( nRow, aData, iDisplayIndex ) {
	    	//   jQuery('td.prefServ',nRow).empty().append(function(){ return aData.startpricing.hometypetext +' / '+aData.startpricing.frequencytext;});
	    	   jQuery('td.status',nRow).empty().append(_getStateLable(aData.isActive));
	    	   jQuery('td.action',nRow).empty().append(_getAjaxActionButtonsViewDelete(aData,'data_table_quotes',funcLoadQuotes,viewQuote,'_delquote'));
	       	};
	        _setupDataTable($('#data_table_quotes'),$aoColumns,data,$fnRowCallback,[ [ 1, "desc" ] ]);
	        
		});
	}
	
	function viewQuote($_data){
		$action = localize_var.TextDomain+'_getQuoteSummeryFull';
 	   jQuery.post(
				localize_var.admin_ajaxurl +"?action="+$action,
				{	
					uniqueid : $_data.uniqueid
				},
				function( response ) {
					$_response = jQuery.parseJSON(response);
					if ($_response.error != undefined) {
						$modalMsg[999] = [ 'Warning', $_response.error ];
						displayMsg('modal' + jQuery('#page_key').val(), 999);
						laodingBar.hide();
						return false;
					}
					$modalMsg[999] = [ 'Quote Summary', $_response.quoteSummery ];
					displayMsg('modal' + jQuery('#page_key').val(), 999);
					
					laodingBar.hide();
				}
			);
	}
	
	funcLoadQuotes();
	
	 $('#btn_exporttocsv').click(function(){
		 $action = localize_var.TextDomain+'_quoteexportdata';
	 	   jQuery.post(
					localize_var.admin_ajaxurl +"?action="+$action,
					{
					},
					function( response ) {
						$_response = jQuery.parseJSON(response);
						if ($_response.error != undefined) {
							$modalMsg[999] = [ 'Warning', $_response.error ];
							displayMsg('modal' + jQuery('#page_key').val(), 999);
							laodingBar.hide();
							return false;
						}
						
						
						laodingBar.hide();
						JSONToCSVConvertor($_response,'Quotes',true);
					}
				);
    	  
   	});	 
	
})
})(jQuery);
function createISContact($this){	
	$data = jQuery($this).data();
	$elm = jQuery($this); 
	jQuery($this).hide();
	jQuery($this).parent().append('Please wait..');
	$action = localize_var.TextDomain+'_createISContactByContact';
	   jQuery.post(
				localize_var.admin_ajaxurl +"?action="+$action,
				{	
					data : $data
				},
				function( response ) {
					$_response = jQuery.parseJSON(response);
					if ($_response.error != undefined) {
						$modalMsg[999] = [ 'Warning', $_response.error ];
						displayMsg('modal' + jQuery('#page_key').val(), 999);
						laodingBar.hide();
						return false;
					}
					jQuery($this).parent().prev().html('Infusion Contact ID');
					jQuery($this).parent().html($_response.ISContact_id);					
					laodingBar.hide();
				}
			);
}
function makeISMarketable ($this){	
	$data = jQuery($this).data();
	$action = localize_var.TextDomain+'_makeISContactMarketable';
	   jQuery.post(
				localize_var.admin_ajaxurl +"?action="+$action,
				{	
					data : $data
				},
				function( response ) {
					$_response = jQuery.parseJSON(response);
					if ($_response.error != undefined) {
						$modalMsg[999] = [ 'Warning', $_response.error ];
						displayMsg('modal' + jQuery('#page_key').val(), 999);
						laodingBar.hide();
						return false;
					}
					jQuery($this).hide();
					laodingBar.hide();
				}
			);
}
