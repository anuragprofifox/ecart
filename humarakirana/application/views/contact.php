   <div class="hero-wrap hero-bread" style="background-image: url('<?php echo base_url(); ?>assets/images/bg_1.jpg');">
      <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
          <div class="col-md-9 ftco-animate text-center">
          <!-- 	<p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home</a></span> <span>Contact us</span></p>
            <h1 class="mb-0 bread">Contact us</h1> -->
          </div>
        </div>
      </div>
    </div>

    <section class="ftco-section contact-section bg-light">
      <div class="container">
      	<div class="row d-flex mb-5 contact-info">
          <div class="w-100"></div>
          <div class="col-md-3 d-flex">
          	<div class="info bg-white p-4">
	            <p><span>Address:</span> Shop No 2C, Gayatri Vihar I near railway bridge, Borkhera, Kota</p>
	          </div>
          </div>
          <div class="col-md-3 d-flex">
          	<div class="info bg-white p-4">
	            <p><span>Phone:</span> <a href="#">+91 9460495320</a></p>
	          </div>
          </div>
          <div class="col-md-3 d-flex">
          	<div class="info bg-white p-4">
	            <p><span>Email:</span> <a href="#">humarakirana4u@gmail.com</a></p>
	          </div>
          </div>
          <div class="col-md-3 d-flex">
          	<div class="info bg-white p-4">
	            <p><span>Website</span> <a href="http://www.humarakirana.com">www.humarakirana.com</a></p>
	          </div>
          </div>
        </div>
        <div class="row block-9">
          <div class="col-md-6 order-md-last d-flex">
            <form action="<?php echo base_url('home/submitquery') ?>"  method="post" class="bg-white p-5 contact-form">
              <div class="form-group">
                <input type="text" class="form-control" name="name" required="required" placeholder="Your Name">
              </div>
              <div class="form-group">
                <input type="text" class="form-control" name="contact_number"  required="required" placeholder="Your Contact Number">
              </div>
              <div class="form-group">
                <input type="text" class="form-control" name="subject" required="required" placeholder="Subject">
              </div>
              <div class="form-group">
				<textarea name="message" id="message" required="required" class="form-control" cols="30" rows="7" placeholder="Your Message Here"></textarea>
              </div>
              <div class="form-group">
				<input type="submit" name="submit" class="btn btn-primary pull-right" value="Send Message">
              </div>
            </form>
          
          </div>

          <div class="col-md-6 d-flex">
          	<div id="map" class="bg-white"></div>
          </div>
        </div>
      </div>
    </section>