<section class="title">
	<h4>Data Mahasiswa</h4>
</section>
<section class="item">
<?php if ($data) : ?>

<?php echo $this->load->view('admin/partials/filter_college'); ?>
<div>
	<p>
	<!--	<a href="admin/yudisium/college/create/"><img src="<?php echo base_url().$this->module_details['path'];?>/img/add.png"> <b>Tambah Data Mahasiswa</b></a>-->
	<?php echo anchor("admin/yudisium/college/create",img(array("src" =>base_url().$this->module_details['path']."/img/add.png"))."<b> Tambah data Mahasiswa</b>");?>
	</p>
</div>
<div id="filter-stage">

	<?php echo form_open('admin/yudisium/college/action'); ?>

		<?php echo $this->load->view('admin/tables/college'); ?>
      

	<?php echo form_close(); ?>
	
</div>
<div>
    <?php $this->load->view('admin/partials/pagination'); ?>  
</div>
<?php else : ?>
	<div class="no_data"><?php echo lang('blog_currently_no_posts'); ?></div>
<?php endif; ?>

</section>
