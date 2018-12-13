<?php include 'page-option-header.php'; ?>
<section class="wrapper">
	<div class="row">
		<?php 
		$_quote = new MMQuotes();
		$_quote->_quoteView();
		?>
	</div>
</section>
<?php include 'page-option-footer.php'; ?>