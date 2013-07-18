<div id="page_page" class="page">
    <div class="page-block page-block-blue">
        <div class="width">
            <article class="custom-page">
			<? if($page->sidebar): ?>
				<div id="content">
					<?=$page->text?>
				</div>
				<div id="sidebar">
					<?=$page->sidebar?>
				</div>
			<? else: ?>
				<?=$page->text?>
			<? endif; ?>
			</article>
        </div>
    </div>
</div>
