
        <!-- Footer-->
        <footer class="bg-light py-5">
            <div class="container px-4 px-lg-5"><div class="small text-center text-muted">Copyright &copy; Iselco I <?php echo date("Y"); ?></div></div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- SimpleLightbox plugin JS-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/SimpleLightbox/2.1.0/simpleLightbox.min.js"></script>

        
         <!-- Modal Login-->
         <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Login</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <span id="success_message"></span>
                        <form action="/users/signin" method="post" id="signin">
                            <div class="mb-3">
                                <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?= $this->security->get_csrf_hash();?>" />
                                <label for="email" class="col-form-label">Email:</label>
                                <input type="text" name="email" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="password" class="col-form-label">Password:</label>
                                <input type="password" name="password" class="form-control">
                            </div>
                            
                        <button type="submit" id="btnsignup" class="btn btn-primary">Login</button>    
                        </form>
                    </div>
                    <div class="modal-footer">
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal Profile-->
        <div class="modal fade" id="profile" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Profile</h5>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="edit" value="edit">
                        <label class="form-check-label" for="edit">Edit Details</label>
                        </div>
                        <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="change" value="change">
                        <label class="form-check-label" for="change">Change Password</label>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="details" id="details"></div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>