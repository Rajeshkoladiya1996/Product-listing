    <div class="card-content collapse show">
      <div class="card-body">
        <div class="row my-2">
          <div class="col-lg-4 col-md-6 col-sm-12">
            <div class="form-group">
              <!-- Modal -->
              <div class="modal fade text-left" id="ChangePasswordModal" tabindex="-1" role="dialog" aria-labelledby="RditProduct"
              aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <label class="modal-title text-text-bold-600" id="RditProduct">Change Password</label>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div id="errors" style="color: red;"></div>
                    <form method="post" id="change_password_form">
                    {{csrf_field()}}
                      <div class="modal-body">
                        <label>Old Passwod: </label>
                        <div class="form-group">
                            <input type="password" placeholder="Enter Old Password" class="form-control" name="oldpassword" id="oldpassword">
                        </div>

                        <label>New Password: </label>
                        <div class="form-group">
                            <input type="password" placeholder="Enter New Password" class="form-control" name="newpassword" id="newpassword">
                        </div>

                        <label>Confirm Password: </label>
                        <div class="form-group">
                            <input type="password" placeholder="Enter Confirm Password" class="form-control" name="confirmpassword" id="confirmpassword">
                        </div>
                      </div>
                      <div id="errors"></div>
                      <div class="modal-footer">
                        <input type="reset" class="btn btn-outline-secondary btn-lg" data-dismiss="modal"
                        value="close">
                        <input type="button" class="btn btn-outline-primary btn-lg" onclick="changePassword()"  value="Submit">
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  <footer class="footer">
      <div class="container-fluid">
          <div class="row">
              <div class="col-sm-6">
                  <script>document.write(new Date().getFullYear())</script> © devstree.
              </div>
              <div class="col-sm-6">
                  <div class="text-sm-right d-none d-sm-block">
                      Design & Develop by Rajesh
                  </div>
              </div>
          </div>
      </div>
  </footer>