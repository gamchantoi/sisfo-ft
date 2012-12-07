<section class="title">
    <h4>Surat Keputusan Dekan</h4>
</section>
<section class="item">
    <?php if ($decrees) : ?>
    <?php echo $this->load->view('admin/partials/filter_decrees'); ?>
    <?php echo form_open('admin/yudisium/decrees/action'); ?>
    <div>
	<!--<p><a href="admin/yudisium/decrees/create/"><img src="<?php echo base_url().$this->module_details['path'];?>/img/add.png"> <b>Tambah data Surat Keputusan</b></a></p>-->
	<p>
	    <?php echo anchor("admin/yudisium/decrees/create",img(array("src" =>base_url().$this->module_details['path']."/img/add.png"))."<b> Tambah data Surat Keputusan</b>");?>
	</p>
    </div>
    <div id="filter-stage">
        <?php echo $this->load->view('admin/tables/decrees')?>
    </div>
    <?php echo form_close(); ?>
<div>
    <?php $this->load->view('admin/partials/pagination'); ?>  
</div>
<?php else : ?>
	<div class="no_data"><?php echo lang('blog_currently_no_posts'); ?></div>
<?php endif; ?>
</section>