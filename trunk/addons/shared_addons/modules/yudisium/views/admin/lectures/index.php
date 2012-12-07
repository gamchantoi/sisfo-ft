<section class="title">
    <h4>Data Dosen</h4>
</section>
<section class="item">
    <?php if ($lectures) : ?>
    <?php echo $this->load->view('admin/partials/filter_lectures'); ?>
    <?php echo form_open('admin/yudisium/lectures/action'); ?>
    <div>
	<p>
	<!--    <a href="admin/yudisium/lecturez/create/"><img src="<?php echo base_url().$this->module_details['path'];?>/img/add.png"> <b>Tambah Data Dosen</b></a> -->
	<?php echo anchor("admin/yudisium/lecturez/create",img(array("src" =>base_url().$this->module_details['path']."/img/add.png"))."<b> Tambah data Dosen</b>");?>
	</p>
    </div>
    <div id="filter-stage">
        <?php echo $this->load->view('admin/tables/lectures')?>
    </div>
    <?php echo form_close(); ?>
<div>
    <?php $this->load->view('admin/partials/pagination'); ?>  
</div>
<?php else : ?>
	<div class="no_data"><?php echo lang('blog_currently_no_posts'); ?></div>
<?php endif; ?>
</section>