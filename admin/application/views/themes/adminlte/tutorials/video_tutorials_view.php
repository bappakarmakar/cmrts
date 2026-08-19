<?php $this->load->view($this->config->item('theme_uri').'layout/header_view'); ?>
<?php $this->load->view($this->config->item('theme_uri').'layout/left_menu_view'); ?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous"> -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> -->
    <style type="text/css">
        .vid-wrapper {
text-align: center;
padding: 20px;
}

.vid {
/*display: inline-block;
vertical-align: top;*/
position: relative;
border: 1px solid;
padding: 2px;
cursor: pointer;
}

.vid::before {
content: '';
position: absolute;
top: 0;
right: 0;
bottom: 0;
left: 0;
}

h2.vid-head {
font-size: 20px;
color: #333;
}

/* Video Popup */
.video-popup {
position: fixed;
top: 0;
right: 0;
bottom: 0;
left: 0;
display: flex;
justify-content: center;
align-items: center;
z-index: 998;
background: rgba(0, 0, 0, .7);
cursor: pointer;
display: none !important;
}

.video-popup.show-video {
display: flex !important;
}

.iframe-wrapper {
position: relative;
}

.iframe-wrapper .close-video {
content: '';
position: absolute;
width: 25px;
height: 25px;
top: -20px;
right: 0;
background: url(<?php echo base_url('admin/files/Tutorials/delete-button.png'); ?>) #fff;
border-radius: 50%;
background-size: cover;
}
.main_title h2 
    {
        font-weight: bold;
        margin-bottom: 15px;
        margin-top: 25px;
    }
    </style>
</head>
<body>
<div class="content-wrapper">
<div class="container-fluid">
<div class="vid-slider">
    <div class="main_title">
        <h2 class="text-center ">Training Video</h2>
    </div>
     <section class="content-header" style="padding-bottom: 30px;">
      <!-- <h1>Training Video</h1> -->
      <ol class="breadcrumb">
        <li><a href="javascript:void(0)" onclick="previous()"><i class="fa fa-backward faico"></i>&nbsp;Back</a></li>
         <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      </ol>
   </section>
    <div class="vid-wrapper">
    <div class="col-md-4">
<div class="vid item">

    
<video autoplay="false" muted controls id="myIframe" width="100%" height="250px" src="<?php echo base_url('admin/files/Tutorials/video/compressed/TV1_How_to_login.mp4');?>" ></video>
<h2 class="vid-head">How to log in</h2>
</div> 
</div> 
 <div class="col-md-4">
<div class="vid item">
<video width="100%" muted controls height="250px" src="<?php echo base_url('admin/files/Tutorials/video/compressed/TV2_How_to_Change_your_Password.mp4');?>" frameborder="0" allow="accelerometer; encrypted-media; gyroscope; picture-in-picture" control allowfullscreen></video>
<h2 class="vid-head">How to Change your Password</h2>
</div>
</div>
<div class="col-md-4">
<div class="vid item">
<video width="100%" muted controls height="250px" src="<?php echo base_url('admin/files/Tutorials/video/compressed/TV3_How_to_Add_an_Intervention_Report.mp4');?>" frameborder="0" allow="accelerometer;  encrypted-media; gyroscope; picture-in-picture" v allowfullscreen></video>
<h2 class="vid-head">How to Add an Intervention Report</h2>
</div>
</div>

 </div>
</div>
</div>
<div class="video-popup">
<div class="iframe-wrapper"><iframe width="800" height="500" src="" frameborder="0" allow="accelerometer; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
<span class="close-video"></span>
</div>
</div>
</div>
<?php $this->load->view($this->config->item('theme_uri').'layout/footer_view'); ?>

<script type="text/javascript">
$(document).ready(function() {
    $('.vid-slider .vid').on('click', function() {
  // get required DOM Elements
  var iframe_src = $(this).children('video').attr('src'),
        iframe = $('.video-popup'),
        iframe_video = $('.video-popup iframe'),
        close_btn = $('.close-video');
        // iframe_src = iframe_src + '?autoplay=1&rel=0'; // for autoplaying the popup video
        
  // change the video source with the clicked one
  $(iframe_video).attr('src', iframe_src);
  $(iframe).fadeIn().addClass('show-video');
        
  // remove the video overlay when clicking outside the video
  $(document).on('click', function(e) {
    if($(iframe).is(e.target) || $(close_btn).is(e.target)) {
    $(iframe).removeClass('show-video');
    $(iframe_video).attr('src', '');
  }
        });
        
    });
  
});
var x = document.getElementById("myIframe");
 x.autoplay = false;

</script>
<script>
  function previous() {
    window.history.back();
  }
</script>
<script>
  $(document).ready(function() {
    // Function to disable autoplay for videos inside the iframe
    function disableAutoplayInIframe() {
      // Access the iframe content
      var iframe = $('#myIframe')[0].contentWindow;

      // Access video elements inside the iframe and disable autoplay
      $(iframe.document).find('video').each(function() {
        this.autoplay = false; // Directly set the autoplay property to false
      });
    }

    // Attach the function to the load event of the iframe
    $('#myIframe').on('load', disableAutoplayInIframe);
  });
</script>

</body>
</html>