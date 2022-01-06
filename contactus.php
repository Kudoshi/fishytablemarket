<?php require "resources/conn.php";?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Contact Us</title>

    <!-- You can more stuff here if you want -->
    <?php require "import_headInfo.php"; ?>
</head>
<body>
    <?php require "header.php"; ?>
    <section>
        <br>
    <div class="container" pl-5 pr-5 pt-3>
        <h1 class="mb-5 text-secondary">Contact Us</h1>
        <h6 class="mb-5 text-secondary">Company Details:<br>
          No.69, Jalan Fish Table,<br> Taman Ming Liang, Kudo, <br>69690 Pulau Fish, Sheesh<br>
          E: fishytablemarket@gmail.com<br>
          T: +6012-3456789</h6>
        </div>
    <div class="container">
      <div class="row">
              <div class="ContactUs">
                  <form action="" class="mt-5 border p-4 bg-light shadow">
                    <h3 class="mb-5 text-secondary">Get In Touch With Us</h3>
                      <div class="row">
                            <div class="mb-3 col-md-12">
                              <label>Name<span class="text-danger">*</span></label>
                              <input type="text" name="Name" class="form-control" placeholder="Enter Name">
                          </div>
                          <div class="mb-3 col-md-12">
                              <label>Email<span class="text-danger">*</span></label>
                              <input type="Email" name="Email" class="form-control" placeholder="Enter Email">
                          </div>
                          <div class="mb-3 col-md-12">
                            <label>Message<span class="text-danger">*</span></label>
                            <input type="text" name="message" class="form-control" placeholder="Enter Message">
                        </div>
                          <div class="col-md-12">
                             <button class="btn btn-primary float-start">Submit</button>
                      </div>
                  </form>
              </div>
          </div>
      </div>
  </div>
  <br><br>
  </section>
    <?php require "footer.php";?>
</body>
</html>