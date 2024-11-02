<div class="card">
    <div class="card-header py-3 d-flex justify-content-between bg-transparent border-bottom-0">
        <h6 class="mb-0 fw-bold ">Add Organizer</h6>
    </div>
    <div class="card-body">
        <ul class="nav nav-tabs tab-body-header rounded d-inline-flex mb-3" role="tablist">
            <li class="nav-item"><a class="nav-link active" data-bs-toggle="tab" href="#TradeHistory" role="tab">Trade History</a></li>
        </ul>
        <div class="tab-content">
            <!-- OrderHistorytab End -->
            <div class="tab-pane fade show active" id="TradeHistory">
                <table id="ordertabthree" class="priceTable table table-hover custom-table-2 table-bordered align-middle mb-0" style="width:100%">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>action</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php

                        include "controller/controllerGuest.php";
                        $main = new controllerGuest();

                        $hasil = $main->getDataOrganizer();
                        foreach ($hasil as $data) {
                            $id = $data["id"];
                            $name = $data["name"];
                            $email = $data["email"];
                            $address = $data["address"];
                            $phone_number = $data["phone_number"];
                            $npwp = $data["npwp"];

                                echo "<tr>
                                <td>".$name."</td>
                                <td><button type=\"button\" class=\"btn btn-warning\" data-bs-toggle=\"modal\" data-bs-target=\"#editOrganizer".$id."\">Edit Data</button>
                                <button type=\"button\" class=\"btn btn-danger\">Delete</button></td>

                            </tr>
                            ";

                            echo "
                            
                            <div class=\"modal fade\" id=\"editOrganizer".$id."\" tabindex=\"-1\"  aria-hidden=\"true\">
                                <div class=\"modal-dialog modal-dialog-centered modal-md modal-dialog-scrollable\">
                                <div class=\"modal-content\">
                                    <div class=\"modal-header\">
                                        <h5 class=\"modal-title  fw-bold\" id=\"expeditLabel1111\"> Edit Profile</h5>
                                        <button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"modal\" aria-label=\"Close\"></button>
                                    </div>
                                    <div class=\"modal-body\">
                                        
                                        <div class=\"deadline-form\">
                                            <form action=\"edit.php\" method=\"POST\" enctype=\"multipart/form-data\">
                                                <input type=\"hidden\" name=\"id\" value=\"".$id."\"> 
                                                <div class=\"row g-3 mb-3\">
                                                    <div class=\"col-sm-12\">
                                                    <label for=\"item100\" class=\"form-label\">Name</label>
                                                    <input type=\"text\" name=\"name\" class=\"form-control\" id=\"item100\" value=\"".$name."\"> 
                                                    </div>
                                                    <div class=\"col-sm-12\">
                                                        <label for=\"item100\" class=\"form-label\">Email Address</label>
                                                        <input type=\"email\" name=\"email\" class=\"form-control\" id=\"item100\" value=\"".$email."\"> 
                                                    </div>
                                                </div>
                                                <div class=\"row g-3 mb-3\">
                                                    <div class=\"col-sm-12\">
                                                        <label class=\"form-label\">Address</label>
                                                        <textarea name=\"address\" class=\"form-control\" rows=\"3\">".$address."</textarea>
                                                    </div>
                                                </div>
                                                <div class=\"col-sm-12\">
                                                        <label for=\"item100\" class=\"form-label\">Phone Number</label>
                                                        <input type=\"text\" name=\"phone_number\" class=\"form-control\" id=\"item100\" value=\"".$phone_number."\"> 
                                                </div>
                                                <div class=\"col-sm-12\">
                                                        <label for=\"item100\" class=\"form-label\">NPWP</label>
                                                        <input type=\"text\" name=\"npwp\" class=\"form-control\" id=\"item100\" value=\"".$npwp."\"> 
                                                </div>
                                                </div>
                                                
                                                </div>
                                                <div class=\"modal-footer\">
                                                <button type=\"button\" class=\"btn btn-secondary\" data-bs-dismiss=\"modal\">cancel</button>
                                                <button type=\"submit\" name=\"editOrganize\" class=\"btn btn-primary\">Save</button>
                                            </form>
                                    </div>
                                </div>
                                </div>
                            </div>
                            
                            ";
                        }
                        ?>
                        <!-- <tr>
                            <td>Leo</td>
                            <td><button type="button" class="btn btn-info">Edit Data</button><button type="button" class="btn btn-danger">Delete</button></td>
                        </tr> -->
                    </tbody>
                </table>
            </div>

            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <h5 class="modal-title w-100" id="exampleModalLabel">
                            Payment Receipt
                        </h5>

                    </div>
                    <div class="modal-body">
                        <img src="assets/images/coin/SOL.png" />
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" data-dismiss="modal">
                            Verify
                        </button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">
                            Close
                        </button>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous">
</script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous">
</script>