<?php $this->load->view($this->config->item('theme_uri').'layout/header_view'); ?>
<?php $this->load->view($this->config->item('theme_uri').'layout/left_menu_view'); ?>
<title>Site Maintenance</title>
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
<style>
 /* html, body { padding: 0; margin: 0; width: 100%; height: 100%; }
  * {box-sizing: border-box;}
  body { text-align: center; padding: 0; background: #d6433b; color: #fff; font-family: Open Sans; }
  h1 { font-size: 50px; font-weight: 100; text-align: center;}
  body { font-family: Open Sans; font-weight: 100; font-size: 20px; color: #fff; text-align: center; display: -webkit-box; display: -ms-flexbox; display: flex; -webkit-box-pack: center; -ms-flex-pack: center; justify-content: center; -webkit-box-align: center; -ms-flex-align: center; align-items: center;}*/
 /* article { display: block; width: 700px; padding: 50px; margin: 0 auto; }
  a { color: #fff; font-weight: bold;}
  a:hover { text-decoration: none; }
  svg { width: 75px; margin-top: 1em; }*/

  h1 { font-size: 50px; font-weight: 100; text-align: center;margin-top: 20px;}
</style>
<div class="content-wrapper">
    <h1>We&rsquo;ll be back soon!</h1>
    <div>
        <p style="text-align: center;">Sorry for the inconvenience. We&rsquo;re performing some maintenance at the moment. we&rsquo;ll be back up shortly!</p>
        <!-- <p>&mdash; The [WEBSITE NAME] Team</p> -->
    </div>
</div>

<?php $this->load->view($this->config->item('theme_uri').'layout/footer_view'); ?>