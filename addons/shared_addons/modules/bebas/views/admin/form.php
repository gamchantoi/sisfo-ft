<section class="title">
<?php if ($this->method == 'create'): ?>
	<h4>Tambah Data Bebas teori</h4>
<?php else: ?>
	<h4> Edit data Bebas Teori <?php echo $data->nama; ?></h4>
<?php endif; ?>
</section>

<section class="item">
<?php echo form_open(uri_string(), 'class="crud"'); ?>
    <div class="form_inputs">
        <fieldset>
            <ul>
                <li class="even">
		    <label for="name">NIM</label>
		    <div class="input"><?php echo form_input('nim',$data->nim, 'maxlength="25" '); ?></div>			
		</li>
                <li class="even">        
		    <label for="nim">SKS</label>
		    <div class="input"><?php echo form_input('sks',$data->sks); ?></div>			
                </li>
                <li class="even">
		    <label for="department">Nilai D</label>	
		    <div class="input"><?php echo form_input('nilai',$data->nilai); ?></div>
		</li>
                <li class="even">
		    <label for="department">IPK</label>	
		    <div class="input"><?php echo form_input('ipk',$data->ipk); ?></div>
		</li>
            </ul>
        </fieldset>
    </div>
    <div class="buttons float-right padding-top">
	<?php $this->load->view('admin/partials/buttons', array('buttons' => array('save', 'save_exit', 'cancel'))); ?>
</div>
<?php echo form_close(); ?>
</section>

