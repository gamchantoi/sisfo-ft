<script type="text/javascript">
$(function(){
  var removeLink = ' <a class="remove" href="#" onclick="$(this).parent().fadeIn(function(){ $(this).remove() }); return false"><img src="<?php echo base_url().$this->module_details['path'];?>/img/delete.png"></a>';
$('a.add').relCopy({ append: removeLink});	
});
</script>
<style type="text/css">
body{ font-family:Arial, Helvetica, sans-serif; font-size:13px; }
a.remove {color:#cc0000; text-decoration: none;}
a.input{ border: solid 1px #006699; padding:3px}
td a.add { text-decoration: none; }

</style>

<h2 id="page_title" class="page-title">
	Entri Data Pendaftaran PI
</h2>
<div>
        <?php if(validation_errors()):?>
	<div class="error-box">
		<?php echo validation_errors();?>
	</div>
	<?php endif;?>
        <?php echo form_open('prakerin/create', array('id'=>'user_edit'));?>
        <fieldset id="user_names">
        <legend>Data Perusahaan</legend>
        <ul>
            <li class="float-left spacer-right">
                <label for="name">Nama Perusahaan</label>
		<?php echo form_input('company'); ?>
            </li>
            <li>
                <label for="department">Kota/ Kabupaten</label>
		<?php echo form_dropdown('district', $district,'','class="district"'); ?>
            </li>
            <li>
                <label>Alamat</label>
                <?php echo form_textarea('address'); ?>
            </li>
        </ul>
        </fieldset>
        <fieldset>
            <legend>Data Mahasiswa</legend>
            <ul>
	      <li class="multiple_fields">
		  <div class="fields2">
		      <div>
			<label for="department">Program Studi</label>
			<?php echo form_dropdown('department', $prodies,'','class="department"'); ?>
		      </div>
		      <div>
			<label for="start">Tanggal Mulai</label>
			<?php echo form_input('start','','id="start"'); ?>
		      </div>
		      <div>
			<label for="finish">Tanggal Selesai</label>
			<?php echo form_input('finish','','id="finish"'); ?>
		      </div>
		  </div>
		  
	      </li>
                <li class="multiple_fields">
		    <div class="fields2 clone">
                        <div>
                            <label for="nama">Nama Mahasiswa</label>
                            <?php echo form_input('name[]'); ?>
                        </div>
                        <div>
                            <label>NIM</label>
                            <?php echo form_input('nim[]'); ?>
                        </div>
			<div>
                            <label>Pembimbing PI</label>
                            <?php echo form_dropdown('adviser[]',$lectures); ?>
                        </div>
                        
                    </div>
                    <div><a href="#" class="add" rel=".clone"><img src="<?php echo base_url().$this->module_details['path'];?>/img/add.png"></a></div>
                </li>
                <!--<li><a href="#" class="add" rel=".clone">add more</a></li>-->
            </ul>
            
                
            
        </fieldset>
        <?php echo form_submit('submit', 'Simpan'); ?>
        <?php echo form_close(); ?>
</div>