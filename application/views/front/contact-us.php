<!-- <section class="slidBanner">
    <div class="flexslider">
      <ul class="slides">
      
        <li>
             <img src="<?=base_url('assets/front/images/contactUs.jpg')?>" class="img-responsive">
            
        </li>
     
        
      </ul>
    </div>
</section> -->

<section class="contactsUs">
    <div class="container">
        <div class="row">
<!--             <div class="col-xs-12 col-sm-4">
                <figure><i class="fas fa-map-marker-alt"></i></figure>
                <h3><?=getAdminInfo('address')?></h3>
                <p><?=getStaticContent('FOOTER_VISIT_OFFICE')?></p>
            </div> -->
            <div class="col-xs-12 col-sm-4">
                <figure><i class="fas fa-phone fa-rotate-90"></i></figure>
                <h3><?=getAdminInfo('mobile')?></h3>
                <p><?=getStaticContent('FOOTER_CALL_US_NOW')?></p>
            </div>
            <div class="col-xs-12 col-sm-4">
                <figure><i class="fas fa-envelope"></i></figure>
                <h3><?=getAdminInfo('email')?></h3>
                <p><?=getStaticContent('FOOTER_SEND_MESSAGE')?></p>
            </div>
        </div>
    </div>
</section>
<section class="questionForm">
    <div class="container">
        <div class="row">
        <div class="col-sm-8">
        <form method="post" id="sendQuery">

            <div class="row">
                <div class="col-xs-12">
                    <h3 class="title"><?=getStaticContent('FOOTER_HAVE_QUESTION')?></h3>
                    <!-- <p class="subTitl"><?=getStaticContent('FOOTER_CONTACT_MESSAGE')?></p> -->
                </div>
                <div class="col-xs-12 col-sm-4">
                 <label class="contact_label" >Name</label>
                    <div class="form-group"><input class="form-control input" name="username"  placeholder="Name" type="text" required=""></div>
                </div>
                <div class="col-xs-12 col-sm-4">
                <label class="contact_label" >Email</label>
                <div class="form-group"><input class="form-control input" name="email" placeholder="Email" type="email" pattern="[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[a-z]{2,4}$" title="Invalid email address" placeholder="Email" required=""></div>
                    
                </div>
                <div class="col-xs-12 col-sm-4">
                <label class="contact_label" >Phone Number</label>
                    <div class="form-group"><input class="form-control input" name="phone" placeholder="Phone" type="text" pattern="[7-9]{1}[0-9]{9}" title="Mobile number with 7-9 and remaing 9 digit with 0-9" required=""></div>
                </div>
                <div class="col-xs-12">
                <label class="contact_label" >Message</label>
                    <div class="form-group"><textarea  class="form-control input" name="comment" placeholder="Message" required=""></textarea></div>
                </div>
                <div class="col-xs-8"><div id="sendMsg"></div></div>
                <div class="col-xs-4">
                    <div class="form-group"><button type="submit" class="btn"><?=getStaticContent('SEND')?></button></div>
                </div>
            </div>
        </form>
        </div>
		<div class="col-sm-4 map">
        <iframe width="100%" height="600" src="https://maps.google.com/maps?width=100%&amp;height=600&amp;hl=en&amp;q=7310%20basie%20park%20court+(My%20Business%20Name)&amp;ie=UTF8&amp;t=&amp;z=14&amp;iwloc=B&amp;output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"><a href="https://www.maps.ie/create-google-map/">Add map to website</a></iframe>


        <!-- <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3266.6632862825377!2d-80.81741008470547!3d35.04015258034874!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x885682ab64b3a5a3%3A0xea61ede18bef891c!2s7310+Basie+Park+Ct%2C+Charlotte%2C+NC+28277%2C+USA!5e0!3m2!1sen!2sin!4v1531287147025" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe> -->
        </div>
        
        </div>
    </div>
</section>