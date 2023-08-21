<div class="row">
    <!--Section: Contact v.2-->
    <section class="mb-4">

        <!--Section heading-->
        <h2 class="h1-responsive font-weight-bold text-center my-4">Contact us</h2>
        <!--Section description-->
        <p class="text-center w-responsive mx-auto mb-5">Do you have any questions? Please do not hesitate to contact us directly. Our team will come back to you within
            a matter of hours to help you.</p>

        <div class="row">
            <div class="col-md-9 mb-md-0 mb-5">
                <form id="contact-form" action="<?= current_url() . '/process' ?>" method="POST">
                    <div class="row">
                        <div class="col-md-6 mb-2">
                            <div class="form-group md-form mb-0">
                                <label for="name" class="">Your name</label>
                                <input type="text" id="name" name="name" class="form-control">
                            </div>
                        </div>

                        <div class="col-md-6 mb-2">
                            <div class="form-group md-form mb-0">
                                <label for="email" class="">Your email</label>
                                <input type="text" id="email" name="email" class="form-control">
                            </div>
                        </div>

                        <div class="col-md-12 mb-2">
                            <label for="message">Your message</label>
                            <textarea type="text" id="message" name="message" rows="2" class="form-control md-textarea"></textarea>
                        </div>

                        <div class="col-md-12">
                            <div class="text-center text-md-left">
                                <button class="btn btn-primary" type="submit">Send</button>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="status"></div>

                <div class="row mt-5">
                    <div class="col-md-12">
                        <table id="user-table" class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <td width="1%">No</td>
                                    <td>Nama</td>
                                    <td>Email</td>
                                    <td>Message</td>
                                    <td>Action</td>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-md-3 text-center">
                <ul class="list-unstyled mb-0">
                    <li>
                        <i class="fas fa-map-marker-alt fa-2x"></i>
                        <p>San Amigo, SA 667788, Konoha</p>
                    </li>

                    <li>
                        <i class="fas fa-phone mt-4 fa-2x"></i>
                        <p>+ 01 234 567 89</p>
                    </li>

                    <li>
                        <i class="fas fa-envelope mt-4 fa-2x"></i>
                        <p>contact@portal.com</p>
                    </li>
                </ul>
            </div>
        </div>
    </section>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $('#user-table').DataTable({
            "processing": true,
            "serverSide": true,
            "order": [],
            "ajax": {
                "url": "<?= current_url() . "/datatables" ?>",
                "type": "POST"
            },
        });

        $("#contact-form").submit(function(e) {
            e.preventDefault(); // avoid to execute the actual submit of the form.

            var form = $(this);
            var actionUrl = form.attr('action');

            $.ajax({
                type: "POST",
                url: actionUrl,
                data: form.serialize(), // serializes the form's elements.
                success: function(data) {
                    alert(data); // show response from the php script.
                }
            });

        });
    });
</script>