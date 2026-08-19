<?php $this->load->view($this->config->item('theme').'layout/header_view'); ?>

    <!--banner start-->

<section class="banner">
	<img src="<?php echo $this->config->item('theme_uri');?>child_marriage/image/banner.jpg" class="img-responsive" alt="">
	<!-- <div class="banner-content">
		<h2 class="banner-content-heading"><span style="color:#ff9300;">About</span> <span style="color:#46c406;">Sneha</span> <span style="color:#01519d;">Chaya</span></h2>
		<p class="banner-content-text">The COVID-19 pandemic, which has devastated families across India, has left lots of children orphaned or without one parent. They need proper support like food, cloths, education, safety and shelter etc. There are different types of social welfare services and schemes for the betterment of those children. But a proper mechanism needs to serve those perfectly amongst those children. Sneha Chhaya is an ICT based initiative to bring back those children into the mainstream of society. An Android based mobile application along with web application has been planned for monitoring and planning to reach the proper services to those children.</p>
		
	</div> -->
</section>

<!--banner end-->

<!--content start-->

<section class="content mtop40 mbot40">
	<div class="container">
		<div class="row">
			<div class="col-md-6">
				<div class="minister-sec">
					<div class="minister-box minister-box-first">
						<img src="<?php echo $this->config->item('theme_uri');?>child_marriage/image/shashi_panja.jpg" alt="" class="img-circle">
						<h3 class="name">Dr. Shashi Panja</h3>
						<span class="designation">Hon'ble Minister-in-charge</span>
						<span class="department">Department of Women and Child Development and Social Welfare</span>
						<span class="government">Government of West Bengal</span>
					</div>
					<div class="minister-box">
						<img src="<?php echo $this->config->item('theme_uri');?>child_marriage/image/sanghamitra_ghosh.jpg" alt="" class="img-circle">
						<h3 class="name">Smt. Sanghamitra Ghosh, IAS</h3>
						<span class="designation">Secretary</span>
						<span class="department">Department of Women and Child Development and Social Welfare</span>
						<span class="government">Government of West Bengal</span>
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div>
					<a href="<?php echo base_url() ?>admin">
					<div class="container-box green-bg">
						<img src="<?php echo $this->config->item('theme_uri');?>child_marriage/image/stakeholderlogin.png" class="img-responsive" alt="">
						<span>Stakeholder Login</span>
					</div>
					</a>
				</div>
				<div>
					<a href="#">
					<div class="container-box blue-bg">
						<img src="<?php echo $this->config->item('theme_uri');?>child_marriage/image/cci.png" class="img-responsive" alt="">
						<span>Resource Directory</span>
					</div>
					</a>
				</div>
				<!-- <div>
					<a href="#">
					<div class="container-box orange-bg">
						<img src="<?php echo $this->config->item('theme_uri');?>snehachaya/image/sc-report.png" class="img-responsive" alt="">
						<span>Sneha Chaya Reports</span>
					</div>
					</a>
				</div> -->
			</div>
		</div>
	</div>
</section>

<!--content end-->

    <?php $this->load->view($this->config->item('theme').'layout/footer_view'); ?>